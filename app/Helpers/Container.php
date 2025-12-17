<?php
  
namespace App\Helpers;

class Container
{
    private static array $containner = [];
    
    public static function set(string $key, $value)
    {
        self::$containner[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {   
        return self::$containner[$key] ?? $default;
    }
}