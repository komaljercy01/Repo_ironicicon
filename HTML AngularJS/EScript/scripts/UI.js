$(document).ready(function(){
  var screenwidth = $(window).width();
  alert(screenwidth);
  $(window).scroll(function() {
    $('.responsive').css('margin-top','50px');
});
});
