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
		$result = QueryToDB("SELECT * FROM item WHERE id = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')");
		// echo $q;
		// if (mysqli_num_rows($q) > 0){
		// 	while($rowData = mysqli_fetch_assoc($q)){
		// 		echo $rowData["id"].'<br>';
		// 	}
		// }
		// while($row = $result->fetch_assoc()){
		// 	$name = $row['name'];
		// 	$description = $row['description'];
		// 	$price = $row['price'];
		// 	$date = $row['publication_date'];
		// 	$picture = $row['link_picture'];
		// }
		?>
		<h2><?php echo $name ?></h2>
		<p><?php echo $description ?></p>
		<p><?php echo $price ?>$</p>
		<p><?php echo $available ?></p>
		<p>Published : <?php echo $date ?></p>
		<img src="<?php echo $picture ?>">
		<?php
	}
?>
</body>
</html>