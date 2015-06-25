$(document).ready(function(){
  //Resizing menu bar
  $( window ).resize(function() {
    if($( window ).width()<975)
    {
      $(window).scroll(function(e) {
      if(e.currentTarget.innerWidth<975)
        {
          $('.responsive').css('margin-top','200px');
          $('.leftNav').css('display','block');
        }
        else
        {
          $('.responsive').css('margin-top','0px');
        }
        }
      });
    }
  });
});
