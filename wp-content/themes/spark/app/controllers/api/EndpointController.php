<?php

class EndpointController extends WP_REST_Controller
{
    protected $namespace = 'spark/v';
    protected $version   = '1';
    protected $resource  = 'post-type';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register']);
    }

    public function register()
    {
        $namespace = $this->namespace . $this->version;

        register_rest_route($namespace, '/' . $this->resource, [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'getPost'],
                'permission_callback' => [$this, 'getPostPermission']
            ],
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'createPost'],
                'permission_callback' => [$this, 'createPostPermission']
            ]
        ]);
    }

    public function getPost(WP_REST_Request $request)
    {
        return 'getPost()';
    }

    public function getPostPermission()
    {
        return true;
    }

    public function createPost(WP_REST_Request $request)
    {
        return 'createPost()';
    }

    public function createPostPermission()
    {
        return true;
    }
}

$boot = new EndpointController();
