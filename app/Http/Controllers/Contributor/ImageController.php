<?php

namespace App\Http\Controllers\Contributor;

use Carbon\Carbon;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Http\Controllers\Controller;
use App\Models\Image as ImageModel;
use App\Models\ImageCategory;
use App\Models\RejectedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;



class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $users = Auth::user();
            $user_id = Auth::id();

            $images = ImageModel::where('userid', $user_id)->where('state', 0)->get();

            if (isset($images)) {
                return view('Contributor/UploadImages/index')->with('images', $images)->with('message', ' ');
            } else {
                return view('Contributor/UploadImages/index')->with('message', 'No images found');
            }
        } else {
            return view('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Imagecategorys = imagecategory::all();


        return view('Contributor/UploadImages/create')->with('Imagecategorys',$Imagecategorys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'catid' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|min:2000',
            'tags' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;

            // Save a copy of the original image
            $originalImagePath = $destinationPath . 'original_' . $profileImage;
            File::copy($destinationPath . $profileImage, $originalImagePath);

            // Apply watermark to the copied image
            $watermarkedImage = InterventionImage::make($originalImagePath)
                ->insert(public_path('watermark.png'), 'bottom-right', 10, 10)
                ->save($destinationPath . 'watermarked_' . $profileImage);

            // Update the input image path with the watermarked image
            $input['image'] = 'watermarked_' . $profileImage;
        }

        $input['userid'] = $user_id;

        $tags = explode(",", $request->tags);
        $image = ImageModel::create($input);
        $image->tag($tags);

        return redirect()->route('UploadImages.create')
            ->with('success', 'Image uploaded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejected()
    {
        if (Auth::user()->role == 'user') {
            $users = Auth::user();
            $user_id = Auth::id();

            // Set the time range from 3 days ago to tomorrow
            $from = Carbon::today()->subDays(3)->toDateTimeString();
            $to = Carbon::parse(Carbon::tomorrow())->toDateTimeString();

            $images = RejectedImage::select('rejected_images.*', 'images.*', 'rejected_images.rejection_reason')
                ->leftJoin('images', 'rejected_images.image_id', '=', 'images.id')
                ->where('images.userid', $user_id)
                ->where('images.state', 2)
                ->whereBetween('images.created_at', [$from, $to])
                ->get();

            if ($images->count() > 0) {
                return view('/Contributor/UploadImages/rejected')->with('images', $images)->with('message', ' ');
            } else {
                return view('/Contributor/UploadImages/rejected')->with('message', 'No images found');
            }
        } else {
            return view('/');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role == 'user') {
            $users = Auth::user();
            $user_id = Auth::id();

            // Set the time range from 3 days ago to tomorrow
            $from = Carbon::today()->subDays(3)->toDateTimeString();
            $to = Carbon::parse(Carbon::tomorrow())->toDateTimeString();

            $images = ImageModel::where('userid', $user_id)
                ->where('state', 1)
                ->whereBetween('created_at', [$from, $to])
                ->get();

            if ($images->count() > 0) {
                return view('Contributor/UploadImages/submitted')->with('images', $images)->with('message', ' ');
            } else {
                return view('Contributor/UploadImages/submitted')->with('message', 'No images found');
            }
        } else {
            return view('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ImageModel::find($id);
        $image->delete();

        return redirect()->back()->with('message', 'Image deleted successfully');
    }
}
