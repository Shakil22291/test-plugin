<?php

namespace Inc;

class CustomSettingPage
{
    public function __construct()
    {
        /**
         * Register our wporgSettingsInit to the admin init action hook.
         */
        add_action('admin_init', [$this, 'wporgSettingsInit']);

        /**
         * Register our wporgOptionsPage to the admin_menu action hook.
         */
        add_action('admin_menu', [$this, 'wporgOptionsPage']);
    }

    /**
     * custom option and settings
     */
    public function wporgSettingsInit()
    {
        // Register a new setting for "wporg" page
        register_setting('wporg', 'wporg_options');

        // Register a new section in the "wporg" page
        add_settings_section(
            'wporg_section_developers',
            'The Matrix has you',
            [$this, 'wporg_section_developers_callback'],
            'wporg'
        );

        // Register a new field in the "wporg_section_developers" section, inside the "wporg" page
        add_settings_field(
            'wporg_filled_pill',
            "Pill",
            [$this, 'wporg_field_pill_cb'],
            'wporg',
            'wporg_section_developers',
            array(
                'label_for' => 'wporg_field_pill',
                'class' => 'wporg_row',
                'wporg_custom_data' => 'custom'
            )
        );


        //  test *********
        register_setting('wporg', 'another options');
        add_settings_field(
            'wporg_another_option',
            "Another Option",
            [$this, 'wporg_field_another_cb'],
            'wporg',
            'wporg_section_developers',
            array(
                'label_for' => 'wporg_field_another',
                'class' => 'wporg_row',
                'wporg_custom_data' => 'custom'
            )
        );

    }

    public function wporg_field_another_cb( $args )
    {
        echo "<input type='text' placeholder='thats something' />";
    }


    /**
     * Developers section callback function
     *
     * @param array $args The settings array, defining title, id, callback.
     */
    public function wporg_section_developers_callback($args)
    {
        ?>
            <p id="<?= esc_attr($args['id']); ?>">
                <?php esc_html_e('Follow the white rabbit'); ?>
            </p>
        <?php
    }

    /**
     * Pill field callback function.
     *
     * WordPress has magic interaction with the following keys: label_for, class.
     * - the "label_for" key value is used for the "for" attribute of the <label>.
     * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
     * Note: you can add custom key value pairs to be used inside your callbacks.
     *
     * @param array $args
     */
    public function wporg_field_pill_cb($args)
    {
        // get the value of the setting we've registerd with register_setting()
        $options = get_option('wporg_options');
        ?>
            <select
                id="<?= esc_attr($args['label_for']); ?>"
                name="wporg_options[<?= esc_attr($args['label_for']); ?>]"
                data-custom="<?= esc_attr($args['wporg_custom_data']); ?>"
            >
                <option value="red" <?= isset($options[$args['label_for']]) ? ( selected($options[$args['label_for']], 'red', false) ) : ( "" ); ?>>
                    <?= esc_html('red pill') ?>
                </option>
                <option value="blue" <?= isset($options[$args['label_for']]) ? ( selected($options[$args['label_for']], 'blue', false) ) : ( "" ); ?>>
                    <?= esc_html('blue pill') ?>
                </option>
            </select>
            <p class="description">
                You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.
            </p>
            <p class="description">
                You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.
            </p>
        <?php
    }

    /**
     * Add a top level menu page
     */
    public function wporgOptionsPage()
    {
        add_menu_page(
            'Wporg',
            'Wporg Options',
            'manage_options',
            'wporg',
            [$this, 'wporg_options_page_html']
        );
    }

    /**
     * Top level menu callback function
     */
    public function wporg_options_page_html()
    {
        // check the user capability
        if ( ! current_user_can('manage_options') ) {
            return;
        }
        // add error/update messages

        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'wporg_messages', 'wporg_message','Settings Saved okay', 'updated' );
        }

        // show error/updated messages
        settings_errors('wporg_messages');

        ?>
            <div class="wrap">
                <h1><?= esc_html(get_admin_page_title()); ?></h1>
                <form action="options.php" method="POST">
                    <?php
                        // output security field for the registered settings "wporg".
                        settings_fields('wporg');
                        // output settings sections and their fields
                        // (sections are registered for "wporg", each field is registerd for specific section)
                        do_settings_sections('wporg');
                        // output the save settins button
                        submit_button();
                    ?>
                </form>
            </div>
        <?php

    }

}
