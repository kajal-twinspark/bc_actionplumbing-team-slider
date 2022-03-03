<?php
//Admin menu 
add_action('admin_menu', 'bc_actionPlumbing_admin_menu');

function bc_actionPlumbing_admin_menu() {
    $parent_slug = 'bc_actionPlumbing';
    add_menu_page(__('Banner Settings', 'twentytwentytwo'), __('Banner Settings', 'twentytwentytwo'), 'manage_options', $parent_slug, 'bc_actionPlumbing_banner_settings');
}

function bc_actionPlumbing_banner_settings() {
    include_once 'templates/banner-menu-settings.php';
}
//Save banner settings
add_action('admin_post_save_bc_actionplumbing_banner_settings', 'save_bc_actionplumbing_banner_settings');

function save_bc_actionplumbing_banner_settings() {
    if (isset($_POST['bc_actionPlumbing_banner_settings'])) {
        update_option('bc_actionPlumbing_banner_settings', $_POST['bc_actionPlumbing_banner_settings']);
        wp_redirect(admin_url('admin.php?page=bc_actionPlumbing'));
        exit;
    }
}
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

function bc_actionPlumbing_banner_shortcode() {
    $banner_settings = get_option('bc_actionPlumbing_banner_settings');
    if (!empty($banner_settings)) {
        $title = $banner_settings['title'];
        $content = $banner_settings['content'];
        $btn_text = $banner_settings['button_text'];
        $image_url = $banner_settings['image_url'];
        $btn_url = $banner_settings['button_url'];
    } else {
        $title = 'Lorem Ipsum';
        $content = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quam
              perspiciatis facilis beatae laudantium quidem enim sit sequi!";
        $btn_text = 'Submit';
        $btn_url = '#';
        $image_url = get_template_directory_uri() . '/assets/images/bird-on-salmon.jpg';
    }
    $html = <<<html
     <section id="home" class="section-showcase">
        <article class="banner shoe-white shoe-left spacing" style="background-image: url('$image_url')">
            <h3 class="banner-title">$title</h3>
            <p class="banner__description">
              $content
            </p>
            <a href="$btn_url" class="btn">$btn_text</a>
          </article>
    </section>

html;
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

//
//add_action('admin_init', function () {
//    $banner_content = array(
//        'title' => 'Lorem Ipsum',
//        'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
//        'button_text' => 'Submit',
//        'image_url' => get_template_directory_uri() . '/assets/images/bird-on-salmon.jpg',
//    );
//    $get_banner_content = get_option('bc_actionPlumbing_banner_settings');
//    if (!$get_banner_content) {
//        add_option('bc_actionPlumbing_banner_settings', $banner_content);
//    }
//});
