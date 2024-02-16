<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function getPostsList($search, $pagination, $page, $perPage = 10, $postActive)
    {
        $posts = Post::query();

        if (!empty($search)) {
            $posts->where('title', 'like', $search . '%');
        }

        if(!empty($postActive)){
            $posts->where('published', 1);
        }

        if ($pagination) {
            return $posts->paginate($perPage, ['*'], 'page', $page);
        }

        return $posts->get();
    }
    public function createPost($imageId, $title, $desc, $tags, $content, $published)
    {
        try {
            DB::beginTransaction();

            $post = new Post();

            $post->image()->associate($imageId);
            $post->title = $title;
            $post->desc = $desc;
            $post->content = $content;
            $post->published = $published;
            $post->save();
            $post->refresh();

            $post->tags()->attach($tags);

            DB::commit();

            return response()->json(['success' => true], 201);
        } catch (\Exception $e){
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updatePost($imageId, $post, $title, $desc, $tags, $content, $published)
    {
        try {
            DB::beginTransaction();

            $post->image()->associate($imageId);
            $post->title = $title;
            $post->desc = $desc;
            $post->content = $content;
            $post->published = $published;
            $post->save();

            $post->tags()->sync($tags);

            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e){
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
