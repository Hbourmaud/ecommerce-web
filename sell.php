<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>sell</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<form method="post">
		Name:  <input type="text" name="username" enctype="multipart/form-data" required="required" /><br />
		Description: <input type="text" name="description" required="required" /><br />
		Price: <input type="text" name="price" pattern="\d{1,5}\.[0-9]{2,2}" required="required" /><br />
		Number: <input type="text" name="number" pattern="\d{1,4}" required="required" /><br />
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
// +\.\d{1,2}
?>