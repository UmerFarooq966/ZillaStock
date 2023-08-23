<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\HomePageImage;
use App\Models\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $image = HomePageImage::first();

        if ($image==null){

            $image = Image::where('state',1)->first();

        }

        $images = Image::where('state',1)
            ->get();
        //   dd($images);
        if (isset($images)) {
            return view('index')->with('images',$images)->with('image',$image);
        } else {
            return view('index')->with('message', 'No images found');
        }
    }


    public function home()
    {

     //   $image = HomePageImage::first();

//dd($image);
     //   return view('/',['image'=>$image]);

    }
}
