<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\RejectedImage;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{

    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        if (!UserProfile::where('user_id', $user_id)->exists()) {
            // Create a new user profile
            UserProfile::create([
                'user_id' => $user_id,
                // Add other fields as necessary
            ]);
        }

// Retrieve all data from users and user_profiles tables using a left join
        $Profilee = DB::table('users')
            ->leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.id', $user_id)
            ->select('users.*', 'user_profiles.*')
            ->first();
    //dd($Profilee);

       // $user = $request->user();
     //   $Profilee = $user->userProfile;

        return view('Com.Profile')->with('Profilee' , $Profilee);
    }




    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
           // 'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:90048',
            'instagram' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'twitter' => 'required|string|max:255',

        ]);

        $user = Auth::user();
        $userProfile = $user->UserProfile;

        if (!$userProfile) {
            $userProfile = new UserProfile();
            $userProfile->user_id = $user->id;
        }

        if ($request->has('full_name')) {
            $userProfile->full_name = $request->input('full_name');
        }
        if ($request->has('bio')) {
            $userProfile->bio  = $request->input('bio');
        }

        if ($request->has('phone')) {
            $userProfile->phone = $request->input('phone');
        }

        if ($request->has('address')) {
            $userProfile->address = $request->input('address');
        }

        if ($request->has('city')) {
            $userProfile->city = $request->input('city');
        }

        if ($request->has('state')) {
            $userProfile->state = $request->input('state');
        }

        if ($request->has('zip')) {
            $userProfile->zip = $request->input('zip');
        }

        if ($request->has('instagram')) {
            $userProfile->instagram = $request->input('instagram');
        }
        if ($request->has('facebook')) {
            $userProfile->facebook = $request->input('facebook');
        }
        if ($request->has('twitter')) {
            $userProfile->twitter = $request->input('twitter');
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time().'.'.$avatar->getClientOriginalExtension();
            $avatarPath = public_path('images/avatars/');
            $avatar->move($avatarPath, $avatarName);

            $userProfile->avatar = $avatarName;
        }

        $userProfile->save();
//dd($userProfile);
        $message = '';
        if ($request->has('full_name') || $request->has('phone') ||$request->has('bio') || $request->has('address') || $request->has('city') || $request->has('state') || $request->has('zip') || $request->hasFile('avatar') || $request->has('instagram') || $request->has('facebook') ||$request->has('twitter')) {
            $message = 'Profile updated successfully.';

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Error updating profile. Please try again later.');
        }
    }
/**
    public function socials (Request $request)
    {

        $request->validate([
            'instagram' => 'required|url',
            'facebook' => 'required|url',
            'twitter' => 'required|url',

        ]);

        $user = Auth::user();
        $userProfile = $user->UserProfile;

        if (!$userProfile) {
            $userProfile = new UserProfile();
            $userProfile->user_id = $user->id;
        }

        if ($request->has('instagram')) {
            $userProfile->instagram = $request->input('instagram');
        }
        if ($request->has('facebook')) {
            $userProfile->facebook = $request->input('facebook');
        }
        if ($request->has('twitter')) {
            $userProfile->twitter = $request->input('twitter');
        }


        $userProfile->save();
//dd($userProfile);
        $message = '';
        if ($request->has('instagram') || $request->has('facebook') ||$request->has('twitter')) {
            $message = 'Socials updated successfully.';

            return redirect()->back()->with('success', 'Socials updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Error updating Socials. Please try again later.');
        }

    }
**/

    public function show($id)
    {

        $user_id = User::find($id)->id;

        $Profilee = DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.id', '=', $user_id)
            ->select('users.*', 'user_profiles.*')
            ->first();

        $images = Image::where('userid', $user_id )->where('state',1)->get();

//dd($images);

        return view('Com.UserProfile', [
            'Profilee' => $Profilee,
            'images' => $images
        ]);
    }

    public function team($id)
    {

        if (Auth::user()->role == 'admin') {

// Do something for admins


        $user_id = User::find($id)->id;

        $Profilee = DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.id', '=', $user_id)
            ->select('users.*', 'user_profiles.*')
            ->first();

        $images = Image::where('team_id', $user_id)->whereIn('state', [1, 2])
            ->leftJoin('rejected_images', 'images.id', '=', 'rejected_images.image_id')
            ->select('images.*', 'rejected_images.rejection_reason')
            ->get();

        return view('Com.UserProfile', [
            'Profilee' => $Profilee,
            'images' => $images
        ]);

        } else {

            $user_id = User::find($id)->id;

            $Profilee = DB::table('users')
                ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                ->where('users.id', '=', $user_id)
                ->select('users.*', 'user_profiles.*')
                ->first();

            $images = Image::where('userid', $user_id )->where('state',1)->get();

//dd($images);

            return view('Com.UserProfile', [
                'Profilee' => $Profilee,
                'images' => $images
            ]);



        }
    }
}
