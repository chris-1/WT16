	<body>	

	<style>
body {

    background-image: url("widescreen-apple-grassy-june-sunset.jpg");
	background-repeat: no-repeat;
    background-size: cover;
}


#login {
	position:absolute;
	top: 50%;
    left: 50%;

}

    </style>	

	
		<div id=login>
		<form action="index.php" method="POST">
			<table>
				<tr>		
					<td>Benutzername: </td>
					<td><input type="text" name="Benutzername"></td>
				</tr>
				<tr>		
					<td>Passwort:  </td>
					<td><input type="password" name="Passwort"></td>
				</tr>
				<tr>		
					<td>Angemeldet bleiben?:  </td>
					<td><input type="Checkbox" name="remember" value="0"></td>
				</tr>
			<br>
		</table>
		
			<input type="submit">	
		</form>
		</div>
	</body>