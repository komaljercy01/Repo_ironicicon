<?php
session_start();
if(isset($_POST['formm']))
{
include('dbcon.php');
$Email=$_POST['Email'];
$YearsServed=$_POST['YearsServed'];
$Age=$_POST['Age'];
$CurrentPos=$_POST['CurrentPos'];
$Gender=$_POST['Gender'];
$Name=$_POST['Name'];
//$sql="select * from Login where Uname='".$Uname."' and Pass='".$pass."'";
$sql="insert into Login (Email, YearsServed,Age,CurrentPos,Gender,Name) values ('$Email','$YearsServed', '$Age','$CurrentPos','$Gender','$Name')";
echo $sql;
$result=mysql_query($sql);
$count=mysql_affected_rows();
if($count==1)//match found
{
	header('Location: test.php');
	$_SESSION['uname']=$Name;
}
else
{
	echo "insertion failed";
}
}
?>
<html>
<head>
<title>Leadership Resilience Profile</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script>
function validateForm()
{
var Email=document.forms["index"]["Email"].value;
var Name=document.forms["index"]["Name"].value;
var YearsServed=document.forms["index"]["YearsServed"].value;
var Age=document.forms["index"]["Age"].value;
if (Email==null || Email==""||Name==null || Name==""||YearsServed==null || YearsServed==""||Age==null || Age=="")
  {
  alert("Some Fields are missing. Please correct them to proceed further");
  return false;
  }
}
</script>
<style>
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
<body class="container">
<div class="row col-lg-12" style="margin-top:10px;">
<h1 align="left">Leadership Resilience Profile (Revised) Scale LRP-R</h1>
<p align="left"><font size="2">Instructions: Respond to the statements below regarding your leadership behaviour using the 5-point scale.</font></p>
<div id="req" align="left"><font color="brown">* Required</font></div>
<div id="questImg"><a href="login_admin.php"><img src="images/Admin.png" width="70px" height="35px" title="Admin Login" /></a></div>
</div>
<div class="row">
<form name="index" action="index.php" method="post" onsubmit="return validateForm()">
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;">
		<div class="col-md-6">Current Position: *</div>
		<div class="col-md-6"><select name="CurrentPos" style="width:175px;">
			<option value="Teacher">Teacher</option>	
			<option value="Instructional Support">Instructional Support</option>
			<option value="School Administrator">School Administrator</option>
			<option value="Central Office Administrator">Central Office Administrator</option>
			<option value="Other">Other</option>
		</select></div>
	</div>
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;">
		<div class="col-md-6">Name</div>
		<div class="col-md-6"><input type="Text" name="Name" style="width:175px;" required/></div>
	</div>
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;">
		<div class="col-md-6">Years Served in Current Position *</div>
		<div class="col-md-6"><select name="YearsServed" style="width:175px;" required>
			<option value="0 - 5">0 - 5</option>	
			<option value="6 - 10">6 - 10</option>
			<option value="11 - 15">11 - 15</option>
			<option value="16 - 20">16 - 20</option>
			<option value="21 and over">21 and over</option>
		</select></div>
	</div>
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;">
		<div class="col-md-6">Age *</div>
		<div class="col-md-6"><select name="Age" style="width:175px;" required>
			<option value="20-29">20-29</option>	
			<option value="30-39">30-39</option>
			<option value="40-49">40-49</option>
			<option value="50-59">50-59</option>
			<option value="60 and Above">60 and Above</option>
		</select></div>
	</div>
	<div class="col-md-8" style="margin-top:5px;">
		<div class="col-md-6">Email *</div>
		<div class="col-md-6"><input type="email" name="Email" style="width:175px;" required/></div>
	</div>
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;">
		<div class="col-md-6">Gender *</div>
		<div class="col-md-6"><input type="Radio" name="Gender" value="Male" required/> Male <input type="Radio" name="Gender" value="Female" required/> Female</div>
	</div>
	<div class="col-md-8" style="margin-top:5px;" style="margin-top:5px;"><div class="col-md-6"><button class="btn btn-primary" type="submit" value="">Take Me In!</button></div></div>
</div>
<input type="hidden" name="formm" value="true"/>
</table>
</div>
</form>
</body>
</html>