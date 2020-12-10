<?php

namespace Inc;

class TestPlugin
{
    public function activate()
    {
        add_option('test-plugin-ejxample', 'Example value');
    }

    public function deactivate()
    {
        delete_option('test-plugin-example');
    }

    public function run()
    {
        $init = new Init();
        $init->register_services();
    }

}