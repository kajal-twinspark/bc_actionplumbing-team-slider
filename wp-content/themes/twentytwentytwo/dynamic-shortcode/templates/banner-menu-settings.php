<?php
$banner_settings = get_option('bc_actionPlumbing_banner_settings');
if (!empty($banner_settings)) {
    $title = $banner_settings['title'];
    $content = $banner_settings['content'];
    $btn_text = $banner_settings['button_text'];
    $btn_url = $banner_settings['button_url'];
    $image_url = $banner_settings['image_url'];
    $image_id = $banner_settings['image_id'];
} else {
    $title = 'Lorem Ipsum';
    $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry.";
    $btn_text = 'Submit';
    $btn_url = '#';
    $image_url = get_template_directory_uri() . '/assets/images/bird-on-salmon.jpg';
}
?>
<div class=" bc_actionPlumbing_container container my-5 mx-5 px-5">
    <h2 class="title is-2 is-capitalized">Contact Us</h2>
    <form action="admin-post.php" method="POST">
        <input name='action' type="hidden" value='save_bc_actionplumbing_banner_settings'>
        <div class="field bc_actionPlumbing_inputs">
            <label for="title">Title</label>
            <input type="text" name="bc_actionPlumbing_banner_settings[title]" id="name" placeholder="First and Last" required minlength="3" maxlength="25" value="<?= $title ?>" />
        </div>
        <div class="field bc_actionPlumbing_inputs">
            <label for="button_text">Button Text</label>
            <input type="text" name="bc_actionPlumbing_banner_settings[button_text]"  value="<?= $btn_text ?>" />
        </div>
        <div class="field bc_actionPlumbing_inputs">
            <label for="button_url">Button URL</label>
            <input type="text" name="bc_actionPlumbing_banner_settings[button_url]"  value="<?= $btn_url ?>" />
        </div>
        <div class="field bc_actionPlumbing_inputs">
            <label for="content">Banner Content</label>
            <textarea name="bc_actionPlumbing_banner_settings[content]" id="message" rows="5" value="<?= $content ?>"><?= $content ?></textarea>
        </div>

        <div class="field bc_actionPlumbing_inputs" >
            <label for="Banner">Banner Image</label>
            <input type="hidden" name="bc_actionPlumbing_banner_settings[image_id]" id='bc_actionPlumbing_banner_image_id'  value="<?= $image_id?>" />
            <input type="hidden" name="bc_actionPlumbing_banner_settings[image_url]"  id='bc_actionPlumbing_banner_image_url'value="<?= $image_url?>" />
            <button id="bc_take_banner_image" data-uploader-title="<?= __('Select Banner Image', 'banner-image'); ?>" data-uploader-button-text="Select">Select Banner Image</button>

            <img src='<?= $image_url ?>' id='bc_banner_image'/>
        </div>
        <div class="field bc_actionPlumbing_inputs">
            <button type="submit" class="button is-success is-size-5 btn-success">Submit</button>
        </div>
    </form>
</div>


