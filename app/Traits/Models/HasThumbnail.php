<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\File;

trait HasThumbnail
{
    abstract protected function thumbnailDir(): string;

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function makeThumbnail(
        string $size,
        string $method = 'resize'
    ): string {
        return route('thumbnail', [
            'size' => $size,
            'method' => $method,
            'file' => File::basename($this->{$this->thumbnailColumn()}),
            'dir' => $this->thumbnailDir(),
        ]);
    }
}