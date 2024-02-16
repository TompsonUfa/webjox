<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, PostService $service)
    {
        $search = $request->input('search');
        $page = $request->input('page');
        $perPage = $request->input('perPage');

        $posts = $service->getPostsList($search, true, $page, $perPage, false);

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostDetailResource($post);
    }

    public function store(PostCreateRequest $request, PostService $service)
    {
        $imageId = $request->input('image');
        $title = $request->input('title');
        $desc = $request->input('desc');
        $tags = $request->input('tags');
        $content = $request->input('content');
        $published = $request->boolean('published');

        return $service->createPost($imageId, $title, $desc, $tags, $content, $published);
    }

    public function update(Post $post, PostCreateRequest $request, PostService $service)
    {
        $imageId = $request->input('image');
        $title = $request->input('title');
        $desc = $request->input('desc');
        $tags = $request->input('tags');
        $content = $request->input('content');
        $published = $request->boolean('published');

        return $service->updatePost($imageId, $post, $title, $desc, $tags, $content, $published);
    }

    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
