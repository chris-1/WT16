
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

		include "gd_functions.php";

	$subdir = "./files/"; 		// Stelle, wo die Datei hinkopiert werden soll 
							// (hier das Unterverzeichnis "files" zum aktuellen Verzeichnis, wo diese php-Datei liegt
							// WICHTIG: das Unterverzeichnis muss beim Ausführen des Scripts bereits existieren
							// WICHTIG: das Verzeichnis muss die vollen Lese- und Schreibrechte haben
							// -> in Winscp Verzeichnis selektieren, rechte Maustaste -> Eigenschaften, bei octal 0777 eintragen !!!!!!!
							
if (isset($_FILES['picture'])) {							// wurde Datei per POST-Methode upgeloaded
	$fileupload=$_FILES['picture'];						// diverse Statusmeldungen ausschreiben
	/*
	echo "name: ".$fileupload['name']." <br>";				// Originalname der hochgeladenen Datei
	echo "type: ".$fileupload['type']." <br>";				// Mimetype der hochgeladenen Datei
	echo "size: ".$fileupload['size']." <br>";				// Größe der hochgeladenen Datei
	echo "error: ".$fileupload['error']." <br>";			// eventuelle Fehlermeldung
	echo "tmp_name: ".$fileupload['tmp_name']." <br>";		// Name, wie die hochgeladene Datei im temporären Verzeichnis heißt
	echo "ziel: ".$subdir.$fileupload['name']." <br>";		// Pfad und Dateiname, wo die hochgeladene Datei hinkopiert werden soll
	echo "<br>";*/
	
	// Prüfungen, ob Dateiupload funktioniert hat
	if ( !$fileupload['error'] 								// kein Fehler passiert
	    && $fileupload['size']>0							// Größe > 0	
    	&& $fileupload['tmp_name']							// hochgeladene Datei hat einen temporären Namen
    	&& is_uploaded_file($fileupload['tmp_name'])		// nur dann true, wenn Datei gerade erst hochgeladen wurde
		&& ($fileupload['type']=="image/png" || $fileupload['type']=="image/jpeg"))
		{
    	  move_uploaded_file($fileupload['tmp_name'],$subdir.$fileupload['name']);  // erst dann ins neue Verzeichnis verschieben
		  gdcreatethumb($subdir.$fileupload['name'], $fileupload['name'], 'profile/');
		  unlink($subdir.$fileupload['name']);
		}
	else echo 'Fehler beim Upload';
	}

				

	$users = new mysqli ('localhost','root','','neuedb');
	$Name=$_SESSION["username"];
	$SQL = "SELECT *  FROM user  WHERE username='$Name'";


	$result = $users->query($SQL);
	$z= $result->fetch_object();


			if (isset($_FILES['picture'])) {
				$fileupload=$_FILES['picture'];
				$subdir = "./profile/";
				$path = $subdir.$fileupload['name'];

				$SQL="UPDATE user
				SET picture='$path'
				WHERE picture='$z->picture'";
				$users->query($SQL);
			}


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

			echo '<form method="post" action="index.php?i=7" enctype="multipart/form-data">
      			<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
     				Filename: <input name="picture" type="file">
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