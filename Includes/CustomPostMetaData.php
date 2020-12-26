<?php

namespace Inc;

class CustomPostMetaData
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'addCustomBox']);
        add_action('save_post', [$this, 'savePostMeta']);
    }

    public function addCustomBox()
    {
        $screens = ['post'];

        foreach ($screens as $sreen) {
            add_meta_box(
                'wporg_box_id',
                'Custom meta box title',
                [$this, 'wporg_custom_box_html'],
                $sreen
            );
        }
    }

    public function wporg_custom_box_html($post)
    {
        $value = get_post_meta($post->ID, '_wporg_meta_key', true);
        ?>
            <label for="wporg_field">Description for the field</label>
            <select name="wporg_field" id="wporg_field" class="postbox">
                <option value="some" <?php selected($value, 'some'); ?>>Some</option>
                <option value="thing" <?php selected($value, 'thing'); ?>>Thing</option>
                <option value="here" <?php selected($value, 'here'); ?>>Here</option>
            </select>
        <?php
    }

    public function savePostMeta($post_id)
    {
        if (array_key_exists('wporg_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field']
            );
        }
    }

}