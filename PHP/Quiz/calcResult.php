<?php
include('dbcon.php');
session_start();
$sqlQuery="select * from questions";
$result=mysql_query($sqlQuery);
$count=mysql_num_rows($result);
if(isset($_POST['submit']))
{
$i=0;$j=1;
$a[]=0;
while($i<$count)
{
	if(isset($_POST[$j]))
	{
		$a[$i]=$_POST[$j];
	}
	else
	{
		$a[$i]=0;
	}
	$i++;$j++;
}
$FutureOptimism=array_slice($a,0,4);
$PresentOptimism=array_slice($a,5,4);
$PersonalValues=array_slice($a,10,4);
$PersonalEfficacy=array_slice($a,15,4);
$SupportBase=array_slice($a,20,4);
$EmotionalWellBeing=array_slice($a,25,4);
$PhysicalWellBeing=array_slice($a,30,4);
$DecisionMaking=array_slice($a,35,4);
$PersonalResponsibility=array_slice($a,40,4);
$Adaptability=array_slice($a,45,4);
$Perseverance=array_slice($a,50,4);
$date=date("Y-m-d");
$user=$_SESSION['uname'];

$FutureOptimismSum=array_sum($FutureOptimism);
$PresentOptimismSum=array_sum($PresentOptimism);
$PersonalValuesSum=array_sum($PersonalValues);
$PersonalEfficacySum=array_sum($PersonalEfficacy);
$SupportBaseSum=array_sum($SupportBase);
$EmotionalWellBeingSum=array_sum($EmotionalWellBeing);
$PhysicalWellBeingSum=array_sum($PhysicalWellBeing);
$DecisionMakingSum=array_sum($DecisionMaking);
$PersonalResponsibilitySum=array_sum($PersonalResponsibility);
$AdaptabilitySum=array_sum($Adaptability);
$PerseveranceSum=array_sum($Perseverance);
$total=array_sum($a);
$val=$total/5;
//echo $total;
$IP=$_SERVER["REMOTE_ADDR"];
//$IP='113.193.114.26';

               //check, if the provided ip is valid
               if(!filter_var($IP, FILTER_VALIDATE_IP))
               {
                       Echo "IP is not valid" ;
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$IP);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';
			   

               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'Localhost';
               }
			   $loc=$ipInfo['country']." > ".$ipInfo['state'];
			   //echo $loc;

//SQL to insert into Results table

$sql="insert into result (FutureOptimism,PresentOptimism,PersonalValues,PersonalEfficacy,SupportBase,EmotionalWellBeing,PhysicalWellBeing,DecisionMaking,PersonalResponsibility,Adaptability,Perseverance,User,Date,IP,Location,Total) values ('$FutureOptimismSum','$PresentOptimismSum','$PersonalValuesSum','$PersonalEfficacySum','$SupportBaseSum','$EmotionalWellBeingSum','$PhysicalWellBeingSum','$DecisionMakingSum','$PersonalResponsibilitySum','$AdaptabilitySum','$PerseveranceSum','$user','$date','$IP','$loc',$total)";

//executing SQL

$result=mysql_query($sql);
$count=mysql_affected_rows();

}
?>
<head>
    <style type="text/css">
        .style1
        {
            background-color: #919100;
        }
        .style2
        {
            background-color: #99FFCC;
        }
        .style3
        {
            background-color: #993333;
        }
        .style4
        {
            background-color: #3366CC;
        }
        .style6
        {
            background-color: #666666;
        }
    </style>
</head>
<table border="1" cellspacing="0" cellpadding="0" width="878">
    <tbody>
        <tr>
            <td width="113" valign="top">
            </td>
            <td width="42" valign="top">
            </td>
            <td width="173" colspan="4" valign="top" style="background-color: #FFFF00">
                <p align="center">
                    <strong>Low</strong>
                </p>
            </td>
            <td width="181" colspan="4" valign="top" style="background-color: #FFCC00">
                <p align="center">
                    <strong>Low-Moderate</strong>
                </p>
            </td>
            <td width="184" colspan="4" valign="top" style="background-color: #009900">
                <p align="center">
                    <strong>High - Moderate</strong>
                </p>
            </td>
            <td width="185" colspan="4" valign="top" style="background-color: #00FFFF">
                <p align="center">
                    <strong>High</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Optimism - FUTURE</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($Perseverance);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Optimism - Present</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($PresentOptimism);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Personal Values</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($PersonalValues);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Personal Efficacy</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($PersonalEfficacy);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Support </strong>
                </p>
                <p>
                    <strong>Base</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($SupportBase);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Emotional Well-being</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($EmotionalWellBeing);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Physical </strong>
                </p>
                <p>
                    <strong>Well - being</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($PhysicalWellBeing);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Decision Making</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($DecisionMaking);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Personal Responsibility</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($PersonalResponsibility);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Adaptability</strong>
                </p>
                <p>
                    &nbsp;</p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($Adaptability);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>Perseverance</strong>
                </p>
                <p>
                    &nbsp;</p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo array_sum($Perseverance);?></strong>
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    5
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    6
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    7
                </p>
            </td>
            <td width="43" valign="top" class="style1">
                <p align="center">
                    8
                </p>
            </td>
            <td width="43" valign="top" class="style2">
                <p align="center">
                    9
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    10
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    11
                </p>
            </td>
            <td width="46" valign="top" class="style2">
                <p align="center">
                    12
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    13
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    14
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    15
                </p>
            </td>
            <td width="46" valign="top" class="style3">
                <p align="center">
                    16
                </p>
            </td>
            <td width="47" valign="top" class="style4">
                <p align="center">
                    17
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    18
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    19
                </p>
            </td>
            <td width="46" valign="top" class="style4">
                <p align="center">
                    20
                </p>
            </td>
        </tr>
        <tr>
            <td width="113" valign="top" class="style6">
                <p>
                    &nbsp;</p>
            </td>
            <td width="42" valign="top" class="style6">
                <p align="center">
                    &nbsp;</p>
            </td>
            <td width="43" valign="top" style="background-color: #666666">
            </td>
            <td width="43" valign="top" style="background-color: #666666">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" style="text-align: left; background-color: #666666">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" style="background-color: #666666">
            </td>
            <td width="43" valign="top" class="style6">
            </td>
            <td width="43" valign="top" style="background-color: #666666">
            </td>
            <td width="46" valign="top" style="background-color: #666666">
            </td>
            <td width="46" valign="top" style="background-color: #666666">
            </td>
        </tr>
        <tr>
            <td width="113" valign="top">
                <p>
                    <strong>TOTAL SCORE</strong>
                </p>
            </td>
            <td width="42" valign="top">
                <p align="center">
                    <strong><?php echo $val;?></strong>
                </p>
                <p align="center">
                    <strong></strong>
                </p>
                <p align="center">
                    <strong>TOTAL/5</strong>
                </p>
            </td>
            <td width="173" colspan="4" valign="top" style="background-color: #FFFF00">
                <p align="center">
                    11- 21
                </p>
            </td>
            <td width="181" colspan="4" valign="top" style="background-color: #FF9900">
                <p align="center">
                    22-32
                </p>
            </td>
            <td width="184" colspan="4" valign="top" style="background-color: #009933">
                <p align="center">
                    33-43
                </p>
            </td>
            <td width="185" colspan="4" valign="top" style="background-color: #00FFCC">
                <p align="center">
                    44-55
                </p>
            </td>
        </tr>
    </tbody>
</table>
<?php
else
{
echo "please go to "?><a href="index.php">here</a> to complete the quiz<?php ;
}