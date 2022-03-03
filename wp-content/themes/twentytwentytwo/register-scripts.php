<?php

add_action('wp_enqueue_scripts', 'register_bc_plumbing_accordion_scripts');
function register_bc_plumbing_accordion_scripts() {
    wp_register_style('bootstrap-4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_register_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css', array(), '1.3.0', 'all');
    wp_register_style('bc-accordion', get_template_directory_uri() . '/assets/accordion/accordion.css', array('bootstrap-4'), '1.0', 'all');
    wp_register_script('jQuery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jQuery'), '4.6', true);
    wp_register_script('bc-accordion', get_template_directory_uri() . '/assets/accordion/accordion .js', array('bootstrap'), '1.0', true);
}
