<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request, TagService $service)
    {
        $page = $request->input('page');
        $perPage = $request->input('perPage');

        $tags = $service->getTagsList(false, $page, $perPage);

        return TagResource::collection($tags);
    }
}
