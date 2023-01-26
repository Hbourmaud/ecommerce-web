<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>sell</title>
	<link></link>
</head>
<body>
	<form action="sell.php" method="post">
		Name:  <input type="text" name="username" /><br />
		Email: <input type="text" name="email" /><br />
		<input type="submit" name="submit" value="Ajouter l'article" />
	</form>
</body>
</html>
<?php
echo $_REQUEST['username'];
echo $_REQUEST['email'];
?>