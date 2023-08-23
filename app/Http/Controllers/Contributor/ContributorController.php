<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Purchase;
use App\Models\SellerBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContributorController extends Controller
{
    public function ContributorDashboard()
    {

        $test = auth()->user()->role;
        if($test!=null)
        {
            if ( $test == 'user' &! null)
            {

                return view('Contributor.C-dashboard');
            }

        }

        else
        {
            return redirect()->route('homee');
        }
    }


    public function getTotalRevenueAndSales()
    {
        // Get the current logged-in user as a seller
        $seller = Auth::user();

// Retrieve the purchases made from the seller
        $purchases = Purchase::where('seller_id', $seller->id)->get();

        $totalRevenue = 0;
        $totalSales = 0;

        foreach ($purchases as $purchase) {
            // Find the associated image with the purchase
            $image = Image::find($purchase->image_id);

            if ($image) {
                // Calculate revenue and sales for each sold image
                $revenue = $image->price * 0.8; // Subtract 20% from the image price
                $totalRevenue += $revenue;
                $totalSales++;

                // Update the SellerBalance model
                $sellerBalance = SellerBalance::where('seller_id', $seller->id)->first();

                if (!$sellerBalance) {
                    $sellerBalance = new SellerBalance();
                    $sellerBalance->user_id = $seller->id;
                }

                $sellerBalance->balance += $revenue;
                $sellerBalance->Images += 1;
                $sellerBalance->save();
            }
        }

        // Pass the total revenue and total sales to the view using compact
        return view('Contributor.C-dashboard', compact('totalRevenue', 'totalSales'));
    }

    function getTotalRevenueAndSalesimage()
    {
        // Get the current logged-in user as a seller
        $seller = Auth::user();

        // Retrieve the purchases made from the seller
        $purchases = Purchase::where('seller_id', $seller->id)->get();

        $imageData = [];

        foreach ($purchases as $purchase) {
            // Find the associated image with the purchase
            $image = Image::find($purchase->image_id);

            if ($image) {
                // Calculate revenue and sales for each sold image
                $revenue = $image->price * 0.8; // Subtract 20% from the image price
                $sales = 1;

                if (isset($imageData[$image->id])) {
                    // If the image data already exists, update the revenue and sales
                    $revenue += $imageData[$image->id]['revenue'];
                    $sales += $imageData[$image->id]['sales'];
                }

                // Store the image data
                $imageData[$image->id] = [
                    'image' => $image,
                    'revenue' => $revenue,
                    'sales' => $sales,
                ];
            }
        }

        return view('Contributor/dash-content/sales')->with('imageData',$imageData);
    }

    public function show(Request $request)
    {
        if (Auth::user()->role == 'user') {
            $users = Auth::user();
            $user_id = Auth::id();

            $sort = $request->input('sort', 'date'); // Get the selected sorting option (default: 'date')

            $imagesQuery = Image::where('userid', $user_id)
                ->where('state', 1);

            if ($sort === 'date') {
                $imagesQuery->orderBy('created_at', 'desc');
            } elseif ($sort === 'purchases') {
                // Retrieve the purchases made from the seller
                $purchases = Purchase::where('seller_id', $user_id)->pluck('image_id')->toArray();

                $imagesQuery->orderByRaw('FIELD(id, ' . implode(',', $purchases) . ') DESC');
            }

            $images = $imagesQuery->get();

            if (count($images) > 0) {
                // Get the total revenue and total sales
                $totalRevenueAndSales = $this->getTotalRevenueAndSales();
                $totalRevenue = $totalRevenueAndSales['totalRevenue'];
                $totalSales = $totalRevenueAndSales['totalSales'];

                $message = '';
                return view('Contributor.C-dashboard', compact('images', 'totalRevenue', 'totalSales', 'message'));
            } else {
                $message = 'No images found';
                return view('Contributor.C-dashboard', compact('message'));
            }
        } else {
            return redirect('/');
        }
    }



}
