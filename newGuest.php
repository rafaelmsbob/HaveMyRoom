<?php
	//R181
	//G230
	//B29
	
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="New Host" />
		<title>HMR - New Guest</title>
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
				var age = document.getElementsByName('age')[0];
				
				//trim all values with javascript, 
				lname.value = lname.value.trim();			
				fname.value = fname.value.trim();
				email.value = email.value.trim();			
				user.value = user.value.trim();
				country.value = country.value.trim();			
				city.value = city.value.trim();
				language.value = language.value.trim();			
				age.value = age.value.trim();				
				
				if(fname.value == "" || fname.value == "Missing info!"){fname.value = "Missing info!"; fname.style.color = "red"; check = false;}				
				if(lname.value == "" || lname.value == "Missing info!"){lname.value = "Missing info!"; lname.style.color = "red"; check = false;}				
				if(email.value == "" || email.value == "Missing info!"){email.value = "Missing info!"; email.style.color = "red"; check = false;}				
				if(user.value == "" || user.value == "Missing info!"){user.value = "Missing info!";	user.style.color = "red"; check = false;}				
				if(pass.value == "" || pass.value == "Missing info!"){pass.value = "Missing info!";	pass.style.color = "red"; check = false;}				
				if(confpass.value == "" || confpass.value == "Missing info!"){ confpass.value = "Missing info!"; confpass.style.color = "red"; check = false;}				
				if(confpass.value != pass.value){confpass.value = "Not Matching!"; confpass.style.color = "red";check = false;}				
				if(country.value == "" || country.value == "Missing info!"){country.value = "Missing info!";country.style.color = "red";check = false;}				
				if(city.value == "" || city.value == "Missing info!"){city.value = "Missing info!"; city.style.color = "red"; check = false;}				
				if(language.value == "" || language.value == "Missing info!"){language.value = "Missing info!"; language.style.color = "red"; check = false;}				
				if(age.value == "" || age.value == "Missing info!"){age.value = "Missing info!"; age.style.color = "red"; check = false;}
				else{if(isNaN(age.value)){age.value = "Not a Number!"; age.style.color = "red"; check = false;}}
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
		<h1 style="text-align: center">Welcome, new Guest!</h1>
		<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post" name="frmNewGuest"  enctype="multipart/form-data"
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
			<fieldset style="border: 2px solid darkblue"><legend><b>Further Information</b></legend>
				<table class="spread">
					<tr style="width: 100%">
						<td>Country</td><td>City</td><td>Language</td><td title="No one will know">age *</td>
					</tr>
					<tr>
						<td><input type="text" name="country" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['country'];  ?>' /></td>
						<td><input type="text" name="city" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['city'];  ?>' /></td>
						<td><input type="text" name="language" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['language'];  ?>' /></td>
						<td><input type="text" name="age" size="15" 
							value='<?php if(isset($_POST['submit'])) print $_POST['age'];  ?>' /></td>
					</tr>
				</table>
			</fieldset><br />	
			<div style="float: left; margin-left: 30px;">
				<h2>Clear Fields</h2>
				<button name="clear" onclick="clearAll();" style="background-color: #eae9d5; border:1px solid black; margin-left: 10px">
					<img src="Images/eraser.png" alt="Clear Guest" />
				</button>
			</div>
			<div style="float: right; margin-right: 30px;">
				<h2>Create Guest</h2>
				<button type="submit" name="submit" onclick="if(!checkFields()) return false;" style="background-color: #eae9d5; border:1px solid black; margin-left: 10px">
					<img src="Images/createGuest.png" alt="Create Guest" />
				</button>				
			</div>
			<script>
				function clearAll()
				{
					var myForm = document.getElementsByName("frmNewGuest")[0].elements;
					for(var i=0;i<myForm.length;i++)
					{
						myForm[i].value = "";
					}
				}
			</script>						
			<?php
				if(isset($_POST['submit']))
				{//if code get to this point, all fields are valid, insert guest on guest table					
								
					$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
					if(mysqli_connect_errno())
					{
						printf("connection failed: %s\n",mysqli_connect_error());
						exit();
					}
					else
					{
						$myQuery = 'INSERT INTO guest (guest_user, guest_fname, guest_lname, guest_pass, guest_email, guest_country, guest_age) values ("'.$_POST['user'].'",
							"'.$_POST['fname'].'", "'.$_POST['lname'].'", "'.$_POST['pass'].'",	"'.$_POST['email'].'", "'.$_POST['country'].'",  '.$_POST['age'].');';
							
						$res = mysqli_query($myCon,$myQuery);
						
						if($res) print '<script>alert("Guest '.$_POST['user'].' Created!");clearAll();</script>';
						else print '<script>alert("Guest NOT Created! Error: '.mysqli_error($myCon).'");</script>';
					}
					
				}											
			?>
			
		</form>			 
	</body>
</html>