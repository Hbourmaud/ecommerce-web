<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<title>account</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="change_username" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Changing</h1> -->
		<form method="post">
			Username : <input type="text" name="username" /><input type="submit" value="submit" />
		</form>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_email_adress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Changing</h1> -->
		<form method="post">
			Email adress : <input type="text" name="email_adress" /><input type="submit" value="submit"/>
		</form>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_balance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Changing</h1> -->
		<form method="post">
			Balance : <input type="number" name="balance" /><input type="submit" value="submit" />
		</form>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_profile_picture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Changing</h1> -->
		<form method="post" enctype="multipart/form-data">
			Profile picture : <input type="file" name="profile_picture" /><input type="submit" value="submit"/>
		</form>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>

<?php
	session_start();
	include 'common/ConnectionDB.php';
	if($_SESSION['login'] == ""){
		header('Location: php_exam/login');
		Exit();
	}
	?>

	<!-- Activation Modal -->
	<?php
		if(array_key_exists('edit_username', $_POST)){
			?>
			<script> 
				const ModalOK = new bootstrap.Modal(document.getElementById('change_username'));
				ModalOK.show();
			</script>
			<?php
		}
		if(array_key_exists('edit_email_adress', $_POST)){
			?>
			<script> 
				const ModalOK = new bootstrap.Modal(document.getElementById('change_email_adress'));
				ModalOK.show();
			</script>
			<?php
		}
		if(array_key_exists('edit_balance', $_POST)){
			?>
			<script> 
				const ModalOK = new bootstrap.Modal(document.getElementById('change_balance'));
				ModalOK.show();
			</script>
			<?php
		}
		if(array_key_exists('edit_profile_picture', $_POST)){
			?>
			<script> 
				const ModalOK = new bootstrap.Modal(document.getElementById('change_profile_picture'));
				ModalOK.show();
			</script>
			<?php
		}
		if($_POST['username'] != "") {
			$result = QueryToDB("SELECT * FROM user WHERE username = \"".$_POST['username']."\"");
			$row = $result->fetch_assoc();
			if($row == null){
				QueryToDB("UPDATE user SET username = \"".$_POST['username']."\" WHERE uuid = \"".$_SESSION['login']."\"");
			} else {
				echo "This username is already use.";
			}
		}
		if($_POST['email_adress'] != "") {
			if (!filter_var($_POST['email_adress'], FILTER_VALIDATE_EMAIL)) { //check email format
				$emailErr = "Invalid email format";
				exit($emailErr);
			}
			$result = QueryToDB("SELECT * FROM user WHERE email_adress = \"".$_POST['email_adress']."\"");
			$row = $result->fetch_assoc();
			if($row == null){
				QueryToDB("UPDATE user SET email_adress = \"".$_POST['email_adress']."\" WHERE uuid = \"".$_SESSION['login']."\"");
			} else {
				echo "This email adress is already use.";
			}
		}
		if($_POST['balance'] != "") {
			if($_POST['balance'] > 0 ){
				QueryToDB("UPDATE user SET balance = balance + \"".$_POST['balance']."\" WHERE uuid = \"".$_SESSION['login']."\"");
			} else {
				echo "Wrong value.";
			}
		}
		if($_FILES['profile_picture'] != "") {
			$tmpName = $_FILES['profile_picture']['tmp_name'];
			$name = $_FILES['profile_picture']['name'];
			$size = $_FILES['profile_picture']['size'];
			$error = $_FILES['profile_picture']['error'];
		
			$tabExtension = explode('.', $name);
			$extension = strtolower(end($tabExtension));
		
			$extensions = ['jpg', 'png', 'jpeg', 'gif'];
			$maxSize = 400000;
		
			if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
		
				$uniqueName = uniqid('', true);
				$file = $uniqueName.".".$extension;
				move_uploaded_file($tmpName, './img/profil_picture/'.$file);
				$path = "./img/profil_picture/".$file;
				QueryToDB("UPDATE user SET profile_picture = '$path' WHERE uuid = \"".$_SESSION['login']."\"");
			}
			else{
				echo "Une erreur est survenue";
			}
		}
	?>

	<?php
	if(empty($_GET['id'])){    // le compte connecté
		// affichage des informations du profil
		$result = QueryToDB("SELECT * FROM user WHERE uuid = '$_SESSION[login]'");
		?> <h3> Your account : </h3> <?php
		while($row = $result->fetch_assoc()){
			?><p><?php echo $username = $row['username']; ?> </p>
			<form method="post">
     			<input type="submit" name="edit_username" value="edit your username" />
			</form>
			<p><?php echo $email_adress = $row['email_adress']; ?></p>
			<form method="post">
     			<input type="submit" name="edit_email_adress" value="edit your email adress" />
			</form>
			<p> Your balance : <?php echo $balance = $row['balance']; ?></p>
			<form method="post">
     			<input type="submit" name="edit_balance" value="edit your balance" />
			</form>
			<img src="<?php echo $picture = $row['profile_picture']; ?>">
			<form method="post">
     			<input type="submit" name="edit_profile_picture" value="edit your profile picture" />
			</form>
			<?php
		}

		// affichage des articles
		$result = QueryToDB("SELECT * FROM item WHERE ID_autor = (SELECT UUID FROM user WHERE uuid = '$_SESSION[login]')");
		?> <h3> Item : </h3> <?php
		while($row = $result->fetch_assoc()){
			?><p><?php $ID = $row['ID']; ?> </p>
			<p><?php echo $name = $row['name']; ?> </p>
			<p><?php echo $description = $row['description']; ?></p>
			<p><?php echo $price = $row['price']; ?>$</p>
			<p>Published : <?php echo $date = $row['publication_date']; ?></p>
			<img src="<?php echo $picture = $row['link_picture']; ?>">
			<form action="detail?ArticleId=$ID" method="get">
     			<input type="submit" name="detail_page" value="detail" />
			</form>
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