<?php

namespace App\Services;

use App\Models\Video;

class VideoService
{
    public function getAll()
    {
        return Video::latest()->paginate(10);
    }

    public function getAllActive()
    {
        return Video::where('is_active', true)->latest()->get();
    }

    public function create(array $data)
    {
        return Video::create($data);
    }

    public function update($id, array $data)
    {
        $video = Video::findOrFail($id);
        $video->update($data);
        return $video;
    }

    public function delete($id)
    {
        return Video::destroy($id);
    }
}
