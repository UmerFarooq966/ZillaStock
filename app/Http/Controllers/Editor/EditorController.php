<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function Editor()
    {

        return view('Editor.editor');
    }

    public function showEditor(Request $request)
    {
        $imageUrl = $request->input('url');
       // dd($imageUrl);
        return view('Editor/editor', ['imageUrl' => $imageUrl]);
    }


}
