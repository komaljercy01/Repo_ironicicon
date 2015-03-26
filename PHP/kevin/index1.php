<?php
session_start();
date_default_timezone_set('UTC');
$_SESSION['user']="Angela Giammanco";
$_SESSION['From']="";
$_SESSION['To']="";
// Make a MySQL Connection
mysql_connect('localhost', 'root', 'root');
mysql_select_db('test');
/* mysql_connect('localhost','ironicic','hJmGp2xr');
 mysql_select_db('ironicic_test');*/

$sql_to_fetch_users="SELECT localparty FROM orktape where localparty not REGEXP '^[0-9]+$' and localparty not REGEXP '^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$' group by localparty order by localparty asc";
$result_to_fetch_users = mysql_query($sql_to_fetch_users) or die(mysql_error());

if(isset($_POST['postValue']))
{
	$_SESSION['user']=$_POST['username'];
	$user=$_POST['username'];
	$From=$_POST['startDate'];
	$To=$_POST['EndDate'];
	$_SESSION['From']=$From;
	$_SESSION['To']=$To;
	//echo $sql;
	//same date
	$diff=(strtotime($To)-strtotime($From))/86400;
	$sql_to_fetch_totalCallsMade="select count(localParty),sum(duration) from orktape where localparty='".stripslashes($user)."'";
	if($diff==0)
	{
		$sql="select localParty,COUNT(localParty), duration,SUM(duration) from orktape where localparty='".stripslashes($user)."' and 			date(expiryTimestamp)=date('$From')" ;
		$sql1="select remoteParty, timestamp, expiryTimestamp, duration from orktape where localparty='".stripslashes($user)."' and date(expiryTimestamp)=date('$From')";
	}
	else
	{
		$sql="select localParty,COUNT(localParty), duration,SUM(duration) from orktape where localparty='".stripslashes($user)."' and date(expiryTimestamp)>date('$From') and date(expiryTimestamp)<date('$To')" ;
		$sql1="select remoteParty, timestamp, expiryTimestamp, duration from orktape where localparty='".stripslashes($user)."' and date(expiryTimestamp)>date('$From') and date(expiryTimestamp)<date('$To')";
	}
	$TotalCallsMadeResult=mysql_query($sql_to_fetch_totalCallsMade) or die(mysql_error());
	$results=mysql_query($sql) or die(mysql_error());
	$results1=mysql_query($sql1) or die(mysql_error());
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>OnCalID | Online Caller ID</title>
    <script src="scripts/jquery.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <link href="styles/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
	});
	</script>
</head>
<body>
    <!--Nav bar-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="display: block;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <p>Online Caller ID</p>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse" style="height: 90px;">
                <ul class="nav navbar-nav">
                    <li><a id="register" href="#Link1">Home</a></li>
                    <li><a id="login" href="#New">Link</a></li>
					<li><a id="ContactUs" href="#ContactUs">Contact Us</a></li>
					<li><a id="AboutUs" href="#AboutUs">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
	<div class="col-lg-12">
		<div class="container" style="border:1px solid;display:table;margin-top:60px;padding:0px 0px 30px 10px;">
			<p class="page-header" style="text-align:center;font-size:18px;margin-top:5px;">Online Caller ID</p>
			<form action="" method="post">
				<div class="col-md-12">
					<div class="col-md-4" style="margin-top:5px;">
						<p style="display:inline;">
							<span>Select the user </span>
							<select name="username">
								<?php
									while($row1=mysql_fetch_array($result_to_fetch_users))
									{
									?><option value="<?php echo $row1['localparty'];?>" <?=$_SESSION['user'] == $row1['localparty'] ? ' selected="selected"' : ''?>><?php echo $row1['localparty'];?></option>
									<?php
									}
								?>
							</select>
						</p>
					</div>
					<div class="col-md-4" style="margin-top:5px;">
						<p style="display:inline;">
							<span>Enter the start Date </span>
							<input type="text" name="startDate" value="<?php echo $_SESSION['From'] ?>" id="datepicker" placeholder="yyyy-mm-dd"></input>
						</p>
					</div>
					<div class="col-md-4" style="margin-top:5px;">
						<p style="display:inline;">
							<span>Enter the End Date </span>
							<input type="text" name="EndDate" value="<?php echo $_SESSION['To'] ?>" id="datepicker1" placeholder="yyyy-mm-dd"></input>
						</p>
					</div>
				</div>
				<div class="col-md-3 col-md-offset-4" style="margin-top:5px;">
					<button id="submitbtn" type="submit" class="btn btn-default col-md-12" style="background-color:#999;">Submit to see the caller ID</button>
					<input type="hidden" name="postValue" value="true"/>
				</div>
				<?php
				if(isset($TotalCallsMadeResult) && mysql_num_rows($TotalCallsMadeResult)>0)
				{
					while($row2=mysql_fetch_array($TotalCallsMadeResult))
					{
						$b=$row2['sum(duration)'];
					}
				}
				if(isset($results) && mysql_num_rows($results)>0)
				{
				?>
				<div class="col-md-12">
					<div id="ResultsDiv">
					<p id="results">Results are as below</p>
						<?php
						while($row = mysql_fetch_array($results))
						{
							$a=$row['COUNT(localParty)'];
							if($a==0 || $b==0)
							{
								?>
									<div id="errorDiv" class="alert alert-danger alert-dismissible" role="alert" style="margin-top:30px;">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<strong>Oops!..</strong> The user havent made calls or is not valid or invalid date is entered
									</div>
									<script type="text/javascript">
										$('#tablediv').hide();
										$('#results').hide();
									</script>
								<?php
								$error=1;
							}
							else
							{
								$error=0;
								$c=$b/$a;
								echo "<div class='col-md-4 col-md-offset-2' style='border : 1px #000 solid;background : #eee;'>";
								echo "<p style='font-weight:normal !important;margin-top:10px;padding-left:20px;'> User: ".$row['localParty'] ."<br/> ";
								echo "Total Calls Made: ".$a. " <br/>";
								echo "Total time spent: ".round($row['SUM(duration)'] /60)."  min (between the date range) <br/>";
								echo "Average Call duration: ".round($c/60)."  min</p><br/>";
								echo "</div>";
							}
						}
						?>
						</table>
						<?php
						if($error==0)
						{
						?>
							<div class="col-md-12" style="height:400px; overflow:auto;">
							<p>More Detailed Information</p>
							<table border="1" class="col-md-12"  style="font-family:calibri;margin-left:5px;font-size:0.9em;">
								<tr>
									<td class="col-md-3"><b>Phone</b></td>
									<td class="col-md-3"><b>Starting</b></td>
									<td class="col-md-3"><b>Ending</b></td>
									<td class="col-md-3"><b>Duration</b></td>
								</tr>
								<?php
								while($row1 = mysql_fetch_array($results1))
								{
									echo "<tr>";
									echo "<td> ".$row1['remoteParty']."</td>";
									echo "<td>".$row1['timestamp']."</td>";
									echo "<td>".$row1['expiryTimestamp'] ."</td>";
									echo "<td>".$row1['duration']."</td>";
									echo "</tr>";
								}
								?>
							</table>
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				}
				?>
			</form>
		</div>
	</div>
</body>
</html>