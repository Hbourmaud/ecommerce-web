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
		$result = QueryToDB("SELECT * FROM item WHERE id_autor = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')");
		while($row = $result->fetch_assoc()){
			?><p><?php echo $name = $row['name']; ?> </p>
			<p><?php echo $description = $row['description']; ?></p>
			<p><?php echo $price = $row['price']; ?>$</p>
			<p>Published : <?php echo $date = $row['publication_date']; ?></p>
			<img src="<?php echo $picture = $row['link_picture']; ?>">
			<?php
		}
	}
?>
</body>
</html>