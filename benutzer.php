
	<style>



#phpdiv {
	background-color:white;
	width:700px;
	height:350px;

	overflow: scroll;

}

#phpwindow {
	position:absolute;
	background-color:gray;
	width:700px;
	height:400px;

	top: 30%;
    left: 30%;
	z-index: 1;
}

    </style>
	
<div id="phpwindow" class="draggable">
	
	<a href=index.php>
	<img src="672366-x-128.png" width=42px height=42px>
	</a>
		<div id=phpdiv>

<?php
	include "upload_functions.php";


	$users = new mysqli ('localhost','root','','neuedb');
	$Name=$_SESSION["username"];
	$SQL = "SELECT *  FROM user  WHERE username='$Name'";


	$result = $users->query($SQL);
	$z= $result->fetch_object();


	 		if(isset($_POST["Benutzername"]))
			{
				$username=$_POST["Benutzername"];
				$SQL="UPDATE user
				SET username='$username'
				WHERE username='$z->username'";
				$users->query($SQL);


			}


	 		if(isset($_POST["Vorname"]))
			{
				$vorname=$_POST["Vorname"];
				$SQL="UPDATE user
				SET vorname='$vorname'
				WHERE vorname='$z->vorname'";
				$users->query($SQL);


			}

	 		if(isset($_POST["Nachname"]))
			{
				$nachname=$_POST["Nachname"];
				$SQL="UPDATE user
				SET nachname='$nachname'
				WHERE nachname='$z->nachname'";
				$users->query($SQL);


			}

	 		if(isset($_POST["email"]))
			{
				$email=$_POST["email"];
				$SQL="UPDATE user
				SET email='$email'
				WHERE email='$z->email'";
				$users->query($SQL);


			}

			echo '<form method="post" action="index.php?i=6" enctype="multipart/form-data">
      			<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
     				Filename: <input name="userfile" type="file">
      			<input type="submit" value="Upload">
			</form>';

	 		//Benutzer anzeigen
	 		echo "Benutzername ändern:";
			echo "<br>";	 		
	 		//echo $z->username;

	 		echo '<form method="post"> ';
  			echo '<input type="text" name="Benutzername"><br>';
 			echo '<input type="submit" value="Edit">';	
			echo "</form>";
			echo "<br>";

	 		echo "Vorname ändern:";
			echo "<br>";	 		
			//echo $z->vorname;

	 		echo '<form method="post"> ';
  			echo '<input type="text" name="Vorname"><br>';
 			echo '<input type="submit" value="Edit">';	
			echo "</form>";
			echo "<br>";			

	 		echo "Nachname ändern:";
			echo "<br>";
			//echo $z->nachname;

	 		echo '<form method="post"> ';
  			echo '<input type="text" name="Nachname"><br>';
 			echo '<input type="submit" value="Edit">';	
			echo "</form>";
			echo "<br>";			

	 		echo "email ändern:";
			echo "<br>";
			//echo $z->email;

	 		echo '<form method="post"> ';
  			echo '<input type="text" name="email"><br>';
 			echo '<input type="submit" value="Edit">';	
			echo "</form>";
			echo "<br>";			

 ?>

		</div>
</div>