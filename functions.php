<?php

// Enqueue parent and child theme styles
add_action( 'wp_enqueue_scripts', 'blaze_commerce_child_enqueue_styles' );

function blaze_commerce_child_enqueue_styles() {
    $parent_handle = 'blaze-commerce-style'; // Handle for the parent theme's stylesheet
    $parent_version = wp_get_theme()->parent()->get( 'Version' ); // Get the parent theme's version
    $child_version = wp_get_theme()->get( 'Version' ); // Get the child theme's version

    // Load the parent theme stylesheet
    wp_enqueue_style( $parent_handle, get_template_directory_uri() . '/style.css', [], $parent_version );

    // Load the child theme stylesheet
    wp_enqueue_style( 'blaze-commerce-child-style', get_stylesheet_uri(), [ $parent_handle ], $child_version );
}


// Require plugins installations - http://tgmpluginactivation.com/configuration/
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'blz_register_required_plugins' );

function blz_register_required_plugins() {
    $plugins = [
        [
            'name'     => 'WooCommerce',
            'slug'     => 'woocommerce',
            'required' => true,
        ],
        [
            'name'     => 'WPGraphQL',
            'slug'     => 'wp-graphql',
            'required' => true,
        ],
        [
            'name'               => 'Blaze Commerce',
            'slug'               => 'blazecommerce-wp-plugin-main',
            'source'             => 'https://blazecommercechildthemeplugins.s3.us-east-2.amazonaws.com/blazecommerce-wp-plugin-main.zip',
            'required'           => true,
            'version'            => '1.5.1',
            'force_activation'   => true,
            'force_deactivation' => true,
        ],
        [
            'name'               => 'WPGraphQL CORS',
            'slug'               => 'wp-graphql-cors',
            'source'             => 'https://blazecommercechildthemeplugins.s3.us-east-2.amazonaws.com/wp-graphql-cors.zip',
            'required'           => true,
            'version'            => '2.1',
            'force_activation'   => true,
            'force_deactivation' => true,
        ],
        [
            'name'               => 'WooGraphQL',
            'slug'               => 'wp-graphql-woocommerce',
            'source'             => 'https://blazecommercechildthemeplugins.s3.us-east-2.amazonaws.com/wp-graphql-woocommerce.zip',
            'required'           => true,
            'version'            => '0.19.0',
            'force_activation'   => true,
            'force_deactivation' => true,
        ],
        [
            'name'               => 'WPGraphQL JWT Authentication',
            'slug'               => 'wp-graphql-jwt-authentication',
            'source'             => 'https://blazecommercechildthemeplugins.s3.us-east-2.amazonaws.com/wp-graphql-jwt-authentication.zip',
            'required'           => true,
            'version'            => '0.7.0',
            'force_activation'   => true,
            'force_deactivation' => true,
        ],
        [
            'name'     => 'Create Block Theme',
            'slug'     => 'create-block-theme',
            'required' => true,
        ],
        [
            'name'     => 'The Icon Block',
            'slug'     => 'icon-block',
            'required' => true,
        ],
        [
            'name'     => 'Gutenberg',
            'slug'     => 'gutenberg',
            'required' => true,
        ],
        [
            'name'     => 'Draft – Tailwind CSS for WordPress.',
            'slug'     => 'website-builder',
            'required' => true,
        ],
    ];

    $config = [
        'id'           => 'blz',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    ];

    tgmpa( $plugins, $config );

}