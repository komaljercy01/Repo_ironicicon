<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="Exco.Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
     <title>Hospital Jobs Openings</title>
        <!-- META TAGS -->
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
        
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59213746-1', 'auto');
  ga('send', 'pageview');

</script>
        
</head>
<body>
    <form id="form1" runat="server">
         <header>
            <div class="logo"><img src="images/logo.png" alt="Hospital Jobs Openings"/></div>
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
                <nav>
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
                </nav>
            </div>
        </div>
		
<script type="text/javascript">
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
  m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-59213746-1', 'auto');
    ga('send', 'pageview');

</script>
        <!-- ERROR MESSAGE -->
        <div class="not-found-container">
        <div class="not-found">
            <h1>Hospital Jobs Openings</h1>
            <h3>Look up jobs here...</h3>
			<asp:Literal ID="ltrError" runat="server"></asp:Literal>
            <div id="searchform" class="searchbox">
           <%-- <asp:TextBox ID="search" runat="server"  CssClass="field searchtext" MaxLength="10" placeholder="Job, City..." ></asp:TextBox>--%>
                <input type="text" id="search" runat="server" onkeypress="return isNumberKey(event)" maxlength="10" class="field searchtext" placeholder="Job Title, Keywords" />
                <input type="text" id="search2" runat="server" onkeypress="return isNumberKey(event)" maxlength="10" class="field searchtext2" placeholder="Location" />
           <%--     <input type="submit" class="button orange-button" name="submit" value="SEARCH" />--%>
                <asp:Button ID="btnSearch" runat="server" Text="SEARCH" 
                    CssClass="button orange-button" onclick="btnSearch_Click"  />
               


            </div>

            

        </div>
        </div>
        <br />
        <div id="searchform" class="searchbox" style="border-redius:99px; border:1px solid #silver;">
            <div style="width:100%; height:200px">
                
                </div>
                </div>
                

		<br><br><br><br><br><br><br>
        <!-- FOOTER -->
        <footer>
            <div id="footer-widgets">
                <div class="footer-widget first-clmn">
                    <h3>About Us</h3>
                We make sure everything we do honors that connection – from our commitment to the highest quality, to the way we engage with our customers and communities to do business responsibly.
                </div>
                <div class="footer-widget second-clmn">
                <h3>Navigation</h3>
                    <ul>
                        <li><a href="default.aspx">Homepage</a></li>
                        <li><a href="terms.aspx">Terms and Conditions</a></li>
                        <li><a href="policy.aspx">Private Policy</a></li>
                        <li><a href="contact.asp">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-widget third-clmn">
                <h3>Categories</h3>
                    <ul>
                        <li><a href="tax-relief-services.asp">Tax Relief Services</a></li>
                        <li><a href="flooring-installation-services.asp">Discount Flooring</a></li>
                        <li><a href="carpenter-installation-services.asp">Discount Carpenter</a></li>
                        <li><a href="livelinks-chatline-dating.asp">Livelinks Chatline</a></li>
                        <li><a href="locksmith-services.asp">Locksmith Now</a></li>
                    </ul>                    
                </div>
            </div>
            <div id="credits-block">
                <div id="credits">© 2015 Copyright - Hospital Openings</div>
                <div id="totop"></div>
            </div>
        </footer>
        
        
        
        <!-- JS FILES -->
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="js/innerpage.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <!-- BACKGROUND PHOTO -->
        <script type="text/javascript">
            $(document).ready(function () {
                "use strict";
                $('body').backstretch("images/photos/1.jpg");
            });
        </script>
    </form>
    
</body>
</html>
