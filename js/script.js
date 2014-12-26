$('document').ready(function() {
  var _navigator = navigator.userAgent.toLowerCase();
  /*_navigator = mozilla/5.0 (windows nt 6.1; wow64) applewebkit/537.36 (khtml, like gecko) chrome/39.0.2171.95 safari/537.36
  splitting the navigator value based on space.*/
  _navigator = _navigator.split('(');
  //_navigator=["mozilla/5.0 ", "windows nt 6.1; wow64) applewebkit/537.36 ", "khtml, like gecko) chrome/39.0.2171.95 safari/537.36"]
  var _detail = _navigator[1].split(')');
  /*_detail=windows nt 6.1; wow64 --> this is where your OS comes into picture
  for mobile(nl 720) _detail=mobile; windows phone 8.1; android 4.0;arm;trident/7.0; touch; rv:11.0; iemobile/11.0; nokia;lumia 720
  displaying divs based on type of device used*/
  displayDivs(_detail[0]);
});

function displayDivs(typeOfDevice) {
  if (typeOfDevice != null) {
    // mobile - windows phone, android - android phones, iphone and iPad
    var _mobDevices = ['mobile', 'android', 'iphone', 'ipad'];
    var isMobile = "false";
    $(_mobDevices).each(function(index, value) {
      if (typeOfDevice.indexOf(value) >= 0) {
        isMobile = "true";
        //breaking the "each" Loop
        return false;
      }
    });
    if (isMobile == "true") {
      //actually need to invoke WhatsApp based on the device.
      invokeWhatsApp(typeOfDevice);
    } else {
      $('#BrowserType').text("Please use a mobile browser to continue");
    }
  }
}

function invokeWhatsApp(whatDevice) {
  try {
    if(whatDevice!=null)
    {
      $('<a>',{
      text: 'This is blah',
      title: 'Blah',
      href: 'whatsapp://send?abid=Alex&text=Test'
      }).appendTo('body');
    }
  }
  catch(ex)
  {
    $('#BrowserType').text(ex.message);
  }
}
