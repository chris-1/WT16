
<?php


function gdcreatethumb($file, $name, $dir)
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
	$thumbfile = $dir.$name;
	imagejpeg($thumb, $thumbfile);
	imagedestroy($thumb);
}
?>