<?php
	$myQuery = "SELECT `host_fname`,`host_country`, `host_address`, `host_language`, `host_shared`, `host_bath`, `host_wifi`, `host_time`, `host_user` FROM `host_family` WHERE 1=1";
	$userID = "";
	$f_name = "";
	$isGuest = "";
	$reload = 0;
	
	if(isset($_POST['submit'])||isset($_POST['userPic']))
	{
		//build query with radiobuttons or checkboxes selected
		$searchBy = "";
		$txtSearch = "";
		
		if(isset($_POST['msgHost'])) setcookie("msgHost", "", time() - 3600, '/');		
		
		if(isset($_POST['submit']))
		{
			$searchBy = $_POST['searchBy'];
			$txtSearch = $_POST['txtSearch'];
		}
		if(isset($_POST['userPic']))
		{
			if(isset($_COOKIE['searchBy'])) $searchBy = $_COOKIE['searchBy'];
			if(isset($_COOKIE['txtSearch'])) $txtSearch = $_COOKIE['txtSearch'];
		}
		
		if($searchBy!="all") $myQuery .= " AND ".$searchBy." like '%".$txtSearch."%'";
		
		if(!empty($_POST['searchCrit']))				
		{			
			foreach($_POST['searchCrit'] as $val)
            {
            	if($val == "host_wifi") $myQuery .= ' AND `host_wifi` = "yes"';
                if($val == "host_shared") $myQuery .= ' AND `host_shared` = "no"';
                if($val == "host_time") $myQuery .= ' AND `host_time` = "no"';
                if($val == "host_bath") $myQuery .= ' AND `host_bath` = "yes"';
            }
		}
		else if(empty($_POST['searchCrit'])&&isset($_POST['userPic']))
		{			
			if(isset($_COOKIE['critWifi'])) $myQuery .= ' AND `host_wifi` = "yes"';
			if(isset($_COOKIE['critShared'])) $myQuery .= ' AND `host_shared` = "no"';
			if(isset($_COOKIE['critTime'])) $myQuery .= ' AND `host_time` = "no"';
			if(isset($_COOKIE['critBath'])) $myQuery .= ' AND `host_bath` = "yes"';			
		}		
	}	
	
	//else print '<script>barEffect();</script>'; 	
	
	$myQuery .= " ORDER BY `host_country` LIMIT 25";
	
	function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            foreach($_POST[$chkname] as $chkval)
            {
                if($chkval == $value) return true;
            }
        }
        return false;
    }
	 	
	
	if(isset($_POST['userPic'])) 
	{
		$userPic = $_POST['userPic'];		
		$queryPic = 'SELECT `img_name` FROM `host_img` WHERE `host_user` = "'.$userPic.'"';		
		$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
		if(mysqli_connect_errno())
		{
			printf("connection failed: %s\n",mysqli_connect_error());
			exit();
		}
		else
		{				
			$res = mysqli_query($myCon,$queryPic);
			if(mysqli_num_rows($res) != 0) 
			{				
				$curImg = 0;
				print '<script>var imgArray=new Array();';
				for($row = 1; $row <= mysqli_num_rows($res);$row++)
				{
					$record = mysqli_fetch_row($res);
					print 'imgArray['.$curImg.'] = "'.$record[0].'";';					
					$curImg++;
				}
				//print 'document.getElementById("pics").src = "Images/'.$userPic.'/'.$record[0].'.png"';
				print '</script>';				
				
			}
		}
	}
		
	if(isset($_POST['logOut']))
	{			
		setcookie("userID", "", time() - 3600, '/');
		setcookie("userProfile", "", time() - 3600, '/');
		setcookie("message", "", time() - 3600, '/');
		header('Location: '.$_SERVER['REQUEST_URI']);		
	}
	
	if(isset($_COOKIE['userID']))
	{		
		$userID = $_COOKIE['userID'];
		$userProfile = $_COOKIE['userProfile'];
	}
	
	if(isset($_POST['msgHost']))
	{		
		if(isset($_COOKIE['userID'])&&$userProfile=="Guest")
		{
			setcookie("msgHost",$_POST['msgHost'], time() + 3600, '/');
			if(isset($_COOKIE['otherID'])) setcookie("otherID", "", time() - 3600, '/');
			header('Location: message.php');			
		}
		else setcookie("msgHost", "", time() - 3600, '/');
	}
	
	
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Rafael Silveira" />
		<meta name="description" content="Guest search, main page" />
		<title>HMR - Main</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			var counter=0;
			function onFocusFunc()
			{
				if(counter)		
				location.reload(true);		
			}
		</script>
		<script src="rotate.js"></script>
		<link rel="stylesheet" href="styles.css">
	</head>	
	<body onfocus="onFocusFunc();">
		<div id="banner"></div>  
		<div id="links"><p>
			<form action="" method="post">
				<a href="LogIn.php" onclick='showPopUp(); return false;'
				<?php if(isset($_COOKIE['userID'])) print 'hidden=true'; ?>
				>Log In</a>
			<script>
				function showPopUp()
				{
					var lefty = screen.width/2 - 250;
					var winOptions='location=no, scrollbars=no, resizable=no,width=500, height=285, top=300, left='+ +lefty;
					var logInWindow = window.open("LogIn.php", "logIn", winOptions); 
					counter++;
					logInWindow.focus();
				}
			</script>
			<a href="newGuest.php"  onclick="window.open(URL, name, specs, replace)">New Guest</a>
			<a href="newHost.php">New Host</a>&emsp;&emsp;&emsp;
			<?php if(isset($_COOKIE['userID']))
			{
				print 'Hi, '.$userProfile.' '.$userID.'!  ';
				if(isset($_COOKIE['message'])) print '<a href="message.php">Check Messages</a>';
				else print ' No Messages :( ';
				print '<input type="submit" name="logOut" value="Log Out" />';
				if(isset($_POST['msgHost'])) print '<span id="logInNow" style="font-size: 16pt; color:red;"> HOSTS CANNOT SEND MESSAGES!</span>';
			}
			else
			{
				if(isset($_POST['msgHost']))	print '<span id="logInNow" style="font-size: 28pt; color:red;">PLEASE LOG IN!</span>';				
			}
			
			?></form></p></div>
			<script>
				function barEffect(myDiv)
				{
					for(var i=1;i<5;i++)
					{
						$(document).ready(function(){
							$(myDiv).fadeToggle(200).fadeToggle(200);
						});
					}
				}
				
			</script>
			<?php
				if(isset($_POST['msgHost'])) print '<script>barEffect(\'#logInNow\');</script>';
				else if(!isset($_POST['submit'])&&!isset($_POST['userPic'])) print '<script>barEffect(\'#searchBar\');</script>';
					
			?>
			
			<div id="searchBar">			
			<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post" name="searchForm">			
				<table>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3" align="center"><em>Search a Room</em></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">
							<input type="text" name="txtSearch" size="30" placeholder="type your seach here"
							<?php
								if(isset($_POST['submit']))
		 				    	{
									print 'value='.$_POST['txtSearch']; 
									setcookie('txtSearch', $_POST['txtSearch'], time()+3600, '/');
								}		
								else if(isset($_POST['userPic']))
								{
									if(isset($_COOKIE['txtSearch'])) print 'value='.$_COOKIE['txtSearch'];
									else print 'value=""';
								}
								 
							?> >							
							
							<input type="submit" name="submit"value="" style="background-image: url('Images/Mag.png');border: 1px solid black; background-repeat:no-repeat;background-size:100% 100%; width:40px; height:40px; vertical-align: bottom;" />					
						</td>					
					</tr>
					<tr>
						<td>Search by:</td>
						<td><input type="radio" name="searchBy" value="all" 
								<?php if(!isset($_POST['submit'])&&!isset($_POST['userPic']))
									  {//first access
									  	print "checked='true'";
									  	setcookie('searchBy', 'all', time()+3600, '/');	 
									  }	
									  else if(isset($_POST['submit'])&&$_POST['searchBy']=="all")
									  {
									  	print "checked='true'"; 
										setcookie('searchBy', 'all', time()+3600, '/');
									  }									  
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['searchBy'])&&$_COOKIE['searchBy']=='all') print "checked='true'";									  }
									  	
								?> />All<br />
								
							<input type="radio" name="searchBy" value="host_country" 
								<?php if(isset($_POST['submit'])&&$_POST['searchBy']=="host_country")
									  {
									  	print "checked='true'"; 
										setcookie('searchBy', 'host_country', time()+3600, '/');
									  }									  
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['searchBy'])&&$_COOKIE['searchBy']=='host_country') print "checked='true'";									  }										
								
								?> />Country<br />
								
							<input type="radio" name="searchBy" value="host_language"
								<?php if(isset($_POST['submit'])&&$_POST['searchBy']=="host_language")
									  {
									  	print "checked='true'"; 
										setcookie('searchBy', 'host_language', time()+3600, '/');
									  }									  
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['searchBy'])&&$_COOKIE['searchBy']=='host_language') print "checked='true'";								  }
																 
								?> />Language</td>
								
						<td style="width: 30px"></td>
						<td><input type="checkbox" name="searchCrit[]" value="host_wifi" 
								<?php if(isset($_POST['submit']))
									  {
									  	if(IsChecked('searchCrit','host_wifi'))
									  	{
										  	print "checked='true'"; 
										  	setcookie('critWifi', 'host_wifi', time()+3600, '/');
										}
										else setcookie('critWifi', 'host_wifi', time()-3600, '/');
									  }
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['critWifi'])) print "checked='true'";						  	
									  }
									  	
								?> />Wifi only<br />						
							<input type="checkbox" name="searchCrit[]" value="host_shared"
								<?php if(isset($_POST['submit']))
									  {
									  	if(IsChecked('searchCrit','host_shared'))
									  	{
										  	print "checked='true'"; 
										  	setcookie('critShared', 'host_shared', time()+3600, '/');
										}
										else setcookie('critShared', 'host_shared', time()-3600, '/');
									  }
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['critShared'])) print "checked='true'";						  	
									  }
								?> />No shared room<br />
								
							<input type="checkbox" name="searchCrit[]" value="host_time"
								<?php if(isset($_POST['submit']))
									  {
									  	if(IsChecked('searchCrit','host_time'))
									  	{
										  	print "checked='true'"; 
										  	setcookie('critTime', 'host_time', time()+3600, '/');
										}
										else setcookie('critTime', 'host_time', time()-3600, '/');
									  }
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['critTime'])) print "checked='true'";						  	
									  }
								?> />No time restrictions<br />
							<input type="checkbox" name="searchCrit[]" value="host_bath"
								<?php if(isset($_POST['submit']))
									  {
									  	if(IsChecked('searchCrit','host_bath'))
									  	{
										  	print "checked='true'"; 
										  	setcookie('critBath', 'host_bath', time()+3600, '/');
										}
										else setcookie('critBath', 'host_bath', time()-3600, '/');
									  }
									  else if(isset($_POST['userPic']))
									  {
									  	if(isset($_COOKIE['critBath'])) print "checked='true'";						  	
									  }
								?> />Exclusive bathroom</td>
					</tr>					
				</table>				
			</form>
			<div id="imgObj">
				<table>
					<tr>
						<td><input type="button" value="<" <?php if(isset($_POST['userPic'])) print 'onclick="changeSrc(\''.$_POST['userPic'].'\',-1);"'; 
																  else print 'onclick="" hidden="true" disabled="true"' ?> /></td>
						<td><img src="" id="pics" width="350px" height="200px"/></td>
						<td><input type="button" value=">" <?php if(isset($_POST['userPic'])) print 'onclick="changeSrc(\''.$_POST['userPic'].'\',1);"';
																			else print 'onclick="" hidden="true" disabled="true"' ?> /></td>	
																						
					</tr>
				</table>
				<!-- Host name and Country -->
				<div id="caption">
					<p>
					<?php
						if(isset($_POST['userPic'])) 
						{
							$userPic = $_POST['userPic'];		
							$queryPic = 'SELECT `host_fname`, `host_country` FROM `host_family` WHERE `host_user` = "'.$userPic.'"';		
							$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
							if(mysqli_connect_errno())
							{
								printf("connection failed: %s\n",mysqli_connect_error());
								exit();
							}
							else
							{				
								$res = mysqli_query($myCon,$queryPic);
								if(mysqli_num_rows($res) != 0) 
								{
									$record = mysqli_fetch_row($res);
									print $record[0] . " - " . $record[1];
								}
							}
						}		
					?>
					</p>	
				</div>
			</div>			
		</div>
		<script>
			$(function(){
				$('#caption').rotate({
      				angle: 0,
				    animateTo:360,
				    duration: 500
				})				
			});
		</script>
		<?php
		
			function findFirstImg()
			{				
				if(isset($_POST['userPic']))
				{						
					$fImage = scandir('Images/'.$_POST['userPic'].'/');					
					print '<script>document.getElementById("pics").src = "Images/'.$_POST['userPic'].'/'.$fImage[2].'";</script>';					
				}				
			}
			findFirstImg();							
		
		?>
		
		<script>				
			var curIdx = 0;
			function changeSrc(userPic, i)
			{
				var pics = document.getElementById("pics");
				//var aux = pics.src.lastIndexOf('/');
				if(curIdx+i==imgArray.length) curIdx = -1;
				else if(curIdx+i==-1) curIdx = imgArray.length;
				pics.src = 'Images/'+userPic+'/'+imgArray[+curIdx+i];
				curIdx+=i;
			}
		</script>
		<?php
			/*print 'txtSrcPost '.$_POST['txtSearch'];
			print ' txtSrcCookie '.$_COOKIE['txtSearch'];
			print ' SrcByPost '.$_POST['searchBy'];
			print ' SrcByCookie '.$_COOKIE['searchBy'];
			*/
		?>
		<div id="tableObj">
			<em>Rooms Available</em>
			<form action="<?php print ($_SERVER['PHP_SELF']); ?>" method="post" name="tableForm">
				<table align="center" border="1px solid black" style="text-align: center; background-color: none">
					<tr style="font-weight: bold">
						<td>Name</td><td>Country</td><td>Address</td><td>Language</td><td>Shared?</td><td>Ex Bath?</td><td>WIfi?</td><td>Time Rest?</td><td>Photos</td><td>Message</td>				
					</tr>
						<?php
						$myCon = mysqli_connect("localhost","root","","dbHaveMyRoom");
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
									print "<tr>";
									$record = mysqli_fetch_row($res);
									for($col = 0; $col <10; $col++)
									{										 
										if($col == 8)											
											print '<td><button type="submit" name="userPic" style="background-color: #b5e61d; border:none;" value="'.$record[$col].'">
													<img src="Images/camera.png" alt="cameraPic"  />
													</button></td>';					 
										
										else if($col == 9) print '<td><button type="submit" name="msgHost" style="background-color: #b5e61d; border:none;" value="'.$record[8].'">
																	<img src="Images/message.png" alt="messagePic" /></td>'; 
										else print "<td>".$record[$col]."</td>";												
										
									}
									
									print "</tr>";
									
								}
							}
		   				}
		   						
					?>
				</table>	
			</form>	
		</div>
	</body>
</html>