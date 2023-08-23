<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $favourites = Favourite::where('user_id', $user_id)
            ->join('images', 'images.id', '=', 'Favourites.image_id')
            ->get();

//dd($favorites);
        if (!empty($favourites)) {
            return view('Buyer.Favourites')->with('favourites', $favourites);
        } else {
            return view('Buyer.Favourites')->with('message', 'No favourites found.');
        }
    }


    public function save(Request $request)
    {
        $user = Auth::user();
        $imageId = $request->input('image_id');

        $favorite = new Favourite();
        $favorite->user_id = $user->id;
        $favorite->image_id = $imageId;
        $favorite->save();

        return response()->json(['success' => true]);
    }

    public function removeFromFavorites(Request $request, $id)
    {
        $user = Auth::user();

        $favorite = Favourite::where('user_id', $user->id)
            ->where('image_id', $id)
            ->firstOrFail();

        $favorite->delete();

        return response()->json(['success' => true]);
    }







}
