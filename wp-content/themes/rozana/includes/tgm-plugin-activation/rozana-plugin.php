<?php
add_action( 'tgmpa_register', 'rozana_register_required_plugins' );

function rozana_register_required_plugins() {

    $plugins = array(
		
		array(
            'name'      => 'Meta Box',
            'slug'      => 'meta-box',
            'required'  => true,
        ),
		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
		array(
            'name'      => 'Projects',
            'slug'      => 'projects-by-woothemes',
            'required'  => false,
        ),
		array(
            'name'      => 'Team member',
            'slug'      => 'our-team-by-woothemes',
            'required'  => false,
        ),
		array(
            'name'      => 'Testimonials',
            'slug'      => 'testimonials-by-woothemes',
            'required'  => false,
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		array(
            'name'      => 'WP PostViews',
            'slug'      => 'wp-postviews',
            'required'  => false,
        ),
		array(
            'name'      => 'WooSidebars',
            'slug'      => 'woosidebars',
            'required'  => false,
        ),
		array(
            'name'      => 'Theme My Login',
            'slug'      => 'theme-my-login',
            'required'  => false,
        ),
		array(
            'name'      => 'MailChimp for WordPress Lite',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
        ),
		array(
            'name'               => 'Rozana Shortcodes',
            'slug'               => 'rozana-bootstrap-shortcodes',
            'source'             => get_stylesheet_directory() . '/includes/plugins/rozana-bootstrap-shortcodes.zip',
            'required'           => false,
            'version'            => '1.2',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
		array(
            'name'               => 'WPBakery Visual Composer',
            'slug'               => 'js_composer',
            'source'             => get_stylesheet_directory() . '/includes/plugins/js_composer.zip',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
		array(
            'name'               => 'Revolution Slider',
            'slug'               => 'revslider',
            'source'             => get_stylesheet_directory() . '/includes/plugins/revslider.zip',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
		array(
            'name'               => 'Envato WordPress Toolkit',
            'slug'               => 'envato-wordpress-toolkit-master',
            'source'             => get_stylesheet_directory() . '/includes/plugins/envato-wordpress-toolkit-master.zip',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
    );
    tgmpa( $plugins );
}