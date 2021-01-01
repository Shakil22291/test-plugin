<?php

namespace Inc;

class TestPostType
{
    public function __construct()
    {
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        register_post_type(
            'wporg_product',
            array(
                'labels' => [
                    'name' => 'Products',
                    'singular' => 'Product'
                ],
                'public' => true,
                'has_archive' => true,
            )
        );
    }
}