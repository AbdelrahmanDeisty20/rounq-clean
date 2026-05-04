<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{
    public function getAllActive()
    {
        return Faq::where('is_active', true)->get();
    }

    public function getAll()
    {
        return Faq::all();
    }

    public function getById($id)
    {
        return Faq::findOrFail($id);
    }

    public function create(array $data)
    {
        return Faq::create($data);
    }

    public function update($id, array $data)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($data);
        return $faq;
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        return $faq->delete();
    }
}
