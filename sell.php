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
	<form method="post">
		Name:  <input type="text" name="username" enctype="multipart/form-data"/><br />
		Description: <input type="text" name="description" /><br />
		Price: <input type="text" name="price" /><br />
		Number: <input type="text" name="number" /><br />
		Picture: <input type="file" name="file" /> <input type="submit" name="picture" value="Add picture" /><br />
		<input type="submit" name="submit" value="Add article" />
	</form>
</body>
</html>
<?php
echo $_REQUEST['username'] . "<br />";
echo $_REQUEST['description'] . "<br />";
echo $_REQUEST['price'] . "<br />";
echo $today = date("d/m/Y"); 
?>