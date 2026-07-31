<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::published()->ordered()->get();

        // Only offer filters that actually match something — with a handful of
        // photos in one category the chips would otherwise filter to nothing.
        $categories = collect(GalleryImage::CATEGORIES)
            ->only($images->pluck('category')->unique()->all())
            ->all();

        return view('pages.gallery', [
            'images' => $images,
            'categories' => count($categories) > 1 ? $categories : [],
        ]);
    }
}
