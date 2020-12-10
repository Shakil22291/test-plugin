<?php

namespace Inc;

class OptionSubpage
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'register']);
    }

    public function register()
    {
        add_submenu_page(
          'test_option',
          'Option Subpage',
          'Option Subpage',
          'manage_options',
          'option_subpage',
          [$this, 'view']
        );
    }

    public function view()
    {
        echo "
            <div class='wrap'>This is Option subpage</div>
        ";
    }
}
