<?php session_start(); ?>
<!doctype html>



<html>
	<head>
		<meta charset="utf-8">
			<title>
				Webtop
			</title>
			
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
  $(function() {	
	$(".draggable").draggable(
	{

		/*stop:function(){
			var offset = $this.offset();
			var posx = offset.left;
			var posy = offset.top;
			
		$.ajax(
		{
		method: "POST",
		url: "desktop.php",
		data: { x: "posx", y: "posy" }
		})
		}*/


	});
  });

 </script>
	</head>


<?php
	$username=false;
	$password=false;

	include "login_functions.php";
	if(isset($_GET["i"]))
		if($_GET["i"]==4)
		{
			setcookie("username","", time()-86400);
			session_destroy();
			header('Location: index.php');
		}
	
	if(isset($_POST["Benutzername"]) && isset($_POST["Passwort"]))
	{
		$username=$_POST["Benutzername"];
		$password=$_POST["Passwort"];
		//echo "<script type='text/javascript'>console.log('Inhalt von username lautet".$username."')</script>";
	}
	else
	{
	}

	if (isset($_SESSION["username"]) || isset($_COOKIE["username"]) || authenticateuser($username, $password))
		{
			if(isset($_POST['Benutzername']))
			{
				$_SESSION["username"]=$username;
			}
			$username= $_SESSION["username"];
			if(isset($_POST["remember"]))
			{
				setcookie("username", $username, time()+3600*24*365);
			}
			include "desktop.php";
		}
	else		{			
			include "login.php";
		}	

?>
</html>