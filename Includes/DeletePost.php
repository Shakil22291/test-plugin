<?php

namespace Inc;

class DeletePost
{
    public function __construct()
    {
        if (current_user_can('edit_others_posts')) {
            add_filter('the_content', [$this, 'generateLink']);
            add_action('init', [$this, 'delete']);
        }
    }

    /**
     * Generate the post delete link
     *
     * @param string $content Existing content
     *
     * @return string|null
     */
    public function generateLink($content)
    {
        if (is_single() && in_the_loop() && is_main_query()) {
            $url = add_query_arg(
                [
                    'action' => 'testplugin_frontend_delete',
                    'post'   => get_the_ID(),
                ],
                home_url()
            );

            return $content . "<a href='{$url}' style='color: red;'>Delete this post post</a>";
        }
        return $content;
    }

    /**
     * Request Hndaler
     */
    public function delete()
    {
        if (isset($_GET['action']) && $_GET['action'] === 'testplugin_frontend_delete') {
            // Verify we have a post id
            $post_id = isset($_GET['post']) ? $_GET['post'] : null;

            // Verify there is a post wit such a number
            $post = get_post((int) $post_id);
            if (empty($post)) {
                return;
            }

            // Delete the post
            wp_trash_post($post_id);

            // Redirect to the main page
            $redirect = admin_url('edit.php');
            wp_safe_redirect($redirect);

            // We are done
            die();
        }
    }
}
