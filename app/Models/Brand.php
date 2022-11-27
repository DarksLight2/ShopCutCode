<?php

namespace App\Models;

use App\QueryBuilders\BrandQueryBuilder;
use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static BrandQueryBuilder|Brand query()
 */
class Brand extends Model
{
    use HasFactory;
    use HasThumbnail;

    protected $fillable = [
        'title',
        'on_home_page',
        'sorting',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected function thumbnailDir(): string
    {
        return 'brands';
    }
}
