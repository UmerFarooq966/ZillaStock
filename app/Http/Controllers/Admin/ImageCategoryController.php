<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\imagecategory;
use Illuminate\Http\Request;

class ImageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->role == 'admin') {
            $Imagecategorys = ImageCategory::with('images')->get();

            return view('Admin.ImageCategory.index')->with('Imagecategorys', $Imagecategorys);
        } elseif (auth()->user()->role == 'editor') {
            return redirect()->route('editor.home');
        } else {
            return redirect()->route('home');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.ImageCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $input = $request->all();
        $imagecategory = imagecategory::create($input);

        return redirect()->route('ImageCategory.index',$imagecategory->id)
            ->with('success','Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ImageCategory::findOrFail($id);
        $images = Image::where('catid', $category->id)->get();
        $Imagecategorys = ImageCategory::with('images')->get(); // Add this line to fetch the categories

        return view('Admin.ImageCategory.index', compact('category', 'images', 'Imagecategorys'));
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
        $category = ImageCategory::findOrFail($id);

        if ($category->images()->count() === 0) {
            return redirect()->route('ImageCategory.edit', $category)
                ->with('error', 'No images in this category to update prices.');
        }

        $price = $request->input('price');

        $category->images()->update(['price' => $price]);

        return redirect()->route('ImageCategory.edit', $category)
            ->with('success', 'Image prices updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= imagecategory::find($id);
        $category->delete();

        return redirect()->route('ImageCategory.index')
            ->with('success','Type deleted successfully');
    }
}
