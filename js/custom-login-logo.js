jQuery(document).ready(function ($) {

    // Add logo on click on "Upload logo" button
    $('#upload_logo').on('click', function (e) {
        e.preventDefault();

        var customLogoUploader = wp.media({
            title: 'Choose or Upload a Logo',
            button: {
                text: 'Use this Logo'
            },
            multiple: false
        });

        customLogoUploader.on('select', function () {
            var attachment = customLogoUploader.state().get('selection').first().toJSON();
            $('#custom_login_logo').val(attachment.url);
        });

        // Open media uploader
        customLogoUploader.open();
    });
});
