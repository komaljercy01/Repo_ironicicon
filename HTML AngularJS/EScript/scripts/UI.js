$(document).ready(function(){
  //Resizing menu bar
  $( window ).resize(function() {
    if($( window ).width()<975)
    {
      $(window).scroll(function(e) {
       $('.responsive').css('margin-top','200px');
       $('.leftNav').css('display','block');
      });
    }
  });
});
