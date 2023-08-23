<?php

namespace App\Http\Controllers;

use App\Models\SellerBalance;
use App\Models\User;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        // Handle purchase creation logic

        // Update seller's balance in the seller_balances table
        $seller = User::find($request->seller_id);
        $sellerBalance = SellerBalance::where('seller_id', $seller->id)->first();

        if (!$sellerBalance) {
            $sellerBalance = SellerBalance::create([
                'seller_id' => $seller->id,
                'balance' => $request->price * (1 - 0.2), // Assuming 20% deduction
            ]);
        } else {
            $sellerBalance->increment('balance', $request->price * (1 - 0.2));
        }

        // Return a success message or redirect to the appropriate page
        return redirect()->back()->with('success', 'Purchase successful!');
    }
}
