<?php

namespace Inc;

class TestPlugin
{
    public function activate()
    {
        add_option('test-plugin-example', 'Example value');
    }

    public function deactivate()
    {
        delete_option('test-plugin-example');
    }

    public function run()
    {
        Init::register_services();
    }

}