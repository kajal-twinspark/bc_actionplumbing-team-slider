<?php

/* Accordion Shortcode Start */
add_shortcode('bc_plumbing_accordion', 'bc_plumbing_accordion_shortcode');

function bc_plumbing_accordion_shortcode() {
    $content = file_get_contents(get_template_directory_uri().'/templates/accordion.php');
    return $content;
}

/* Accordion Shortcode End */

/* Accordion EnqueueScripts Start */

add_action('wp_enqueue_scripts', 'enqueue_bc_plumbing_accordion_scripts');


function enqueue_bc_plumbing_accordion_scripts() {
    global $post;
    if (has_shortcode($post->post_content, 'bc_plumbing_accordion')) {
        wp_enqueue_style('bc-accordion');
        wp_enqueue_style('bootstrap-icons');
        wp_enqueue_script('bc-accordion');
    }
}

/*Accordion EnqueueScripts End*/

