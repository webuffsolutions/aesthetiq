var $ = jQuery.noConflict();

$(document).ready(function() {
  // back to top
  $(window).scroll(function() {
    if ($(this).scrollTop() > 150) {
      $("#back-to-top").fadeIn();
    } else {
      $("#back-to-top").fadeOut();
    }
  });
  // scroll body to 0px on click
  $("#back-to-top").click(function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
    return false;
  });

  // home carousel
  $(".slide").css("display", "block"); // show images when slider is initialized

  $(".carousel").carousel({
    interval: 5000,
    ride: "carousel"
  });

  $(".carousel1").carousel({
    interval: 10000,
    ride: "carousel"
  });

});
