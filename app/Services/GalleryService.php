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

    public function update($id, array $data)
    {
        $img = GalleryImage::findOrFail($id);
        $img->update($data);
        return $img;
    }

    public function delete($id)
    {
        return GalleryImage::destroy($id);
    }
}
