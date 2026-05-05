<?php

namespace App\Services;

use App\Models\GalleryImage;

class GalleryService
{
    public function getAll()
    {
        return GalleryImage::latest()->paginate(10);
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
