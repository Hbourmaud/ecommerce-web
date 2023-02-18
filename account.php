<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>account</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
<?php
	session_start();
	include 'common/ConnectionDB.php';
	if($_SESSION['login'] == ""){
		header('Location: php_exam/login');
		Exit();
	}
	
	if(empty($_GET['id'])){     // isset($_GET['Id'])
		$q = "SELECT * FROM item WHERE id = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')";
		echo $q;
		echo QueryToDB("SELECT * FROM item WHERE id = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')");
	}
?>
</body>
</html>