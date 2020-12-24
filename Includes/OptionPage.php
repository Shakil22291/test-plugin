<?php

namespace Inc;

class OptionPage
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'setPage']);
        add_action('admin_init', [$this, 'settingsInit']);
    }

    public function settingsInit()
    {
        // Register a new setting fom 'test-option' page
        register_setting('test_settings', 'test_option_name');

        // Register a new section in the reading page
        add_settings_section(
            'test_section',
            'Test Section Title',
            [$this, 'settingsSectionCallback'],
            'test_option'
        );

        // Register a new setting field in the 'test_section' section, inside the 'test_optin' page
        add_settings_field(
            'test_option',
            'This is test field',
            [$this, 'settingsFieldCallback'],
            'test_option',
            'test_section'
        );

    }

    public function settingsSectionCallback()
    {

    }

    public function settingsFieldCallback()
    {
        $setting = get_option('test_option_name') ?? null ;
        echo "
            <input class='widefat' type='text' name='test_option_name' value='{$setting}' />
        ";
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
        require_once MYPLUGIN_PATH . 'templates/test-option.php';
    }
}
