
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
	include "gd_functions.php";

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
		  gdcreatethumb($subdir.$fileupload['name'], $fileupload['name'], 'thumbnails/');

		}
	else echo 'Fehler beim Upload';
}



function grsc($imagefile, $name){ 
    $imagesize = getimagesize($imagefile);
	$editsuccess = false;
    $imagetype = $imagesize[2];
    switch ($imagetype)
    {
        // Bedeutung von $imagetype:
        // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
        case 1: // GIF
            $im = imagecreatefromgif($imagefile);
            break;
        case 2: // JPEG
            $im = imagecreatefromjpeg($imagefile);
            break;
        case 3: // PNG
            $im = imagecreatefrompng($imagefile);
            break;
        default:
            die('Unsupported imageformat');
    }
    
	

	$editsuccess = imagefilter($im, IMG_FILTER_GRAYSCALE);
	

	
	$gr = 'files/'.$name;
	imagejpeg($im, $gr);
	imagedestroy($im);
}

function rotate($imagefile, $name){ 
    $imagesize = getimagesize($imagefile);
	$editsuccess = false;
    $imagetype = $imagesize[2];
    switch ($imagetype)
    {
        // Bedeutung von $imagetype:
        // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
        case 1: // GIF
            $im = imagecreatefromgif($imagefile);
            break;
        case 2: // JPEG
            $im = imagecreatefromjpeg($imagefile);
            break;
        case 3: // PNG
            $im = imagecreatefrompng($imagefile);
            break;
        default:
            die('Unsupported imageformat');
    }
    
	

	$rotate = imagerotate($im, 270, 0);
	$im = $rotate;
	$editsuccess = $rotate;

	
	$rot = 'files/'.$name;
	imagejpeg($im, $rot);
	imagedestroy($im);
}

function rotate2($imagefile, $name){ 
    $imagesize = getimagesize($imagefile);
	$editsuccess = false;
    $imagetype = $imagesize[2];
    switch ($imagetype)
    {
        // Bedeutung von $imagetype:
        // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
        case 1: // GIF
            $im = imagecreatefromgif($imagefile);
            break;
        case 2: // JPEG
            $im = imagecreatefromjpeg($imagefile);
            break;
        case 3: // PNG
            $im = imagecreatefrompng($imagefile);
            break;
        default:
            die('Unsupported imageformat');
    }
    
	

	$rotate = imagerotate($im, 90, 0);
	$im = $rotate;
	$editsuccess = $rotate;

	
	$rot = 'files/'.$name;
	imagejpeg($im, $rot);
	imagedestroy($im);
}

function flip($imagefile, $name){ 
    $imagesize = getimagesize($imagefile);
	$editsuccess = false;
    $imagetype = $imagesize[2];
    switch ($imagetype)
    {
        // Bedeutung von $imagetype:
        // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
        case 1: // GIF
            $im = imagecreatefromgif($imagefile);
            break;
        case 2: // JPEG
            $im = imagecreatefromjpeg($imagefile);
            break;
        case 3: // PNG
            $im = imagecreatefrompng($imagefile);
            break;
        default:
            die('Unsupported imageformat');
    }
    
	

	$editsuccess = imageflip($im, IMG_FLIP_BOTH);
	

	
	$flip = 'files/'.$name;
	imagejpeg($im, $flip);
	imagedestroy($im);
}

?>

<div id="galeriewindow" class="draggable">
	
	<a href=index.php>
	<img src="672366-x-128.png" width=42px height=42px>
	</a>
		<div id=galeriediv>
		
	<form method="post" action="index.php?i=6" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
      Filename: <input name="userfile" type="file">
      <input type="submit" value="Upload">
	</form>
	
		<?php
	
		if(isset($_GET['delete']) && $_GET['delete']){
		unlink($subdir.$_GET['delete']);
		unlink('thumbnails/'.$_GET['delete']);

	}
	
	

	
	if(isset($_GET['show']) && $_GET['show']) {

		if(isset($_GET['f']) && $_GET['f']) {
			if($_GET["f"]==1)
			{
				grsc($subdir.$_GET['show'], $_GET['show']);
			}
			elseif($_GET["f"]==2)
			{
				flip($subdir.$_GET['show'], $_GET['show']);
			}
			elseif($_GET["f"]==3)
			{
				rotate($subdir.$_GET['show'], $_GET['show']);
			}
			elseif($_GET["f"]==4)
			{
				rotate2($subdir.$_GET['show'], $_GET['show']);
			}
			
		}
			
			
			
			echo"<img src='files/".$_GET['show']."'>";
			echo"<a href=\"index.php?i=6&f=1&show=".$_GET['show']."\">Grayscale</a>
			<a href=\"index.php?i=6&f=2&show=".$_GET['show']."\">Mirror</a>
			<a href=\"index.php?i=6&f=3&show=".$_GET['show']."\">Rotate</a>
			<a href=\"index.php?i=6&f=4&show=".$_GET['show']."\">Rotate2</a>";


	}
	
	$fileHandle = opendir($subdir);

	while($myFile = readdir($fileHandle)){
		if($myFile != "." && $myFile != ".."){
			echo "<p>";
			echo "<a href=\"index.php?i=6&show=".$myFile."\"><img src='thumbnails/".$myFile."'></a>
				<a href='index.php?i=6&delete=".$myFile."'>Delete</a>";
			echo "</p>";
		}
	}
	
	//var_dump($files);

	?>
	</div>
	
</div>


