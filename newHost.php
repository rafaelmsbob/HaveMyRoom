<?php
	require_once('class.upload.php');   //downloaded zip from this site:	https://www.verot.net
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="New Host" />
		<title>HMR - New Host</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			function checkFields()
			{
				var check = true;
				var fname = document.getElementsByName('fname')[0];
				var lname = document.getElementsByName('lname')[0];	
				var email = document.getElementsByName('email')[0];	
				var user = document.getElementsByName('user')[0];				
				var pass = document.getElementsByName('pass')[0];	
				var confpass = document.getElementsByName('confPass')[0];			
				var country = document.getElementsByName('country')[0];
				var city = document.getElementsByName('city')[0];	
				var language = document.getElementsByName('language')[0];	
				var address = document.getElementsByName('address')[0];
				
				//trim all values with javascript
				lname.value = lname.value.trim();			
				fname.value = fname.value.trim();
				email.value = email.value.trim();			
				user.value = user.value.trim();
				country.value = country.value.trim();			
				city.value = city.value.trim();
				language.value = language.value.trim();			
				address.value = address.value.trim();				
				
				if(fname.value == "" || fname.value == "Missing info!"){fname.value = "Missing info!"; fname.style.color = "red"; check = false;}				
				if(lname.value == "" || lname.value == "Missing info!"){lname.value = "Missing info!"; lname.style.color = "red"; check = false;}				
				if(email.value == "" || email.value == "Missing info!"){email.value = "Missing info!"; email.style.color = "red"; check = false;}				
				if(user.value == "" || user.value == "Missing info!"){user.value = "Missing info!";	user.style.color = "red"; check = false;}				
				if(pass.value == "" || pass.value == "Missing info!"){pass.value = "Missing info!";	pass.style.color = "red"; check = false;}				
				if(confpass.value == "" || confpass.value == "Missing info!"){ confpass.value = "Missing info!"; confpass.style.color = "red"; check = false;}				
				if (confpass.value != pass.value){confpass.value = "Not Matching!"; confpass.style.color = "red";check = false;}				
				if(country.value == "" || country.value == "Missing info!"){country.value = "Missing info!";country.style.color = "red";check = false;}				
				if(city.value == "" || city.value == "Missing info!"){city.value = "Missing info!"; city.style.color = "red"; check = false;}				
				if(language.value == "" || language.value == "Missing info!"){language.value = "Missing info!"; language.style.color = "red"; check = false;}				
				if(address.value == "" || address.value == "Missing info!"){address.value = "Missing info!"; address.style.color = "red"; check = false;}
				return check;				
			}
		</script>		
		<link rel="stylesheet" href="styles.css">
		<style>
			table.spread
			{
				text-align: center;	
				table-layout: fixed;
				width: 100%
			}
			
			#tdTop
			{								
				vertical-align: bottom;
			}
			
			#tdBottom
			{
				vertical-align: top;
			}
			
			.msgLabel
			{
				color: red;
				width: 200px;
			}
			
		</style>
	</head>	
	<body>
		<div id="banner"></div>  
		<div id="links"><p><a href="MainV5.php">Back to Main Page</a></p></div>		
		<h1 style="text-align: center">Welcome, new Host!</h1>
		<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post" name="frmNewHost"  enctype="multipart/form-data"
		style="margin: 0px auto; width: 1000px; background-color: #eae9d5; border-style: solid;">
			<p style="text-align: right; margin-right: 15px;">* Hover for info</p>
			<fieldset style="border: 2px solid darkblue"><legend><b>Personal Details</b></legend>
				<table class="spread">
					<tr style="width: 100%">
						<td rowspan="2" id="tdTop">First Name</td><td rowspan="2" id="tdTop">Last Name</td><td rowspan="2" id="tdTop">Email</td>
						<td rowspan="2" id="tdTop" title="How others will call you">User*</td><td>Password</td>
					</tr>
					<tr>
						<td><input type="text" name="pass" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['pass'];  ?>' /></td>
					</tr>
					<tr>
						<td rowspan="2" id="tdBottom"><input type="text" name="fname" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['fname'];  ?>' /></td>
						<td rowspan="2" id="tdBottom"><input type="text" name="lname" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['lname'];  ?>' /></td>
						<td rowspan="2" id="tdBottom"><input type="text" name="email" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['email'];  ?>' /></td>
						<td rowspan="2" id="tdBottom"><input type="text" name="user" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['user'];  ?>' /></td><td>Confirm Password</td>
					</tr>
					<tr>
						<td><input type="text" name="confPass" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['confPass'];  ?>' /></td>
					</tr>
				</table>				
			</fieldset><br />
			<fieldset style="border: 2px solid darkblue"><legend><b>Location Details</b></legend>
				<table class="spread">
					<tr style="width: 100%">
						<td>Country</td><td>City</td><td>Language</td><td title="General location or Referrence">Address*</td>
					</tr>
					<tr>
						<td><input type="text" name="country" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['country'];  ?>' /></td>
						<td><input type="text" name="city" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['city'];  ?>' /></td>
						<td><input type="text" name="language" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['language'];  ?>' /></td>
						<td><input type="text" name="address" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['address'];  ?>' /></td>
					</tr>
				</table>
			</fieldset><br />
			<fieldset style="border: 2px solid darkblue"><legend><b>Room Details</b></legend>
				<div style="float: left; width: 300px">
					<table style="height: 145px">
						<tr><th>Item</th><th>YES&nbsp;</th><th>&nbsp;NO</th></tr>
						
						<tr><td>Wifi available?</td><td><input type="radio" name="wifi" value="yes"
								<?php if(isset($_POST['submit'])&&$_POST['wifi']=="yes") print 'checked';?> ></td>
							<td><input type="radio" name="wifi" value="no" 
								<?php if(!isset($_POST['submit'])||(isset($_POST['submit'])&&$_POST['wifi']=="no")) print 'checked';?> ></td></tr>
								
						<tr><td title="Select yes if room is shared with others">Shared Room? *</td><td><input type="radio" name="shared" value="yes" 
								<?php if(isset($_POST['submit'])&&$_POST['shared']=="yes") print 'checked';?> ></td>
							<td><input type="radio" name="shared" value="no" 
								<?php if(!isset($_POST['submit'])||(isset($_POST['submit'])&&$_POST['shared']=="no")) print 'checked';?> ></td></tr>
								
						<tr><td title="Select yes if guest can't arrive after midnight, for example">Time Restrictions? *</td><td><input type="radio" name="time" value="yes" 
								<?php if(isset($_POST['submit'])&&$_POST['time']=="yes") print 'checked';?> ></td>
							<td><input type="radio" name="time" value="no" 
								<?php if(!isset($_POST['submit'])||(isset($_POST['submit'])&&$_POST['time']=="no")) print 'checked';?> ></td></tr>
								
						<tr><td title="Select yes if guest have exclusive bathroom">Exclusive Bathroom? *</td><td><input type="radio" name="bath" value="yes" 
								<?php if(isset($_POST['submit'])&&$_POST['bath']=="yes") print 'checked';?> ></td>
							<td><input type="radio" name="bath" value="no" 
								<?php if(!isset($_POST['submit'])||(isset($_POST['submit'])&&$_POST['bath']=="no")) print 'checked';?> ></td></tr>
					</table>							
				</div>
				<div style="float: left">
					<table>
						<tr><th colspan="2" title="At least 1 picture!">Picture Upload *</th></tr>
						<tr>
							<td>Pic 1: </td><td><input type="file" name="fileToUpload[]" /></td><td class="msgLabel"><label id="msgLabel0"></label></td>
						</tr>
						<tr>
							<td>Pic 2: </td><td><input type="file" name="fileToUpload[]" /></td><td class="msgLabel"><label id="msgLabel1"></label></td>
						</tr>
						<tr>
							<td>Pic 3: </td><td><input type="file" name="fileToUpload[]" /></td><td class="msgLabel"><label id="msgLabel2"></label></td>
						</tr>
						<tr>
							<td>Pic 4: </td><td><input type="file" name="fileToUpload[]" /></td><td class="msgLabel"><label id="msgLabel3"></label></td>
						</tr>
						<tr>
							<td>Pic 5: </td><td><input type="file" name="fileToUpload[]" /></td><td class="msgLabel"><label id="msgLabel4"></label></td>
						</tr>								
					</table>
				</div>			
				<div style="float: left; margin-top: -30px">
					<h2>Create Host</h2>
					<button type="submit" name="submit" onclick="if(!checkFields()) return false;" style="background-color: #eae9d5; border:1px solid black; margin-left: 10px">
						<img src="Images/createHost.jpg" alt="Create Host" /></button>
				</div>
			</fieldset>
			<script>
				function clearAll()
				{
					var myForm = document.getElementsByName("frmNewHost")[0].elements;
					for(var i=0;i<myForm.length;i++)
					{
						myForm[i].value = "";
					}
				}
			</script>						
			<?php
				if(isset($_POST['submit']))
				{//if code get to this point, all fields are valid, only need to check images, insert host on host table and the images for this host on images table					
					
				//inspired on https://www.verot.net/php_class_upload_faq.htm	
				 //this class does not work with arrays, so this foreach gives the ability to work with files separately
				
					$files = array(); 
					foreach ($_FILES['fileToUpload'] as $k => $l)
					{
						foreach ($l as $i => $v)
					  	{
					    	if (!array_key_exists($i, $files)) $files[$i] = array();
					    	$files[$i][$k] = $v;
					  	}
					}						
					
					$count = 0;					//keep track of which upload dialog the user selected
					$arrFile = array();			//Array of valid files
					
					foreach ($files as $file)
					{
						$outFile = new upload($file);
						if($outFile->file_src_size>0)	
						{//there is a file
							if($outFile->file_src_name_ext=="png"||$outFile->file_src_name_ext=="jpg")
							{//it is .png or .jpg
								$arrFile[$count]=$outFile;					//store valid file on array									
								$count++;							
							}
							else
							{
								print '<script>document.getElementById("msgLabel'.$count.'").innerHTML = ".png or .jpg files Only!";</script>';
								unset($arrFile);
								return false;
							}
						}
						unset($outFile);
					}
					
					if(sizeof($arrFile)==0)		//no file chosen at all, not even wrong extension (otherwise it would've returned already)
					{
						print '<script>document.getElementById("msgLabel0").innerHTML = "File not Chosen!";</script>';
						unset($arrFile);
						return false;							
					}
					
					//if code reaches here, all files chosen are valid, now perform operations and save on appropriate folder	
					$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
					if(mysqli_connect_errno())
					{
						printf("connection failed: %s\n",mysqli_connect_error());
						exit();
					}
								
					for($i=0;$i<$count;$i++)
					{							
						$arrFile[$i]->image_resize = true;
					   	$arrFile[$i]->image_y = 200;
					   	$arrFile[$i]->image_ratio_x = true;
					   	$arrFile[$i]->Process('Images/'.$_POST['user'].'/');
					   	if (!$arrFile[$i]->processed) print '<script>document.getElementById("msgLabel'.$count.'").value = "Error : '.$arrFile[$i]->error.'";</script>';
						//print '<script>document.getElementById("msgLabel'.$count.'").innerHTML = "'.$outFile->file_src_name.'";</script>';
						$rawFile = $arrFile[$i]->file_src_name;
						$myQuery = 'INSERT INTO host_img (host_user, img_name) VALUES ("'.$_POST['user'].'", "'.$rawFile.'");';							
						$res = mysqli_query($myCon,$myQuery);							
					}
					
					$myQuery = 'INSERT INTO host_family (host_user, host_fname, host_lname, host_pass, host_email, host_address, host_country, host_language, 
						host_shared, host_bath, host_wifi, host_time) values ("'.$_POST['user'].'", "'.$_POST['fname'].'", "'.$_POST['lname'].'", "'.$_POST['pass'].'", 
						"'.$_POST['email'].'", "'.$_POST['address'].'", "'.$_POST['country'].'", "'.$_POST['language'].'", "'.$_POST['shared'].'", "'.$_POST['bath'].'",
						"'.$_POST['wifi'].'", "'.$_POST['time'].'");';
						
					$res = mysqli_query($myCon,$myQuery);
					
					if($res) print '<script>alert("Host '.$_POST['user'].' Created!");clearAll();</script>';
					else print '<script>alert("Host NOT Created! Error: '.mysqli_error($myCon).'");</script>';	
					
				}
					

					/*foreach ($files as $file)
					{
					$handle = new Upload($file); 
					if ($handle->uploaded)
					{
						$handle->Process("./"); 
					    if ($handle->processed) 
					    { 
					      echo 'OK'; 
					    } else { 
					      echo 'Error: ' . $handle->error; 
					    } 
					  } else { 
					    echo 'Error: ' . $handle->error; 
					  } 
					  unset($handle);
					}*/				
				
				
				/*if(isset($_POST['submit']))
				{					
					$outFile = new upload($_FILES["fileToUpload"][0]);
					if($outFile->file_src_size>0) print '<script>document.getElementById("msgLabel1").innerHTML = "Good";</script>';
					else print '<script>document.getElementById("msgLabel1").innerHTML = "File not Chosen!";</script>';
					/*print '<script>document.getElementById("msgLabel").innerHTML = "Size : '.$outFile->file_src_size.'<br />";';
					print 'document.getElementById("msgLabel").innerHTML += "Ext : '.$outFile->file_src_name_ext.'";</script>';*/
				
					//else print '<script>document.getElementById("msgLabel").innerHTML = "File not chosen!"</script>';
					/*if(isset($_POST['submit']))
{		
	if(isset($_FILES["fileToUpload"]))
	{//document.getElementById("msgLabel").innerHTML = "bob";
		$outFile = new upload($_FILES["fileToUpload"]);
		print '<script>document.getElementById("msgLabel").innerHTML = "Size : '.$outFile->file_src_size.'<br />";';
		print 'document.getElementById("msgLabel").innerHTML += "Ext : '.$outFile->file_src_name_ext.'";</script>';
	}
	else print '<script>document.getElementById("msgLabel").innerHTML = "File not chosen!"</script>';*/
	/*if($outFile->file_src_size>0)
	{
		if($outFile->file_src_name_ext)	
	}
			
    $outFile->image_resize = true;
    $outFile->image_y = 200;
    $outFile->image_ratio_x = true;
    $outFile->Process('Images/Here/');
    if (!$outFile->processed) print '<script>document.getElementById("msgLabel").value = Error : '.$outFile->error.'</script>';
    $outFile->clean();
}
				}*/						
			?>			
		</form>
		<!--<input type="button" onclick="clearAll();" />			 -->
	</body>
</html>