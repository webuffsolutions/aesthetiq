var $ = jQuery.noConflict();

$(document).ready(function () {
    if (init_settings.permalink !== "our-services") {
        localStorage.removeItem("current");
    }

    lightbox.option({
        'resizeDuration': 400,
        'fadeDuration': 400,
        'wrapAround': true,
    });
});

$(document).on('click', '.mega-area.dropdown-menu', function (e) {
    e.stopPropagation();
});

$(document).on('click', '.close-mega-one', function (e) {
    $("#mega-one").dropdown('hide')
});
