<?php

namespace App;


use Cache;

class Matriushka
{
    protected static $keys = [];

    public static function setUp($model)
    {
        ob_start();
        static::$keys[] = $key = $model->getCacheKey();

        return Cache::tags('views')->has($key);
    }

    public static function tearDown()
    {
        $key = array_pop(static::$keys);

        $html  = ob_get_clean();

        return Cache::tags('views')
            ->rememberForever($key, function () use ($html) {
            return $html;
        });
    }
}