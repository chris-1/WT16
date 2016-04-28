
<style>


#startdiv {
	position:absolute;
	background-color:gray;
	width:200px;
	height:300px;
	
	bottom: 50px;
    left: 0%;
	z-index: 5;
}

</style>
	
<div id=startdiv>
<?php

	echo "Benutzer ".$_SESSION['username']." ist angemeldet";
	//echo "test";

	$users = new mysqli ('localhost','root','','neuedb');
	$Name=$_SESSION["username"];
	$SQL = "SELECT picture  FROM user  WHERE username='$Name'";
	$result = $users->query($SQL);
	$z= $result->fetch_object();

	//echo $z->picture;
	echo "<img src = $z->picture>";
 ?>
	

</div>