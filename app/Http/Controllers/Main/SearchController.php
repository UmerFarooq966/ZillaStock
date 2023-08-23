<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Conner\Tagging\Model\Tag;
use Conner\Tagging\Model\Tagged;
use Conner\Tagging\Providers\TaggingServiceProvider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
public function search(Request $request)
    {

        $q = $request->input('q');

        // Split the query into an array of words
        $keywords = explode(' ', $q);

        // Search for images based on their name
        $images = Image::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
            }
        })->get();

        // Search for images based on their tags' slugs
        $tagIds = Tag::whereIn('slug', $keywords)->pluck('id');
        $taggedImages = Tagged::whereIn('id', $tagIds)->pluck('taggable_id');
        $taggedImages = Image::whereIn('id', $taggedImages)
            ->get();

        // Merge the results and remove duplicates
        $results = $images->merge($taggedImages)->where('state',1)->unique('id');

        if($results->count() > 0) {
            return view('I-layouts.search')->withImages($results)->withQuery($q);
        } else {
            return view('index')->withMessage('No results found. Try to search again!');
        }

    }


    public function show($id)
    {


        $image = Image::find($id);

        // Get the user ID associated with the image
        $user_id = $image->userid;

        // Join the users and user_profiles tables to retrieve the user's name and profile pic
        $user = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.id', '=', $user_id)
            ->select('users.name', 'user_profiles.avatar')
            ->first();
//dd($user);

        // Get the image's tags
        $tags = Image::findOrFail($id)->tags;

// Get the tag IDs associated with the image
        $tagIds = $tags->pluck('id');

// Search for images based on their tags' IDs
        $taggedImages = Tagged::whereIn('id', $tagIds)->pluck('taggable_id');
        $images = Image::whereIn('id', $taggedImages)
            ->where('id', '<>', $id) // Exclude the current image
            ->where('state', 1) // Filter by state
            ->get();

    //dd($tags);

        return view('I-layouts.show', [
            'image' => $image,
            'user' => $user,
            'images' => $images->isEmpty() ? null : $images,
            'message' => $images->isEmpty() ? 'No related images found.' : null,
        ]);
    }


}
