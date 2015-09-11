<?php
include('dbcon.php');
session_start();
if(isset($_SESSION['uname'])){
?>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript">
function a()
{
 //alert('options not selected, score for that question will be considered as 0');
 if($('input[type=radio]:checked').size() > 3)
 {
	return true;
 }
 else
 {
	alert('Some  questions are not answered.. Please double check');
	return false;
 }
}
</script>
<title>Leadership Resilience Profile</title>
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
<body align="center">
<div id="header">
<p align="left"><font size="2">Welcome <?php echo $_SESSION['uname'];?></p>
<h1 align="left">Leadership Resilience Profile (Revised) Scale LRP-R</h1>
<p align="left"><font size="2">Instructions: Respond to the statements below regarding your leadership behaviour using the 5-point scale.</font></p>
<div id="req" align="left"><font color="brown">* Required</font></div>
<div id="questImg"><a href="logout.php"><img src="images/logout.jpg" width="50px" height="50px" title="logout" /></a></div>
</div>
<br/><br/>
	<?php
		$sqlQuery="select * from questions";
		$result=mysql_query($sqlQuery);
		$count=mysql_num_rows($result);
	?>
<div id="box">
	<form action="calcResult.php" method="post">
	<table border="1" width="70%">
	<tr><td width="30%"><b>Question</b></td><td width="10%" ><b>Strongly Disagree</b></td><td width="10%"><b>Disagree</b></td><td width="10%"><b>Neutral</b></td><td width="10%"><b>Agree</b></td><td width="10%"><b>Strongly Agree</b></td></tr>
		<?php
			$i=0;
			while($row=mysql_fetch_array($result)){
			if($i<$count)
			{
			if($i%5==0)
			{
				?>
				<tr bgcolor="#cccccc"><td colspan="6"><h3 align="center">Category: <?php echo $row['Questions'];?></h3></td></tr></div>
				<?php
			}
			else if($i%2==0)
			{
				?>
				<tr bgcolor="#989898"><td><?php echo $row['Questions'];?></td><td align="center"><input type="radio" name="<?php echo $i;?>" id="<?php echo $i;?>" value="1"/></td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="2"/> </td><td align="center"><input type="radio" name="<?php echo $i;?>" id="<?php echo $i;?>" value="3"/></td><td align="center"><input type="radio" name="<?php echo $i;?>" id="<?php echo $i;?>" value="4" /> </td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="5"/></td></tr></div>
				<?php
			}
			else 
			{
				?>
				<tr bgcolor="white"><td><?php echo $row['Questions'];?></td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="1"/></td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="2"/> </td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="3"/></td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="4"/> </td><td align="center"><input type="radio" id="<?php echo $i;?>" name="<?php echo $i;?>" value="5"/></td></tr></div>
				<?php
			}
				$i++;
			}}
		?>
	</div>
	<tr><td><input type="submit" value="Get My Results" onclick="return a()"/></td></tr>
	</table>
	<input type="hidden" name="submit" value="true"/>
	</form>
</div>
</body>
</html>
<?php
}
else
{
echo "please login ";
}?>