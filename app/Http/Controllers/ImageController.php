<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $imageFiles = glob(public_path('images/*'));
        $images = [];
        foreach ($imageFiles as $file) {
            $images[] = [
                'filename' => basename($file),
                'path' => 'images/' . basename($file)
            ];
        }
        return view('dashboard', compact('images'));
    }

    public function show($filename)
    {
        $imagePath = 'images/' . $filename;
        if (file_exists(public_path($imagePath))) {
            return view('image.detail', ['imagePath' => $imagePath, 'filename' => $filename]);
        }
        return redirect()->route('dashboard')->with('error', 'Image not found');
    }
}