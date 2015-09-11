<?php
session_start();
if(isset($_POST['formm']))
{
include('dbcon.php');
$Uname=$_POST['Uname'];
$pass=$_POST['Pass'];
$sql="select * from Login_admin where Uname='".$Uname."' and Pass='".$pass."'";
$result=mysql_query($sql);
echo $sql;
$count=mysql_num_rows($result);
if($count==1)//match found
{
	header('Location: adminPanel.php');
	$_SESSION['AdUname']=$Uname;
}
else
{
	echo "login failed";
}
}
?>
<html>
<head>
<title>Login Page</title>
<style type="text/css">
body
{
font-family: Calibri;
background-size: 80% 90%;
background-repeat: no-repeat;
background-position:center;
}
#header
{
background-color: white;
top:0px;
left:3%;
width:100%;
height:26%;
font-family: Arial;
border-bottom:1px solid #000;
}
#footer
{
position: absolute;
background-color: white;
top:90%;
left:0 px;
width:100%;
height:10%;
font-family: Arial;
border-top:1px solid #000;
}
#questions
{
border:1px solid #ddd;
}
#odd
{
tr bgcolor: brown;
}
#even
{
tr: white;
}
#box
{
margin-left: 20%;
margin-top: 1%;
width : 80%;
height: 90%;
}
#questImg
{
position: absolute;
top:2%;
right:1%;
}
#req
{
font-family: calibri;
}
</style>
</head>
<body align="center">
<div id="header"><br/>
<h1 align="left">Leadership Resilience Profile Login Page</h1>
<p align="left"><font size="2">Login to fetch reports</font></p>
<div id="req" align="left"><font color="brown">* Required</font></div>
<div id="questImg"><img src="images/quest.jpg" width="50px" height="50px" title="Help" /></div>
</div>
<form action="login_admin.php" method="post">
<table border="0">
<tr>
	<td>Username</td>
	<td><input type="Text" name="Uname"/></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="Password" name="Pass"/></td>
</tr>
<tr><td><input type="submit" value="login"/></td></tr>
<input type="hidden" name="formm" value="true"/>
</table>
</form>
</body>
</html>

