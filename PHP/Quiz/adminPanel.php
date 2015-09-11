<?php
session_start();
if(isset($_SESSION['AdUname']))
{
include('dbcon.php');
echo "Welcome ".$_SESSION['AdUname'];
?>
<html>
<head>
<title>Leadership Resilience Profile</title>
<script>
function leaveChange() {
    if (document.getElementById("Column").value == "Location"){
        document.getElementById("message").innerHTML = "Search based on Country or State";
    }     
    else if (document.getElementById("Column").value == "Date") {
        document.getElementById("message").innerHTML = "To Date: <input type=\"text\" name=\"toDate\"/>";
    }
	else if (document.getElementById("Column").value == "score") {
        document.getElementById("message").innerHTML = "Option: <select name=\"ScoreOption\"><option value=\">\">Greater Than</option><option value=\"<\">Lesser Than</option><option value=\"\">Equal To</option>";
    }
	else
	{
		document.getElementById("message").innerHTML = "";
	}
}
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
<body align="center">
<div id="header"><br/>
<h1 align="left">Report fetching page</h1>
<p align="left"><font size="2">Instructions: Select options to extract data.</font></p>
<div id="req" align="left"><font color="brown">* Required</font></div>
</div>
<form name="adminHome" action="adminPanel.php" method="post">
<table>
	<tr>
		<td>Column Name:</td>
		<td><select name="Column" id="Column" onchange="leaveChange()">
			<option value="Date">Date</option>
			<option value="Location">Location (Country) </option>
			<option value="score">Score</option>
			</select>
		</td>
	</tr>
	<tr>
		<td> Value </td>
		<td> <input type="text" name="UserInput"/></td><td><div id="message"></div></td>
	</tr>
	<tr><td><input type="submit" value="Fetch reports"/></td></tr>
	<input type="hidden" name="formm" value="formm"/>
</table>
</form>
<?php
if(isset($_POST['formm']))
{	
	
	//for Date
$selected_option=$_POST['Column'];
if($selected_option=="Date")
	{
		if(isset($_POST['toDate']))
		{
			$toDate=$_POST['toDate'];
		}
		else
		{
			//if blank, then to date is taken as today's date...
			$toDate=date("Y-m-d");
		}
		$fromDate=$_POST['UserInput'];
		$sql="SELECT * FROM `result` Where date <='$toDate' and date >='$fromDate'";
		$res=mysql_query($sql);
		$sep = ""; //tabbed character 
		$fp = fopen($selected_option."_".date("d-M").".xls", "w"); 
		$schema_insert = ""; 
		$schema_insert_rows = ""; 
		echo mysql_num_fields($res);
		for ($i = 1; $i < mysql_num_fields($res); $i++) 
			{ 
			$schema_insert_rows.= "ID" . "\t";
			$schema_insert_rows.= "FutureOptimism" . "\t";
			$schema_insert_rows.= "PresentOptimism" . "\t";
			$schema_insert_rows.= "PersonalValues" . "\t";
			$schema_insert_rows.= "PersonalEfficacy" . "\t";
			$schema_insert_rows.= "SupportBase" . "\t";
			$schema_insert_rows.= "EmotionalWellBeing" . "\t";
			$schema_insert_rows.= "PhysicalWellBeing" . "\t";
			$schema_insert_rows.= "DecisionMaking" . "\t";
			$schema_insert_rows.= "PersonalResponsibility" . "\t";
			$schema_insert_rows.= "Adaptability" . "\t";
			$schema_insert_rows.= "Perseverance" . "\t";
			$schema_insert_rows.= "total" . "\t";
			$schema_insert_rows.= "User" . "\t";
			$schema_insert_rows.= "Date" . "\t";
			$schema_insert_rows.= "IP" . "\t";
			$schema_insert_rows.= "Location" . "\t";
			} 
		$schema_insert_rows.="\n"; 
		fwrite($fp, $schema_insert_rows); 
		$id=1;
		//echo mysql_num_fields($res);
		while($row_ques=mysql_fetch_array($res))
		{
			$schema_insert = ""; 
			for($j=0; $j<mysql_num_fields($res);$j++) 
			{ 
				if(!isset($row_ques[$j])) 
					$schema_insert .= "NULL" . "\t"; 
				elseif ($row_ques[$j] != "") 
					$schema_insert .= strip_tags($row_ques[$j]) . "\t"; 
				else 
					$schema_insert .= "" . "\t"; 
			} 
			//$schema_insert = str_replace($sep."$", "", $schema_insert); 
			//$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert); 
			$schema_insert .= "\n"; 
			fwrite($fp, $schema_insert); 
		}
	fclose($fp);
	?>Click <a href=<?php echo $selected_option."_".date("d-M").".xls"?>>here</a> to get download the csv file<?php
	}
else if($selected_option=="Location")
	{
		//$toDate=$_POST['toDate'];
		$loc=$_POST['UserInput'];
		if($loc!=""){
		$sql="SELECT * FROM `result` Where location ='%$loc%'";}
		else
		{
		$sql="SELECT * FROM `result` ";
		}
		echo $sql;
		$res=mysql_query($sql);
		$sep = ""; //tabbed character 
		$fp = fopen($selected_option."_".date("d-M").".xls", "w"); 
		$schema_insert = ""; 
		$schema_insert_rows = ""; 
		for ($i = 1; $i < mysql_num_fields($res); $i++) 
			{ 
			$schema_insert_rows.= "ID" . "\t";
			$schema_insert_rows.= "FutureOptimism" . "\t";
			$schema_insert_rows.= "PresentOptimism" . "\t";
			$schema_insert_rows.= "PersonalValues" . "\t";
			$schema_insert_rows.= "PersonalEfficacy" . "\t";
			$schema_insert_rows.= "SupportBase" . "\t";
			$schema_insert_rows.= "EmotionalWellBeing" . "\t";
			$schema_insert_rows.= "PhysicalWellBeing" . "\t";
			$schema_insert_rows.= "DecisionMaking" . "\t";
			$schema_insert_rows.= "PersonalResponsibility" . "\t";
			$schema_insert_rows.= "Adaptability" . "\t";
			$schema_insert_rows.= "Perseverance" . "\t";
			$schema_insert_rows.= "total" . "\t";
			$schema_insert_rows.= "User" . "\t";
			$schema_insert_rows.= "Date" . "\t";
			$schema_insert_rows.= "IP" . "\t";
			$schema_insert_rows.= "Location" . "\t";
			} 
		$schema_insert_rows.="\n"; 
		fwrite($fp, $schema_insert_rows); 
		$id=1;
		//echo mysql_num_fields($res);
		while($row_ques=mysql_fetch_array($res))
		{
			$schema_insert = ""; 
			for($j=0; $j<mysql_num_fields($res);$j++) 
			{ 
				if(!isset($row_ques[$j])) 
					$schema_insert .= "NULL" . "\t"; 
				elseif ($row_ques[$j] != "") 
					$schema_insert .= strip_tags($row_ques[$j]) . "\t"; 
				else 
					$schema_insert .= "" . "\t"; 
			} 
			//$schema_insert = str_replace($sep."$", "", $schema_insert); 
			//$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert); 
			$schema_insert .= "\n"; 
			fwrite($fp, $schema_insert); 
		}
	fclose($fp);
	?>Click <a href=<?php echo $selected_option."_".date("d-M").".xls"?>>here</a> to get download the csv file<?php
	}
else
	{
		$option=$_POST['ScoreOption'];
		$score=$_POST['UserInput'];
		if($score!=""){
			$sql="SELECT * FROM `result` Where total $option=$score";
			//echo $sql;
		}
		else
		{
			$sql="SELECT * FROM `result` ";
		}
		$res=mysql_query($sql);
		$sep = ""; //tabbed character 
		$fp = fopen($selected_option."_".date("d-M").".xls", "w"); 
		$schema_insert = ""; 
		$schema_insert_rows = ""; 
		for ($i = 1; $i < mysql_num_fields($res); $i++) 
			{ 
			$schema_insert_rows.= "ID" . "\t";
			$schema_insert_rows.= "FutureOptimism" . "\t";
			$schema_insert_rows.= "PresentOptimism" . "\t";
			$schema_insert_rows.= "PersonalValues" . "\t";
			$schema_insert_rows.= "PersonalEfficacy" . "\t";
			$schema_insert_rows.= "SupportBase" . "\t";
			$schema_insert_rows.= "EmotionalWellBeing" . "\t";
			$schema_insert_rows.= "PhysicalWellBeing" . "\t";
			$schema_insert_rows.= "DecisionMaking" . "\t";
			$schema_insert_rows.= "PersonalResponsibility" . "\t";
			$schema_insert_rows.= "Adaptability" . "\t";
			$schema_insert_rows.= "Perseverance" . "\t";
			$schema_insert_rows.= "total" . "\t";
			$schema_insert_rows.= "User" . "\t";
			$schema_insert_rows.= "Date" . "\t";
			$schema_insert_rows.= "IP" . "\t";
			$schema_insert_rows.= "Location" . "\t";
			} 
		$schema_insert_rows.="\n"; 
		fwrite($fp, $schema_insert_rows); 
		$id=1;
		//echo mysql_num_fields($res);
		while($row_ques=mysql_fetch_array($res))
		{
			$schema_insert = ""; 
			for($j=0; $j<mysql_num_fields($res);$j++) 
			{ 
				if(!isset($row_ques[$j])) 
					$schema_insert .= "NULL" . "\t"; 
				elseif ($row_ques[$j] != "") 
					$schema_insert .= strip_tags($row_ques[$j]) . "\t"; 
				else 
					$schema_insert .= "" . "\t"; 
			} 
			//$schema_insert = str_replace($sep."$", "", $schema_insert); 
			//$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert); 
			$schema_insert .= "\n"; 
			fwrite($fp, $schema_insert); 
		}
	fclose($fp);
	?>Click <a href=<?php echo $selected_option."_".date("d-M").".xls"?>>here</a> to get download the csv file<?php
	}
}
else
{
}
}
else{
echo "Welcome ".$_SESSION['AdUname'];
?>
<h3> please login as Admin to check this </h3>
<?php
}
?>
</body></html>

