<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\SellerBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function edit(Request $request)
    {
        $user = auth()->user();

        // Retrieve the billing data for the logged-in user
        $billing = Billing::where('user_id', $user->id)->first();

        if (!$billing) {
            // If no billing data is found, create a new instance
            $billing = new Billing();
        }

        return view('billing.edit', compact('billing'));
    }

    public function update(Request $request)
    {
         $user = auth()->user();

        // Find or create the billing data for the logged-in user
        $billing = Billing::firstOrNew(['user_id' => $user->id]);

        // Set the user_id value
        $billing->user_id = $user->id;

        // Update the remaining fields with the input values
        $billing->bank_account = $request->input('bank_account');
        $billing->routing_number = $request->input('routing_number');
        $billing->account_holder_name = $request->input('account_holder_name');
        $billing->bank_name = $request->input('bank_name');

        // Save the updated billing data
        $billing->save();


        return redirect()->route('billing.edit')->with('success', 'Billing information updated successfully.');
    }
}
