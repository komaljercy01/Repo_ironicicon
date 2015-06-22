$(document).ready(function(){
  $(window).scroll(function() {
    if ($("nav").offset().top > 50) {
        $("nav").addClass("top-nav-collapse");
    } else {
        $("nav").removeClass("top-nav-collapse");
    }
});
});
