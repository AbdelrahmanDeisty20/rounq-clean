<?php

namespace App\Services;

use App\Models\Offer;

class OfferService
{
    public function getAllActive()
    {
        return Offer::where('is_active', true)->get();
    }

    public function getAll()
    {
        return Offer::all();
    }

    public function getById($id)
    {
        return Offer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Offer::create($data);
    }

    public function update($id, array $data)
    {
        $offer = Offer::findOrFail($id);
        $offer->update($data);
        return $offer;
    }

    public function delete($id)
    {
        $offer = Offer::findOrFail($id);
        return $offer->delete();
    }
}
