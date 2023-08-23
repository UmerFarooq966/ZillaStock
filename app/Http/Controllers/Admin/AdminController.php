<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageImage;
use App\Models\Image;
use App\Models\imagecategory;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminHome()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'user') {
                return view('Buyer.B-dashboard');
            } elseif (auth()->user()->role == 'admin') {
                return view('Admin.A-dashboard');
            } elseif (auth()->user()->role == 'team') {
                return view('Team.T-dashboard');
            }
        }

        return view('/');


    }



    public function getTotalRevenueAndSales()
    {
        // Get the current logged-in user as a seller
        $seller = Auth::user();


// Retrieve the purchases made from the seller
        $purchases = Purchase::whereMonth('created_at', Carbon::now()->month)->get();

        $totalRevenue = 0;
        $totalSales = 0;
        $totaltransactions= 0;

        foreach ($purchases as $purchase) {
            // Find the associated image with the purchase
            $image = Image::find($purchase->image_id);

            if ($image) {
                // Calculate revenue and sales for each sold image
                $revenue = $image->price * 0.2; // Subtract 80% from the image price
                $totalRevenue += $revenue;
                $totaltransactionsrevenue = $image->price * 0.8; // Subtract 20% from the image price
                $totaltransactions += $totaltransactionsrevenue;
                $Sales = $image->price;
                $totalSales += $Sales;
            }
        }
            $transaction = $totalRevenue + $totalSales;
        //***********************


        $todayPurchases = Purchase::whereDate('created_at', Carbon::today())->count();

        // Retrieve the purchases made yesterday
        $yesterdayPurchases = Purchase::whereDate('created_at', Carbon::yesterday()->format('Y-m-d'))->count();

        if ($yesterdayPurchases > 0) {
            // Calculate the percentage change
            $percentageChange = (($todayPurchases - $yesterdayPurchases) / $yesterdayPurchases) * 100.0;
        } elseif($todayPurchases >0) {
            $percentageChange = 100.0; // if purchase was done and if there were no purchases yesterday
        }
        else{
            $percentageChange = 0.0; // Avoid division by zero if there were no purchases yesterday

        }




//dd($yesterdayPurchases);
        // Pass the total revenue and total sales to the view using compact
        return view('Admin.A-dashboard', compact('totalRevenue', 'totalSales', 'transaction', 'percentageChange','totaltransactions'));
    }

    function getTotalRevenueAndSalesimage()
    {
        // Get the current logged-in user as a seller
        $seller = Auth::user();

        // Retrieve the purchases made from the seller
        $purchases = Purchase::get();

        $imageData = [];

        foreach ($purchases as $purchase) {
            // Find the associated image with the purchase
            $image = Image::find($purchase->image_id);

            if ($image) {
                // Calculate revenue and sales for each sold image
                $revenue = $image->price * 0.2; // Subtract 80% from the image price
                $sales = 0;

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

        return view('Admin/dash-content/sales')->with('imageData',$imageData);
    }




    public function updateImage(Request $request)
    {

        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|min:248'
        ]);

// Get the model instance
        $model = HomePageImage::find(1); // Assuming you want to update the image for the model with ID 1

// Check if the model already has an image
        if ($model && $model->image) {
            // Delete the previous image file
            if (file_exists(public_path('images/' . $model->image))) {
                unlink(public_path('images/' . $model->image));
            }
        }

// Store the new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

// Update the model with the new image path
        if (!$model) {
            $model = new HomePageImage();
            $model->id = 1;
        }
        $model->image = $imageName;
        $model->save();

        return redirect()->back();
    }
}
