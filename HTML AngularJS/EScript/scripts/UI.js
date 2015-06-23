$(document).ready(function(){
  $( window ).resize(function() {
    alert($( window ).width());
  });
  $(window).scroll(function() {
    $('.responsive').css('margin-top','50px');
});
});
