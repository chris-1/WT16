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
	//prüfe eingeben
	//preg_match() gibt 1 zurück, falls eine Übereinstimmung zwischen pattern und subject gefunden wurde, 0, falls nicht oder FALSE, falls ein Fehler auftrat.
	 function check($string) { return preg_match( '/[^a-zA-Z0-9-_]/', $string ); }

	$username=false;
	$password=false;

	include "login_functions.php";
	if(isset($_GET["i"]))
		if(is_numeric($_GET["i"]) && $_GET["i"]==4)
		{
			setcookie("username","", time()-86400);
			session_destroy();
			header('Location: index.php');
		}
	
	if(isset($_POST["Benutzername"]) && isset($_POST["Passwort"]))
		if(!check($_POST["Benutzername"]) && !check($_POST["Passwort"]))
	{
		$username=$_POST["Benutzername"];
		$password=$_POST["Passwort"];
		$md5 = md5($password);
		if(isset($_POST["action"]))
			if($_POST["action"]=="register")
			{
				$users = new mysqli ('localhost','root','','neuedb');

				$SQL = "INSERT INTO user (username, pwd, vorname, nachname, email, picture) VALUES ('$username', '$md5', '0', '0', '0', '0')"; 

				$result = $users->query($SQL);
			}
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