$(document).ready(function(){
  //Resizing menu bar
  $( window ).resize(function() {
    if($( window ).width()<975)
    {
      $(window).scroll(function() {
       $('.responsive').css('margin-top','200px');
       $('.leftNav').css('display','block');
      });
    }
  });
});
