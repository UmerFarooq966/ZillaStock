<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Purchase;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;


class CartController extends Controller
{

    public function checkout()
    {
        $cartItems = auth()->user()->cartItems;
        $lineItems = [];

        foreach ($cartItems as $cartItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $cartItem->image->name,


                    ],
                    'unit_amount' => $cartItem->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $checkoutSession = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.complete')."?session_id={CHECKOUT_SESSION_ID}" ,
            'cancel_url' => 'http://localhost:4242/cancel',
        ]);

       //redirect('$checkoutSession->url');
       return redirect()->away($checkoutSession->url);
    }


    public function addToCart(Request $request)
    {
        $imageId = $request->input('image_id');
        $quantity = 1;
        $user = auth()->user();
        $cartItem = $user->cartItems()->where('image_id', $imageId)->first();

        $image = Image::findOrFail($imageId);

        if ($image->userid === $user->id) {
            // User is trying to add their own picture to the cart
            return redirect()->back()->with('message', "You can't buy your own picture.");
        }

        if ($cartItem) {
            // Image already exists in cart, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Image does not exist in cart, create a new cart item
            $cartItem = new Cart();
            $cartItem->user_id = $user->id;
            $cartItem->image_id = $imageId;
            $cartItem->quantity = $quantity;
            $cartItem->price = $image->price;
            $cartItem->save();
        }

        Session::flash('message', 'Image added to cart.');
        return redirect()->back()->with('success', 'Image added to cart.');
    }


    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Image removed from cart.');
    }

    public function showCart()
    {
        $cartItems = auth()->user()->cartItems;

        return view('cart.index', compact('cartItems'));
    }


    public function completePayment(Request $request)
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        try {

            $sessionId = $request->session_id;
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            //$customer = $stripe->customers->retrieve($session->customer);

            // Retrieve the paymentIntentId from the session
            $paymentIntentId = $session->payment_intent;

            // Retrieve the payment intent
            $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

            $user = auth()->user();
            $cartItems = $user->cartItems;

            foreach ($cartItems as $cartItem) {
                $image = $cartItem->image;

                // Check if the user has already purchased the image
                $purchased = $user->purchases()->where('image_id', $image->id)->exists();

                if (!$purchased) {
                    // Create a purchase record for the user and image
                    $purchase = new Purchase();
                    $purchase->user_id = $user->id;
                    $purchase->image_id = $image->id;
                    $purchase->seller_id = $image->userid;
                    $purchase->price = $image->price;
                    $purchase->save();
                }
            }

            // Remove items from the cart
            $user->cartItems()->delete();

            // Handle other actions such as sending email notifications, generating licenses, etc.

            return redirect()->route('purchased-images')->with('success', 'Payment completed successfully.');
        } catch (Error $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function purchasedImages()
    { $user = auth()->user();
        $purchasedImages = $user->purchases->pluck('image');

        $originalImages = [];

        foreach ($purchasedImages as $image) {
            $originalImage = str_replace('watermarked_', 'original_', $image);
            $originalImages[] = $originalImage;
        }
//dd($originalImages);
        return view('cart.purchased-images')->with('originalImages',$originalImages);
    }
}
