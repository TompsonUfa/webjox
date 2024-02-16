<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function getImageList($page, $perPage = 10)
    {
        return Image::paginate($perPage, ['*'], 'page', $page);
    }

    public function uploadImage($image)
    {
        try {
            DB::beginTransaction();
            $imagePath = $image->store('images', 'public');

            $newImage = new Image();
            $newImage->path = '/' . $imagePath;
            $newImage->save();

            DB::commit();

            return response()->json(['success' => true], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteImage($image): JsonResponse
    {
        try {
            DB::beginTransaction();

            $image->posts()->update(['published' => 0]);

            Storage::disk('public')->delete($image->path);

            $image->delete();

            DB::commit();

            return response()->json(['success' => true], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
