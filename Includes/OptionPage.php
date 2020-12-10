<?php

namespace Inc;

class OptionPage
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'setPage']);
    }

    public function setPage()
    {
        // remove_menu_page('options-general.php');
        // Add the menu page
        add_menu_page(
            'Test Option',
            'Test Option',
            'manage_options',
            'test_option',
            [$this, 'view'],
        );
    }

    public function view()
    {
        require_once MYPLUGIN_PATH . "templates/test-option.php";
    }
}