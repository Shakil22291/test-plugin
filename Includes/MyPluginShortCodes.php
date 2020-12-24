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
        add_shortcode('wporg', [$this, 'wporgView']);
        add_shortcode('test', [$this, 'testView']);
    }

    public function testView($atts = [], $content = null, $tag = '')
    {
        return require_once MYPLUGIN_PATH . "/templates/test-shortcode.php";
    }


    /**
     * The [wporg] shortcode.  Accepts a title and will display a box.
     *
     * @param array  $atts     Shortcode attributes. Default empty.
     * @param atring $content  Shortcode content. Default null.
     * @param string $tag      Shortcode tag (name). Default empty.
     *
     * @return string
     */
    public function wporgView($atts = [], $content = null, $tag = '')
    {
        //Normalize the attribute key to lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);

        // Overwrite default attribute with user attributes
        $wporg_atts = shortcode_atts(
            [
                'title' => 'Wordpress.org',
            ],
            $atts,
            $tag
        );

        // Start building box
        $o = "<div class='wporg-box'>";

        //title
        $o .= "<h2> ". $wporg_atts['title'] ." </h2>";

        if ( ! is_null($content) ) {
            // Secure output by executing the content filter hook on $content
            $o .= $content;

            // Run the shortcode parser recursively
            // $o .= do_shortcode($content);
        }

        $o .= "</div>";

        return $o;
    }
}
