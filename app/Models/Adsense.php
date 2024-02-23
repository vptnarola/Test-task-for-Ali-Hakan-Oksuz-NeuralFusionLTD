<?php

namespace App\Models;

use App\Enum\AdsensePosition;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adsense extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function (Adsense $adsense) {
            $adsense->slug = str()->slug($adsense->name);
        });

        static::updating(function (Adsense $adsense) {
            $adsense->slug = str()->slug($adsense->name);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'banner_width',
        'banner_height',
        'banner_image',
        'url',
        // 'position',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        // 'position' => AdsensePosition::class,
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attribute): string =>
                asset('upload/ads_images/' . $attribute['banner_image'])
        );
    }
}
