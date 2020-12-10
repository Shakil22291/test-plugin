<?php

namespace Inc;

class MyPluginShortCodes
{
    public function __construct()
    {
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        add_shortcode('test-shortcode', [$this, 'test']);
    }


    public function test($attr = [], $content = null)
    {
        return "This i s some content inside the shortcode";
    }

}