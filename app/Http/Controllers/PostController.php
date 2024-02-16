<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostShowResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, PostService $service)
    {
        $page = $request->input('page');
        $perPage = $request->input('perPage');

        $posts = $service->getPostsList('', true, $page, $perPage, true);

        return PostResource::collection($posts);
    }
    public function show(Post $post)
    {
        if(!$post->published){
            return response()->json('', 404);
        }

        return new PostShowResource($post);
    }
}
