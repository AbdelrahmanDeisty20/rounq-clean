<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function getAllActive()
    {
        return Service::where('is_active', true)->get();
    }

    public function getAll()
    {
        return Service::latest()->paginate(10);
    }

    public function getById($id)
    {
        return Service::findOrFail($id);
    }

    public function create(array $data)
    {
        return Service::create($data);
    }

    public function update($id, array $data)
    {
        $service = Service::findOrFail($id);
        $service->update($data);
        return $service;
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);
        return $service->delete();
    }
}
