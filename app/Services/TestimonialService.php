<?php

namespace App\Services;

use App\Models\Testimonial;

class TestimonialService
{
    public function getAllActive()
    {
        return Testimonial::where('is_active', true)->get();
    }

    public function getAll()
    {
        return Testimonial::all();
    }

    public function getById($id)
    {
        return Testimonial::findOrFail($id);
    }

    public function create(array $data)
    {
        return Testimonial::create($data);
    }

    public function update($id, array $data)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($data);
        return $testimonial;
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return $testimonial->delete();
    }
}
