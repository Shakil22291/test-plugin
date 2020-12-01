<?php

namespace Inc;

class Init
{
    public static function get_services()
    {
        return [
            DeletePost::class
        ];
    }

    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            self::instantiate($class);
        }
    }

    private static function instantiate($class)
    {
        $service = new $class();

        return $service;
    }
}
