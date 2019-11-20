<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function upload(Request $request) {
        if (count($request->images)) {
            foreach($request -> images as $image) {
                $image->store('public');
            }
        }
        return response ()->json([
            'message' => 'Done'
        ]);
    }

    public function index()
    {
        $files = Storage::files('public');

        return view('welcome', compact('files'));
    }
}
