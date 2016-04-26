
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
// Zeigt alle Informationen (Standardwert ist INFO_ALL)
 phpinfo(); 
 ?>

		</div>
</div>