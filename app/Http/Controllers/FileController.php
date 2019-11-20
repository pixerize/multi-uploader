<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function destroy(Request $request){
        Storage::delete($request->get('image'));
        return response ()->json([
            'message' => 'Done'
        ]);
    }
}
