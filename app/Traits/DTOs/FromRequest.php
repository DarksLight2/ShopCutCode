<?php

namespace App\Traits\DTOs;

use App\Traits\Makeable;
use Illuminate\Http\Request;

trait FromRequest
{

    use Makeable;

    abstract protected static function getParams(): array;

    public static function fromRequest(Request $request): self
    {
        return self::make(...$request->only(self::getParams()));
    }
}