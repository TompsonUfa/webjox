<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getTagsList($pagination, $page, $perPage = 10)
    {
        $tags = Tag::query();

        if ($pagination) {
            return $tags->paginate($perPage, ['*'], 'page', $page);
        }

        return $tags->get();
    }
}
