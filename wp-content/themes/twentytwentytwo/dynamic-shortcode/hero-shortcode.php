<?php


//Admin Enqueue scripts
add_action('admin_enqueue_scripts', 'bc_actionPlumbing_admin_assets');

function bc_actionPlumbing_admin_assets($hook) {
    wp_register_style('bootstrap-4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_register_style('bc-admin-form', get_template_directory_uri() . '/assets/banner/admin-banner.css', array('bootstrap-4'));
    wp_register_script('jQuery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_register_script('bc-admin-form', get_template_directory_uri() . '/assets/banner/banner.js', array('jQuery'));
    if (strpos($hook, 'bc_actionPlumbing')) {
        wp_enqueue_style('bc-admin-form');
        wp_enqueue_script('bc-admin-form');
    }
    wp_enqueue_media();
}
//Add Shortcode
add_shortcode('bc_actionPlumbing_banner', 'bc_actionPlumbing_banner_shortcode');

function bc_actionPlumbing_banner_shortcode($attr) {
    $attr = shortcode_atts(
            array(
                'title'=>'',
                'content'=>'',
                'button_text'=>'',
                'image_url'=>''
            )
            , $attr);
    $image_url = $attr['image_url'];
    $btn_url = $attr['button_url'];
    $btn_text = $attr['button_text'];
    $html = '<section id="home" class="section-showcase">
        <article class="banner shoe-white shoe-left spacing" style="background-image: url('.$image_url.')">
            <h3 class="banner-title">'.$attr['title'].'</h3>
            <p class="banner__description">
              '.$attr["content"].'
            </p>
            <a href="'.$btn_url.'" class="btn">'.$btn_text.'</a>
          </article>
    </section>';
    return $html;
}
// Frontend Script
add_action('wp_enqueue_scripts', 'enqueue_bc_action_plumbing_banner');

function enqueue_bc_action_plumbing_banner() {
    global $post;
    if (has_shortcode($post->post_content, 'bc_actionPlumbing_banner')) {
        wp_enqueue_style('bc-plumbing-banner', get_template_directory_uri() . '/assets/banner/banner.css', array('bootstrap-4'));
    }
}
