<body>
	<style>

body {

    background-image: url("widescreen-apple-grassy-june-sunset.jpg");
	background-repeat: no-repeat;
    background-size: cover;
}

footer {
	position: fixed;
	padding: 5px;
	bottom: 0;
	left: 0;
	right: 0;
	background: #151846;
	border-color: #009da8;
}


    </style>
	
<?php
//phpinfo fenster
	if(isset($_GET["i"]))
		if($_GET["i"]<4)
			include "phpinfo.php";
		
//startmenü
	if(isset($_GET["i"]))
		if($_GET["i"]==5)
			include "start.php";

//galerie
	if(isset($_GET["i"]))
		if($_GET["i"]==6)
			include "galerie.php";
		
		
if(isset($_POST["x"]) && isset($_POST["y"]))
	{
		echo "post!";
	}
?>

	
	<div id="firefox" class="draggable">
	<a href=index.php?i=0>
	 <img src="120px-Mozilla_Firefox_3.5_logo_256.png" alt="firefox" height="42" width="42"> 
	</a>
	</div>
	<div id="chrome" class="draggable">
	<a href=index.php?i=1>
	 <img src="chrome.png" alt="chrome" height="42" width="42"> 
	 </a>
	</div>
	<div id="edge" class="draggable">
	<a href=index.php?i=2>
	 <img src="512px-Microsoft_Edge_logo.svg.png" alt="edge" height="42" width="42"> 
	 </a>
	</div>
	<div id="logout" class="draggable">
	<a href=index.php?i=4>
	 <img src="Logout-128.png" alt="logout" height="42" width="42"> 
	</a>
	</div>
	<div id="galerie" class="draggable">
	<a href=index.php?i=6>
	 <img src="icongallery2.png" alt="galerie" height="42" width="42"> 
	</a>
	</div>
	
	
<?php // Grafik initialisieren 
//$im = ImageCreate (200, 200);
// Farben definieren 
//$bgcolor = imagecolorallocate($im, 200, 200, 200); 
//$hellrot = imagecolorallocate($im, 255, 0, 0);  
// grafische Elemente und Text zeichnen 
//imagefilledellipse($im, 100, 120, 120, 30, $hellrot);  
// fertiges PNG-Bild erzeugen und an den Browser schicken 
//imagepng($im);  
// Bilddaten aus dem Speicher entfernen 
//imagedestroy($im); ?>

	
	<footer>
	<?php
	if(isset($_GET["i"]))
	{
		if($_GET["i"]==5)
		{
		echo '<a href=index.php>
	 <img src="arrow-40163_960_720 - Kopie.png" alt="start" height="40" width="40"> 
	</a>';

		}
		else
					{
	echo '<a href=index.php?i=5>
	 <img src="arrow-40163_960_720.png" alt="start" height="40" width="40"> 
	</a>';
		}
	}
	else
		{
	echo '<a href=index.php?i=5>
	 <img src="arrow-40163_960_720.png" alt="start" height="40" width="40"> 
	</a>';
		}
	?>
	</footer>

</body>