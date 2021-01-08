<?php

namespace Inc;

class Init
{
    public static function get_services()
    {
        return [
            WPorgMetaBox::class,
            DeletePost::class,
            CustomSettingPage::class,
            TestPostType::class,
            UserBirthDay::class
        ];
    }

    public function register_services()
    {
        foreach (self::get_services() as $class) {
            $this->instantiate($class);
        }
    }

    private function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
