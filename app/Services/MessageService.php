<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function getAll()
    {
        return Message::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return Message::create($data);
    }

    public function delete($id)
    {
        return Message::findOrFail($id)->delete();
    }

    public function markAsReplied($id)
    {
        return Message::findOrFail($id)->update(['is_replied' => true]);
    }
}
