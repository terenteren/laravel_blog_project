<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $file = $request->file('file');
        // logger($file);
        // logger($file->isValid());
        // logger($file->extension());
        // logger($file->getClientOriginalName());
        // logger($file->getClientMimeType());

        $dir = date('y/m'); // 202012
        // $path = $file->store( 'uploads/' . $dir, 's3' );
        $path = $file->storePublicly( 'uploads/' . $dir, 's3' );
 
        return response()->json([ 'path' => $path ]);
    }
}