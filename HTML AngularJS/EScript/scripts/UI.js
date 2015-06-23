$(document).ready(function(){
  var _navigator=navigator.userAgent.toLowerCase().split('(');
  var screenwidth = _navigator[1].split(')');
  alert(screenwidth);
  $(window).scroll(function() {
    $('.responsive').css('margin-top','50px');
});
});
