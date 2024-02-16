<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function index(Request $request, ImageService $service)
    {
        $page = $request->input('page');
        $perPage = $request->input('perPage');

        $images = $service->getImageList($page, $perPage);

        return ImageResource::collection($images);
    }

    public function store(ImageRequest $request, ImageService $service)
    {
        $image = $request->file('image');

        return $service->uploadImage($image);
    }

    public function destroy(Image $image, ImageService $service)
    {
       return $service->deleteImage($image);
    }
}
