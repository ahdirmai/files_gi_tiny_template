<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function downloadFile($slug)
    {

        $file = Content::where('slug', $slug)->first();
        $media = $file->getFirstMedia($file->contentable->slug);
        // return response()->json($media);
        // dd($media);

        return response()->download($media->getPath(), $file->name . '_' . $media->file_name);
    }
}
