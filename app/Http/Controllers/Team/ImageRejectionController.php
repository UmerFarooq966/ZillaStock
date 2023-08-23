<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\RejectedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageRejectionController extends Controller
{
    public function index()
    {
        // Retrieve all images with state = 0
        $images = Image::where('state', 0)->get();
        return view('Team.ManageImages.index', compact('images'));
    }


    public function reject(Request $request, Image $image)
    {
        $user_id = $request->user()->id;
        // Validate the reason for rejection
        $request->validate([
            'reason' => 'required'
        ]);

        // Create a new rejection reason
        $rejection = new RejectedImage([
            'image_id' => $image->id,
            'rejection_reason' => $request->reason,
            'rejection_date' => now(),
            'team_id'=>$user_id
        ]);

        // Save the rejection reason
        $rejection->save();

        // Update the image state to rejected
        $image->state = 2;
        $image->save();

        return redirect()->route('images.index')->with('success', 'Image rejected successfully');
    }

    public function approve(Image $image)
    {
        $user_id = Auth::user()->id;
        // Update the image state to approved
        $image->state = 1;
        $image->team_id = $user_id;
        $image->save();

        return redirect()->route('images.index')->with('success', 'Image approved successfully');
    }

}
