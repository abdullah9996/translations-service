<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'content',
        'tag',
        'locale'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            self::refreshTranslationCache();
        });

        static::deleted(function () {
            self::refreshTranslationCache();
        });

        static::updated(function(){
            self::refreshTranslationCache();
        });
    }

    public static function preloadTranslations()
    {
        if (!Cache::has('translations_export')) {
            self::refreshTranslationCache();
        }
    }

    public static function refreshTranslationCache()
    {
        Cache::rememberForever('translations_export', function() {
            // Optimized query with only needed columns
            return self::select(['key', 'value', 'locale'])->get();
        });
    }
}
