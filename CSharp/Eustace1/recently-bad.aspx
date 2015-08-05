<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="recently.aspx.cs" Inherits="Exco.recently" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
       <title>Recently Matched Phone Numbers - Hospital Jobs Openings</title>
       
         
        <!-- META TAGS -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.lint.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="Lightbox/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="Lightbox/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		
		<style type="text/css" media="screen">
			* { margin: 0; padding: 0; }
			
			
			
			
			
			ul li { display: inline; }
			
			.wide {
				border-bottom: 1px #000 solid;
				width: 4000px;
			}
			
			.fleft { float: left; margin: 0 20px 0 0; }
			
			.cboth { clear: both; }
			
			#main {
				background: #fff;
				margin: 0 auto;
				padding: 30px;
				width: 1000px;
			}
		</style>


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
    <form id="form1" runat="server">
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
                            <a href="browse.aspx?cities=cityname">Browse Phone Matches</a>
                        </li>
                        <li>
                            <a href="recently.aspx">Recently Matched Phone Numbers</a>
                        </li>
                        <li>
                            <a href="about.aspx">About</a>
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
            <div class="page-title title-down"><span class="title-content">Recently Matched Phone Numbers</span></div>
                 <div align="center" class="row-fluid">
                 
                 
                    <!-- 4 COLUMNS -->
               
                <div style="float:left;margin: 10px 9px 7px -139px;">
         <asp:DataList ID="dlLeftAd" runat="server" RepeatColumns="1" OnItemDataBound="dlLeftAd_OnItemDataBound"  RepeatDirection="Vertical">
            <ItemTemplate>
            	<%--  <asp:PlaceHolder ID="PlaceHolder1"   Visible='<%# Eval("Photo1").ToString() != "" %>' runat="server">--%>
             <a href="http://adultfriendfinder.com/p/register.cgi?#/regpage/1" target="_blank">
             <%-- <img id="imgleft" runat="server"  alt="" width="130" height="120" />--%>
              <asp:Image ID="imgleft" runat="server" width="130" height="120"/>
              <br />
              <asp:HiddenField ID="hf" runat="server" Value='<%#Eval("Phone1") %>' />
           <b style="color:#55AAFF;"> <%# Eval("City")%></b>  <span style="color:Gray;"> <%# Eval("Age")%></span><br /></a>
           <span style="color:Gray;"> Mumbai</span> 
        <%--   </asp:PlaceHolder>--%>
            </ItemTemplate>
            </asp:DataList>
          

            
            </div>
               <div id="main">

            



                <div class="Result"  style=" margin:1px 2px 3px -30px; width:100%">
                  <h2> <asp:Literal ID="ltrlPhone" runat="server"></asp:Literal></h2>

                  <asp:DataList ID="dlRecently" runat="server" OnItemDataBound="dlRecently_OnItemDataBound" OnItemCommand="dlRecently_OnItemCommand" RepeatColumns="6" RepeatDirection="Horizontal">
                  <ItemTemplate>
                  	<%--  <asp:PlaceHolder ID="PlaceHolder1"   Visible='<%# Eval("Photo1").ToString() != "" %>' runat="server">--%>
                
	
			
            	<%--<li><a href='<%# Eval("Photo1")%>' rel="prettyPhoto[gallery1]"><img src='<%# Eval("Photo1")%>' width="100" height="100" alt="" /></a></li>--%>

              
                  <a href="http://www.hospitalopenings.org/<%# String.Format("{0}",Eval("Phone1"))%>">
                <asp:Repeater ID="rpt" runat="server">
                <ItemTemplate>
                  <ul class="gallery clearfix" >
              

                          <img src='<%# DataBinder.Eval(Container.DataItem,"Value") %>' width="100" height="100" alt="" /></li>
               
                </ul>

				  </ItemTemplate>
                </asp:Repeater>
			 </a>
                 
                                   
                             
                  <div style="text-align:center;">
                  <asp:LinkButton ID="imgPhoneNo" runat="server" Text='<%# Eval("Phone1") %>' CommandName="Phone_Click" CommandArgument='<%# Eval("Phone1") %>' ForeColor="Blue" ></asp:LinkButton> <br />
                  <%# Eval("City") %><br />
                  <b>Age:</b><%# Eval("Age") %>
                  </div>
               <%--   </asp:PlaceHolder>--%>
                  </ItemTemplate>
                  
                  
                  </asp:DataList>
                  
                  
                  </div>
                  </div>
                  </div>
                  
                  
        </section>

        <!-- FOOTER -->
        <footer>
            <div id="footer-widgets">
                <div class="footer-widget first-clmn">
                    <h3>About Us</h3>
                We make sure everything we do honors that connection - from our commitment to the highest quality, to the way we engage with our customers and communities to do business responsibly..
                </div>
                </div>
            <div id="credits-block">
                <div id="credits">2015 Copyright - Hospital Jobs Openings</div>
                <div id="totop"></div>
            </div>
        </footer>
         <!-- JS FILES -->
       <%-- <script src="js/jquery.js" type="text/javascript"></script>--%>

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





          <script type="text/javascript" charset="utf-8">
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
			</script>
    </form>
</body>
</html>
