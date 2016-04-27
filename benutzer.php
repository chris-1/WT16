
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



	$users = new mysqli ('localhost','root','','neuedb');



	$result = $users->query('Select * from user');

		while($z= $result->fetch_object()) 
	 	{

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

	 	}

 ?>

		</div>
</div>