<?php

namespace App\Services;

use App\Models\GalleryImage;

class GalleryService
{
    public function getAll()
    {
        return GalleryImage::all();
    }

    public function create(array $data)
    {
        return GalleryImage::create($data);
    }

    public function delete($id)
    {
        return GalleryImage::destroy($id);
    }
}
