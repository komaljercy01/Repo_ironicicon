<?php
if(isset($_POST['hiddenValue']))
{
	//Upload file to "file" folder
	$MIMEType=$_POST['format'];
	$filePath="file/".$_FILES["fileInput"]["name"];
	move_uploaded_file($_FILES["fileInput"]["tmp_name"], $filePath);
	
	//open file with ziparchive and extract to tmp folder
	$tmpfolder="file/".md5(rand());
	$zip = new ZipArchive;
	if($zip->open($filePath))
	{
		$zip->extractTo($tmpfolder);
		$zip->close();
	}
	//case pptx
	if($MIMEType=="pptx")
	{
		//Logic for PPTX file
		//open the tmp folder and then navigate to "ppt\slides" folder
		$currentFolder=$tmpfolder."/ppt/slides";
		$files = glob($currentFolder.'/*.xml');
		//parse the xml files in it
		//text lies at p:sld/p:cSld/p:sp/p:txBody
		$MasterCounter=0;
		$ExtractedText=Array();
		foreach($files as $file)
		{
			$xmlDoc = new DOMDocument();
			$xmlDoc->load($file);
			$x = $xmlDoc->documentElement;
			$Values="";
			foreach ($x->childNodes AS $item) {
				//without formatting the words are being pasted now...
				if($item->nodeName=="p:cSld")
				{
					$Values.=$item->nodeValue;
				}
			}
			//adding values to Master Counter
			$ExtractedText[$MasterCounter]=$Values;
			$MasterCounter++;
		}
	}
	else if($MIMEType="ppt")
	{
		//Logic for PPT file
	}
	else
	{
		//for future adding ppt types and logics
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TExtracter | Extract texts from PPTX and PPT</title>
    <script src="scripts/jquery.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <link href="styles/bootstrap.css" rel="stylesheet" />
	<script src="scripts/custom.js"></script>
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
                    <p>TExtract</p>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse" style="height: 90px;">
                <ul class="nav navbar-nav">
                    <li><a id="register" href="#register">New Users?Register</a></li>
                    <li><a id="login" href="#login">Login</a></li>
					<li><a id="ContactUs" href="#ContactUs">Contact Us</a></li>
					<li><a id="AboutUs" href="#AboutUs">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
	<div class="col-lg-12">
		<div class="container" style="border:1px solid;display:table;height:100%;margin-top:60px;padding:0px 0px 30% 10px;">
			<p class="page-header" style="text-align:center;font-size:28px;">Text Extracter from PPT</p>
			<div class="col-md-6">
				<div class="col-md-12">
					<form action="index.php" method="post" enctype="multipart/form-data">
						<label for="fileInput">Select the PowerPoint file</label>
						<input type="file" name="fileInput" id="fileInput"></input>
						<button class="btn btn-default col-xs-12" disabled="disabled" style="margin-top:5px;" type="submit" id="submitButton">UploadFile</button>
						<input type="hidden" name="hiddenValue"  value="true"/>
						<input type="hidden" name="format" id="format" />
					</form>
				</div>
				<div class="col-md-12">
					<div id="errorDiv" class="alert alert-danger alert-dismissible" role="alert" style="display:none;margin-top:10px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error Found!</strong> Please upload Either PPTX or PPT file
					</div>
				</div>
			</div>
			<div class="col-md-6" style="border-left:1px solid #eee;display:table;height:100%;">
				<p class="page-header">Extracted text comes below</p>
				<div id="ExtractedText" class="col-md-12">
					<p><?php 
					if(isset($ExtractedText))
					{	
						$i=1;
						foreach ($ExtractedText as $value)
						{
							echo "<p class='col-md-12'>slide ".$i." has the Following Text:<b>  ".$value."</b></p><br/>";
							$i++;
						}
					}
					?></p>
				</div>
			</div>
		</div>
	</div>