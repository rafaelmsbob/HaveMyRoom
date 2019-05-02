<?php

//if(isset($_POST['submit'])) print 'bla'.$_POST['txtUser'];
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="Log In page" />
		<title>HMR - LogIn</title>
		<link rel="stylesheet" href="styles.css">
		<script type="text/javascript">
			function clearInput()
			{
				document.getElementById("txtUser").value = "";
				document.getElementById("txtPass").value = "";
				document.getElementById("output").innerHTML = "";				
			}
		</script>
	</head>
	<body>
		<div>
			<form id="frmLogIn" method="post" name="frmLogIn" action="<?php print ($_SERVER['PHP_SELF']); ?>"'> 
				<table id="tableLogIn" style="text-align: center; margin-left: 100px" align="left">
					<tr><td colspan="3"><b>Please Choose profile type</b></td></tr>					
					<tr><td colspan="3">
						<table align="center">
							<tr><td><input type="radio" name="rdProfile" value="Guest" checked /> Guest</td>
								<td><input type="radio" name="rdProfile" value="Host" 
								<?php if(isset($_POST['submit'])&&$_POST['rdProfile']=="Host") print 'checked'; ?> > Host</td></tr>
						</table></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td colspan="3"><label><b>Please enter your credentials</b></label></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td colspan="2" style="text-align: right">User </td><td><input type="text" id="txtUser" name="txtUser" size="20" 
					value='<?php if(isset($_POST['submit'])) print trim($_POST['txtUser']);  ?>' /></td></tr>
					<tr><td colspan="2" style="text-align: right">Password </td><td><input type="text" id="txtPass" name="txtPass" size="20"
					value='<?php if(isset($_POST['submit'])) print trim($_POST['txtPass']);  ?>'  /></td></tr>
					<tr><td colspan="3"><p id="output">&nbsp;</p></td></tr>
				</table>
				<?php
					if(isset($_POST['submit']))
					{
						$myQuery  ="";
						$user = trim($_POST['txtUser']);
						$pass = trim($_POST['txtPass']);
						if($_POST['rdProfile']=="Guest")
							$myQuery = 'SELECT guest_user, guest_pass FROM guest WHERE guest_user = "'.$user.'" AND guest_pass = "'.$pass.'"';
						else $myQuery = 'SELECT host_user, host_pass FROM host_family WHERE host_user = "'.$user.'" AND host_pass = "'.$pass.'"';
						
						$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
						if(mysqli_connect_errno())
						{
							printf("connection failed: %s\n",mysqli_connect_error());
							exit();
						}
						else
						{										
							$res = mysqli_query($myCon,$myQuery);
							if(mysqli_num_rows($res) == 0) 
							{
								print '<script>var str = "Invalid Credentials";';								
								print 'document.getElementById("output").innerHTML = str.fontcolor("red")</script>';		
							}
							else
							{//good credentials	
								setcookie("userID", $user, time()+3600, '/');
								setcookie("userProfile", $_POST['rdProfile'], time()+3600, '/');
								setcookie("message",false, time()+3600, '/');							
								if($_POST['rdProfile']=="Guest") $queryMsg = 'SELECT guest_user FROM message WHERE guest_user = "'.$user.'"';	//guest Query
								else $queryMsg = 'SELECT host_user FROM message WHERE host_user = "'.$user.'"';		//host Query
									
								$res = mysqli_query($myCon,$queryMsg);
								if(mysqli_num_rows($res) != 0)
								{
									setcookie("message",true, time()+3600, '/');
									//header("Refresh:0; url=MainV4.php");
								}
								
								print '<script>window.close();</script>';
							}
						}
					}
				?>
				<table align="center">
					<tr><td>&nbsp;</td></tr>
					<tr><td><input align="middle" type="submit" name="submit" value="Log In" /></td>
						<td width="100px" align="center"><input type="submit" name="reset" id="reset" onclick="clearInput()" value="Clear" /></td>
						<td><input type="button" name="back" value="Back" onclick='self.close();' /></td></tr>
				</table>
			</form>
			
		</div>
		
		
		
		
	</body>
</html>