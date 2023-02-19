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
	
	if(empty($_GET['id'])){    // le compte connecté
		// affichage des articles
		$result = QueryToDB("SELECT * FROM item WHERE id_autor = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')");
		?> <h3> Item : </h3> <?php
		while($row = $result->fetch_assoc()){
			?><p><?php echo $name = $row['name']; ?> </p>
			<p><?php echo $description = $row['description']; ?></p>
			<p><?php echo $price = $row['price']; ?>$</p>
			<p>Published : <?php echo $date = $row['publication_date']; ?></p>
			<img src="<?php echo $picture = $row['link_picture']; ?>">
			<?php
		}

		// affichage des factures
		$result = QueryToDB("SELECT * FROM invoice WHERE ID_user = (SELECT ID FROM user WHERE uuid = '$_SESSION[login]')");
		?> <h3> Invoice : </h3> <?php
		while($row = $result->fetch_assoc()){
			?><p><?php echo $date = $row['date of a transaction']; ?> </p>
			<p><?php echo $price = $row['amount']; ?>$</p>
			<p><?php echo $billing_adress = $row['billing_adress']; ?></p>
			<p><?php echo $billing_city = $row['billing_city']; ?></p>
			<p><?php echo $billing_postal_code = $row['billing_postal_code']; ?></p>
			<?php
		}
	} else {    // les autres comptes
		// affichage des informations du compte
		$result = QueryToDB("SELECT * FROM user WHERE ID = $_GET[id]");
		?> <h3> About the account : </h3> <?php
		while($row = $result->fetch_assoc()){
			?><p><?php echo $username = $row['username']; ?> </p>
			<p><?php echo $email_adress = $row['email_adress']; ?></p>
			<img src="<?php echo $picture = $row['profile_picture']; ?>">
			<?php
		}

		// affichage des articles
		$result = QueryToDB("SELECT * FROM item WHERE id_autor = (SELECT UUID FROM user WHERE id = $_GET[id])");
		?> <h3> Item : </h3> <?php
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