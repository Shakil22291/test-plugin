<?php

namespace Inc;

class PortFolioPostType
{
    protected $args;

    public function __construct()
    {
        $this->args = $this->setArgs();
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        register_post_type('portfolio', $this->args);
    }

    protected function setArgs(): array
    {
        return [
            'label'  => 'Portfolio',
            'description' => 'This is post descipion',
            'public' => true,
            'hierarchical' => true
        ];
    }
}
