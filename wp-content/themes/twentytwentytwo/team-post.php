<?php

add_action('init', 'add_custom_post_type_slider');

function add_custom_post_type_slider() {
    $labels = array(
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('Team', 'post type singular name'),
        'add_new' => _x('Add New', 'Team'),
        'add_new_item' => __('Add New Team'),
        'edit_item' => __('Edit Team'),
        'new_item' => __('New Team'),
        'all_items' => __('All Teams'),
        'view_item' => __('View Team'),
        'search_items' => __('Search teams'),
        'not_found' => __('No teams found'),
        'not_found_in_trash' => __('No teams found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Teams'
    );

// args array

    $args = array(
        'labels' => $labels,
        'description' => 'Displays teams',
        'public' => true,
        'menu_position' => 4,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
    );

    register_post_type('team', $args);
}

add_action('add_meta_boxes', 'add_teams_meta_boxes');

function add_teams_meta_boxes() {
    add_meta_box('_team_slider_meta_boxes', __('Member Info', 'team'), 'team_meta_boxes_html', 'team');
}

function team_meta_boxes_html() {
    global $post;
    $member_info = get_post_meta($post->ID, 'team_member_info', true);
    // var_dump($member_info);exit;
    if (!empty($member_info)) {
        $name = $member_info['name'];
        $exp = $member_info['working_exp'];
        $designation = $member_info['designation'];
    } else {
        $name = '';
        $exp = '';
        $designation = '';
    }
    $html = "<div class='_team_slider_meta_boxes'><div class='meta_boxe_inputs' >
    <input type='hidden' name='team_member_info' />
         <label>Name</label>
         <input type='text' name='member_name' value='" . $name . "'  />
          <label>Designation</label>
         <input type='text' name='member_designation' value='" . $designation . "'  />
          <label>Working Experience</label>
         <input type='number' name='working_exp' value='" . $exp . "'  />
    </div></div>";
    echo $html;
}

add_action('admin_enqueue_script', 'register_and_enqueue_script');

function register_and_enqueue_script($hook) {
    if (get_post_type() === 'team') {
        
    }
}

add_action('save_post', '_save_meta_box_values');

function _save_meta_box_values() {
    global $post;
    $array = array();

    if (isset($_POST["team_member_info"])) {
        $array['id'] = $array['name'] = sanitize_text_field($_POST['member_name']);
        $array['designation'] = sanitize_text_field($_POST['member_designation']);
        $array['working_exp'] = sanitize_text_field($_POST['working_exp']);
        // var_dump($array);exit;
        update_post_meta($post->ID, 'team_member_info', $array);
    }
}

add_shortcode('team_members_slider', 'team_members_slider_shortcode');

function team_members_slider_shortcode() {

    $post_member = get_posts(
            array(
                'post_type' => 'team',
                'post_status' => 'publish',
                'posts_per_page' => -1,)
    );
    // var_dump($post_member); exit;
    $html = file_get_contents(get_template_directory_uri() . '/inc/patterns/team-post-slider.php');
    if (!empty($post_member)) {
        foreach ($post_member as $post) {
            $member_info = get_post_meta($post->ID, 'team_member_info', true);
            $image_url = get_the_post_thumbnail_url($post->ID);
            $member .= '<div class="swiper-slide team-member-info" >
        <div class="member_image">
             <img src="' . $image_url . '" />
        </div>
        <div class="member_details">
        <h3><span class="member_details_span">Name: </span>' . $member_info["name"] . '</h3>
        <h4><span class="member_details_span">Designation: </span>' . $member_info["designation"] . '</h4>
         <p><span class="member_details_span">Working Experience (In years): </span>' . $member_info["working_exp"] . ' </p>
        <p><span class="member_details_span">Summery: </span>' . $post->post_content . '</p>
        </div>
      </div>';
        }
    }
    $html = str_replace('{{team_members_info}}', $member, $html);
    return $html;
}

add_action('wp_enqueue_scripts', 'enqueue_team_script');

function enqueue_team_script() {
    wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.6.0.min.js', array());
    wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.6/swiper-bundle.min.js', array());
    wp_enqueue_script('team_swiper', get_template_directory_uri() . '/assets/team-assets/team-script.js', array());
    wp_enqueue_style('swiper-team-', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.6/swiper-bundle.css', array());
    wp_enqueue_style('team-style', get_template_directory_uri() . '/assets/team-assets/teamstyle.css', array());
}
