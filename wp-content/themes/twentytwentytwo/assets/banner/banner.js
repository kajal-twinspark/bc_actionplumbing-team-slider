jQuery(document).ready(function ($) {
     var image_url = '';
    jQuery("#bc_take_banner_image").on("click touchstart", function (e) {
        var file_frame;
        e.preventDefault();
        var that = $(this);
        if (file_frame) {
            file_frame.close()
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data("uploader-title"),
            button: {
                text: $(this).data("uploader-button-text"),
            },
            multiple: false
        }).on('select', function () {
            attachment = file_frame.state().get('selection').first().toJSON();
//            console.log(that.parent().find('#site_logo_id').attr('value',attachment.id));
            $('#bc_actionPlumbing_banner_image_id').attr('value', attachment.id).prop('value', attachment.id);
            $('#bc_actionPlumbing_banner_image_url').attr('value', attachment.url);
            image_url = attachment.url;
            that.parent().find('img#bc_banner_image').attr('src', image_url).prop('src', image_url);
      });
        file_frame.open();
    });
});