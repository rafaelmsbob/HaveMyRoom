<?php
	$user = $_COOKIE['userID'];
	$host = false;
	if($_COOKIE['userProfile']=="Host") $host = true;
	
	$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
	if(mysqli_connect_errno())
	{
		printf("connection failed: %s\n",mysqli_connect_error());
		exit();
	}		
	
	if(isset($_POST['deleteChat']))
	{
		if($host) $myQuery = 'DELETE FROM message WHERE host_user = "'.$user.'" AND guest_user = "'.$_POST['deleteChat'].'"';
		else $myQuery = 'DELETE FROM message WHERE host_user = "'.$_POST['deleteChat'].'" AND guest_user = "'.$user.'"';
		$res = mysqli_query($myCon,$myQuery);
	}
	
	if($host)
		$myQuery = 'SELECT DISTINCT guest.guest_fname, guest.guest_country, guest.guest_user FROM message, guest WHERE message.guest_user = guest.guest_user AND host_user = "'.$user.'"';
		
	else
		$myQuery = 'SELECT DISTINCT host_family.host_fname, host_family.host_country, host_family.host_user FROM message, host_family WHERE message.host_user = host_family.host_user AND guest_user = "'.$user.'"';
	

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="message" />
		<title>HMR - Messages</title>
		<link rel="stylesheet" href="styles.css">
		<script>
			function deleteCookies()
			{
				document.cookie = "msgHost=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
				document.cookie = "msgHost=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
			}			
			
			var counter=0;
			function onFocusFunc()
			{
				if(counter)		
				location.reload(true);
				counter=0;	
			}
		
		</script>
	</head>	
	<body onbeforeunload="deleteCookies()" onfocus="onFocusFunc()" >	
		<div id="banner"></div>  
		<div id="links"><p><a href="MainV5.php">Back to Main Page</a></p></div>
		<div align="center">
			<em><?php if($host) print 'Guests you\'re chatting with, '.$user; else print 'Hosts you\'re chatting with, '.$user ?></em><br /><br />
			<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post" name="frmTableMsg" >
				<table border="1px solid black;" style="text-align: center; background-color: none">
					<tr style="font-weight: bold; font-size: 18pt">
						<td>Chat With</td><td>Country</td><td>Delete Chat</td>				
					</tr>
					<script>
						function showPopUp(guestID, guestName)
						{					
							var widthy = 750;									
							var lefty = (screen.width-widthy)/2;	//put top back to 300
							var winOptions='location=no, scrollbars=no, resizable=no, width='+ widthy +', height=400, top=200, left='+ +lefty;    
							var chatWindow = window.open('chatRoom.php?ID='+guestID, 'Chat with '+guestName, winOptions); 
							counter++;							
							chatWindow.focus();
						}
					</script>
					<?php
						$res = mysqli_query($myCon,$myQuery);
						if(mysqli_num_rows($res) != 0) 
						{
							for($row = 1; $row <= mysqli_num_rows($res);$row++)
							{				
								print '<tr style="font-size: 16pt">';
								$record = mysqli_fetch_row($res);
								for($col = 0; $col <3; $col++)
								{								
									if($col == 0) print '<td><a href="chatRoom.php?PID='.$record[2].'" onclick="showPopUp(\''.$record[2].'\',\''.$record[0].'\'); return false;" >'.$record[0].'</a></td>';									else if($col == 1) print "<td>".$record[$col]."</td>";
									else if($col == 2) print '<td><button type="submit" name="deleteChat" style="background-color: #b5e61d; border:none;" value="'.$record[$col].'"
																	onclick=\'if(window.confirm("Delete Chat with '.$record[0].'?")) return true; else return false;\' >
																	<img src="Images/delete.png" alt="deletePic" /></button></td>';										
								}									
								print "</tr>";									
							}
						}
						else print '<tr><td colspan="3" style="font-weight: bold; font-size: 18pt" >No Chats to display!</td></tr>';
						
						if(isset($_COOKIE['msgHost'])) print '<script>showPopUp("'.$_COOKIE['msgHost'].'"," ");</script>';
					?>
				</table>	
			</form>	
		</div>
				
				
				
				
				
	</body>
</html>