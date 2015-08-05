<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="browsecities.aspx.cs" Inherits="Exco.browsecities" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
 <title id="titleTag" runat="server"></title>
        <!-- META TAGS -->

		<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <!-- CSS FILES -->
        <link href="css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="css/animate.css" rel="stylesheet" type="text/css" />
        <link href="css/grid.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/media.css" rel="stylesheet" type="text/css" />
        
        <link rel="icon" href="images/small-icon.jpg" type="image/jpg" sizes="16x16">
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <link href="css/ie8.css" rel="stylesheet" type="text/css" />
        <![endif]-->
         <script type="text/javascript">
             function isNumberKey(evt) {
                 var charCode = (evt.which) ? evt.which : event.keyCode
                 if (charCode > 31 && (charCode < 48 || charCode > 57))
                     return false;

                 return true;
             }
        
        </script>
   
</head>
<body>
  
    <form id="form2" runat="server">
    <!-- HEADER -->
        <header>
            <div class="logo"><img src="images/logo.png" alt="Kairos"/></div>
            <div class="social-icons">
                <ul>
                    <li>
                        <a href="#">
                            <img src="images/social/facebook.png" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="images/social/twitter.png" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="images/social/google.png" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="images/social/skype.png" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="images/social/vimeo.png" alt="" />
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <!-- MAIN MENU -->
        <div class="fix-nav">
            <div class="nav-container">
                <a class="toggleMenu" href="#">Menu</a>
              <%--  <nav>--%>
                    <ul class="nav">
                        <li>
                            <a href="Default.aspx">Home</a>
                        </li>
                        <li>
                            <a href="browse.aspx?cities=cityname">Browse Jobs Matches</a>
                        </li>
                        <li>
                            <a href="recently.aspx">Recently Posted Job Openings</a>
                        </li>
                        <li>
                            <a href="about.aspx">About Us</a>
                        </li>
                        <li>
                            <a href="register.aspx">Register</a>
                        </li>
                    </ul>
             <%--   </nav>--%>
            </div>
        </div>
		
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
  m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-59213746-1', 'auto');
    ga('send', 'pageview');

</script>

        <!-- PAGE CONTENT -->
        <section class="wrapper">
            <div class="page-title title-down"><span class="title-content1">
            <div style="width:100%; margin: 26px 76px 1px 17px;">
            <div style="float:left;margin: -7px 15px 10px 21px;">
                <input type="text" id="search" runat="server" onkeypress="return isNumberKey(event)" maxlength="10" class="field searchtext" placeholder="Job Title, Keywords" />
            </div>
            <div style="float:left;margin: -7px 15px 10px 21px;">
                <input type="text" id="search2" runat="server" onkeypress="return isNumberKey(event)" maxlength="10" class="field searchtext2" placeholder="Location" />
            </div>
             <div style="float:right; margin: -14px 76px 1px -96px;">
         <asp:Button ID="btnSearch" runat="server" Text="SEARCH" CssClass="button1 orange-button1" onclick="btnSearch_Click"  />
         </div>
           </div>
            
            
            </span></div>


                 <div class="row-fluid">
                    <!-- 4 COLUMNS -->
                <div class="row-fluid">
                  <div class="span3">

                  <div class="Result" style=" margin:1px 2px 3px -10px; width:860px">

               <h2><asp:Literal ID="ltrlPhone" runat="server" Text=" Recent Job ads and Openings"></asp:Literal></h2>
<div style="float:left:15px;  width:85%;  color:Black; ">Check out some of the most recent Job openings. Click on the below to view the openings. If you find multiple pics of different openings that fit your criteria then please apply as soon as you can.</div>
               <br>
               <asp:DataList ID="dlMainDate" runat="server" OnItemDataBound="dlMainDate_OnItemDataBound" RepeatColumns="1" RepeatDirection="Horizontal">
             <ItemTemplate>

               <br><div style="background-color:rgb(213, 204, 204); width:830px;  color:Gray; ">
               <asp:HiddenField ID="hf" runat="server" Value='<%#Eval("PublishDate","{0:yyyy-MM-dd}") %>' />
              <h3 style="font-weight:bold; font-family:Arial; "> <%#Eval("PublishDate","{0:dddd, MMM dd}") %> </h3>
               </div>
                 <div style="margin:0px 1px 2px 80px;">
                <asp:DataList ID="dlRecently" runat="server" OnItemCommand="dlRecently_OnItemCommand" RepeatColumns="6" RepeatDirection="Horizontal">
                  <ItemTemplate>
                
                  	  <asp:PlaceHolder ID="PlaceHolder1"   Visible='<%# Eval("Photo1").ToString() != "" %>' runat="server">
                       <a href="http://www.hospitalopenings.org/<%# String.Format("{0}",Eval("Phone1"))%>">
                     <img src='<%# Eval("Photo1") == null?"": Eval("Photo1") %>' alt="" width="100" height="100" /></a><br />
                       <div style="text-align:center;">
                  <asp:LinkButton ID="imgPhoneNo" runat="server" Text='<%# Eval("Phone1") %>' CommandName="Phone_Click" CommandArgument='<%# Eval("Phone1") %>' ForeColor="#55AAFF" ></asp:LinkButton> <br />
                 
                  <b>Age:</b><%# Eval("Age") %>
                  

                      </asp:PlaceHolder>
                      </div>
             </ItemTemplate>
             </asp:DataList>
             </div>
               </ItemTemplate>
</asp:DataList>
               
               <br />
                
                       
          

                 
        </section>
        <!-- FOOTER -->
        <footer>
            <div id="footer-widgets">
                <%--<div class="footer-widget first-clmn">
                    <h3>About Us</h3>
                We make sure everything we do honors that connection - from our commitment to the highest quality, to the way we engage with our customers and communities to do business responsibly..
                </div>--%>
            <div id="credits-block">
                <div id="credits">2015 Copyright - Hospital Jobs Openings</div>
                <div id="totop"></div>
            </div>
        </footer>
        <!-- JS FILES -->
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- BACKGROUND PHOTO -->
        <script type="text/javascript">
            $(document).ready(function () {
                "use strict";
                $('body').backstretch("images/photos/1.jpg");
            });
        </script>        
        <script src="js/custom.js" type="text/javascript"></script>




       <%--   <script type="text/javascript" charset="utf-8">
              $(document).ready(function () {
                  $("area[rel^='prettyPhoto']").prettyPhoto();

                  $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({ animation_speed: 'normal', theme: 'light_square', slideshow: 3000, autoplay_slideshow: true });
                  $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({ animation_speed: 'fast', slideshow: 10000, hideflash: true });

                  $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
                      custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
                      changepicturecallback: function () { initialize(); }
                  });

                  $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
                      custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
                      changepicturecallback: function () { _bsap.exec(); }
                  });
              });
			</script>--%>
    </form>
</body>
</html>
