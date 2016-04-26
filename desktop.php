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

//benutzer
	if(isset($_GET["i"]))
		if($_GET["i"]==7)
			include "benutzer.php";
		
		
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
	<div id="benutzer" class="draggable">
	<a href=index.php?i=7>
	<img src="benutzer_318-52803.jpg" alt="benutzer" height="42" width="42"> 
	</a>
	</div>

	
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