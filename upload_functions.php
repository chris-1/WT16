
<style>

#galeriediv {
	background-color:white;
	width:700px;
	height:350px;

	overflow: scroll;

}

#galeriewindow {
	position:absolute;
	background-color:gray;
	width:700px;
	height:400px;

	top: 30%;
    left: 30%;
	z-index: 2;
}

</style>
	
	
<?php
$subdir = "./files/"; 		// Stelle, wo die Datei hinkopiert werden soll 
							// (hier das Unterverzeichnis "files" zum aktuellen Verzeichnis, wo diese php-Datei liegt
							// WICHTIG: das Unterverzeichnis muss beim Ausführen des Scripts bereits existieren
							// WICHTIG: das Verzeichnis muss die vollen Lese- und Schreibrechte haben
							// -> in Winscp Verzeichnis selektieren, rechte Maustaste -> Eigenschaften, bei octal 0777 eintragen !!!!!!!
							
if (isset($_FILES['userfile'])) {							// wurde Datei per POST-Methode upgeloaded
	$fileupload=$_FILES['userfile'];						// diverse Statusmeldungen ausschreiben
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
		  gdcreatethumb($subdir.$fileupload['name'], $fileupload['name']);
		}
	else echo 'Fehler beim Upload';
}

function gdcreatethumb($file, $name)
{
	$imagefile = $file;
	$imagesize = getimagesize($imagefile);
	$imagewidth = $imagesize[0];
	$imageheight = $imagesize[1];
	$imagetype = $imagesize[2];
	switch ($imagetype)
	{
		// Bedeutung von $imagetype:
		// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
		case 1: // GIF
			$image = imagecreatefromgif($imagefile);
			break;
		case 2: // JPEG
			$image = imagecreatefromjpeg($imagefile);
			break;
		case 3: // PNG
			$image = imagecreatefrompng($imagefile);
			break;
		default:
			die('Unsupported imageformat');
	}

	// Maximalausmaße
	$maxthumbwidth = 150;
	$maxthumbheight = 100;
	// Ausmaße kopieren, wir gehen zuerst davon aus, dass das Bild schon Thumbnailgröße hat
	$thumbwidth = $imagewidth;
	$thumbheight = $imageheight;
	// Breite skalieren falls nötig
	if ($thumbwidth > $maxthumbwidth)
	{
		$factor = $maxthumbwidth / $thumbwidth;
		$thumbwidth *= $factor;
		$thumbheight *= $factor;
	}
	// Höhe skalieren, falls nötig
	if ($thumbheight > $maxthumbheight)
	{
		$factor = $maxthumbheight / $thumbheight;
		$thumbwidth *= $factor;
		$thumbheight *= $factor;
	}
	// Thumbnail erstellen
	$thumb = imagecreatetruecolor($thumbwidth, $thumbheight);


	imagecopyresampled(
		$thumb,
		$image,
		0, 0, 0, 0, // Startposition des Ausschnittes
		$thumbwidth, $thumbheight,
		$imagewidth, $imageheight
	);

	//header('Content-Type: image/png');
	//imagepng($thumb);
	// In Datei speichern
	$thumbfile = 'thumbnails/'.$name;
	imagejpeg($thumb, $thumbfile);
	imagedestroy($thumb);
}
?>

		

	
		<?php
	/*<form method="post" action="index.php?i=6" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
      Filename: <input name="userfile" type="file">
      <input type="submit" value="Upload">
	</form>*/


	/*if(isset($_GET['delete']) && $_GET['delete']){
		unlink($subdir.$_GET['delete']);
		unlink('thumbnails/'.$_GET['delete']);
	}*/
	
	/*$fileHandle = opendir($subdir);
	
	while($myFile = readdir($fileHandle)){
		if($myFile != "." && $myFile != ".."){
			echo "<p>";
			echo "<img src='thumbnails/".$myFile."'>
				<a href='index.php?i=6&delete=".$myFile."'>Delete</a>";
			echo "</p>";
		}
	}*/
	//var_dump($files);

	?>

