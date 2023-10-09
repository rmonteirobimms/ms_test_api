<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\TempFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('imageURL')) {
            $file = $request->file('imageURL');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/tmp/' . $folder, $filename);

            TempFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }
}
