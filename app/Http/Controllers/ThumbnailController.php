<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function __invoke(string $dir, string $method, string $size, string $file): BinaryFileResponse
    {
        abort_if(
            !in_array($size, config('thumbnail.allowed_sizes', [])),
            403,
            'Size is not allowed'
        );

        $storage = Storage::disk('images');

        $real_path = "$dir/$file";
        $new_dir_path = "$dir/$method/$size";
        $result_path = "$new_dir_path/$file";

        if (!$storage->exists($new_dir_path)) {
            $storage->makeDirectory($new_dir_path);
        }

        if (!$storage->exists($result_path)) {
            $image = Image::make($storage->path($real_path));

            [$width, $height] = explode('x', $size);

            $image->{$method}($width, $height);

            $image->save($storage->path($result_path));
        }

        return response()->file($storage->path($result_path));
    }
}