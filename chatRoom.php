<?php
	$user = $_COOKIE['userID'];  //user current in chat
	$host = false;
	if($_COOKIE['userProfile']=="Host") $host = true;
	$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
	
	$checkURI = strripos($_SERVER['REQUEST_URI'],"=");
	
	if($checkURI)
	{//equal was found, came from message php (otherID comes from link)
		$otherID = substr($_SERVER['REQUEST_URI'],$checkURI+1);  //other chat participant's ID
		setcookie("otherID", $otherID, time()+3600, '/');
	}
	else 
	{
		if(isset($_COOKIE['otherID'])) $otherID = $_COOKIE['otherID'];	//Message sent in chat room, get otherID from cookie
		else $otherID = $_COOKIE['msgHost'];	//came from main page, the other only option
	}
			
	
	if(isset($_POST['send'])&&$_POST['newMsg']!="")
	{
		if($host) $myQuery = 'INSERT INTO message (host_user, guest_user, msg_content, msg_dirGtoH) VALUES ("'.$user.'", "'.$otherID.'", "'.$_POST['newMsg'].'", false);';
		else $myQuery = 'INSERT INTO message (host_user, guest_user, msg_content, msg_dirGtoH) VALUES ("'.$otherID.'", "'.$user.'", "'.$_POST['newMsg'].'", true);';		
		$res = mysqli_query($myCon,$myQuery);
	}	
	
	if($host) $myQuery = 'SELECT msg_content, msg_dirGtoH FROM message WHERE host_user = "'.$user.'" AND guest_user = "'.$otherID.'"';
	else $myQuery = 'SELECT msg_content, msg_dirGtoH FROM message WHERE host_user = "'.$otherID.'" AND guest_user = "'.$user.'"';
	
	$myQuery .= " ORDER BY msg_ID"
	

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="Chat Room" />
		<title>HMR - Chat</title>
		<link rel="stylesheet" href="styles.css">
	</head>	
	<body id="chatBody">
		<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post">
			<div class="chatLeft">
				<?php
					if($host) print 'YOU';
					else print 'HOST '.$otherID;				
				?>
			</div>
			<div class="chatTitle">Chat Room</div>
			
			<div class="chatMsg">
			<?php
				if(mysqli_connect_errno())
				{
					printf("connection failed: %s\n",mysqli_connect_error());
					exit();
				}
				else
				{						
					$res = mysqli_query($myCon,$myQuery);
					if(mysqli_num_rows($res) != 0) 
					{
						for($row = 1; $row <= mysqli_num_rows($res);$row++)
						{
							$record = mysqli_fetch_row($res);
							if($record[1]) print '<p style="text-align:right">'.$record[0].'</p>';
							
							else print '<p style="text-align:left">'.$record[0].'</p>';
						}
					}			
				}
			?>
			</div>
			<div class="chatTxtArea">
				Your Message
				<textarea name="newMsg" id="newMsg" cols="47" rows="4" style="overflow: hidden; background-color: #e8e7e9; text-align:center; border-radius: 15%; " placeholder="Write your message here"
				  ></textarea>	
			</div><!--if(document.getElementByID("newMsg").value == "");return false;-->
			<div class="chatRight">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
					if($host) print 'GUEST '.$otherID;
					else print 'YOU';				
				?>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				<button type="submit" name="send" style="background-color: #b5e61d; border:none;" ><img src="Images/send.jpg" alt="SEND"  /></button>	
			</div>
		</form>
	</body>
	
</html>