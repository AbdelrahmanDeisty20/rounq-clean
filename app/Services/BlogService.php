<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    public function getPublished($limit = 3)
    {
        return Blog::where('is_active', true)->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function getAll()
    {
        return Blog::all();
    }

    public function getById($id)
    {
        return Blog::findOrFail($id);
    }

    public function create(array $data)
    {
        return Blog::create($data);
    }

    public function update($id, array $data)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($data);
        return $blog;
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }
}
