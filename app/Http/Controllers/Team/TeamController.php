<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function Teamhome()
    {

        // Retrieve all images with state = 0
        $images = Image::where('state', 0)->get();
        return view('Team.ManageImages.index', compact('images'));

    }//
}
