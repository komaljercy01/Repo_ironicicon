$(document).ready(function(){
  //Resizing menu bar
  $( window ).resize(function() {
    if($( window ).width()<975)
    {
      $('.responsive').css('margin-top','200px');
      $(window).scroll(function() {
        alert($('.responsive').offset().top);
       $('.responsive').css('margin-top','200px');
      });
    }
  });
});
