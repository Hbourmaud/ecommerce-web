<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sell</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
    <form action="/php_exam/index" method="post">
        <input type="submit" name="home" value="Home" />
    </form>
	<form action="/php_exam/sell" method="post" enctype="multipart/form-data">
		Name:  <input type="text" name="itemname" enctype="multipart/form-data" required="required" /><br />
		Description: <input type="text" name="description" required="required" /><br />
		Price: <input type="number" name="price" placeholder="X.XX€" pattern="\d{1,5}\.[0-9]{1,2}" required="required" /><br />
		Number: <input type="text" name="number" pattern="\d{1,4}" required="required" /><br />
		Picture: <input type="file" name="file" /><br />
		<input type="submit" name="submit" value="Add article" />
	</form>
</body>
</html>
<?php

session_start();
include 'common/ConnectionDB.php';
if($_SESSION['login'] == ""){
    header('Location: ./login');
    Exit();
}

if(isset($_FILES['file'])){
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $maxSize = 400000;

    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

        $uniqueName = uniqid('', true);
        $file = $uniqueName.".".$extension;
        move_uploaded_file($tmpName, './img/upload/'.$file);
		$path = "./img/upload/".$file;
    }
    else{
        echo "An error has occurred.";
    }
}

$UUID_autor = $_SESSION['login'];
$today = date("Y-m-d");

if ($_REQUEST['itemname'] != "" && $_REQUEST['description'] != "" && $_REQUEST['price'] != "" && $path != "") {
    $result = QueryToDB("INSERT INTO item (name, description, price, publication_date, UUID_autor, link_picture) VALUES ('$_REQUEST[itemname]', '$_REQUEST[description]', '$_REQUEST[price]', \"".$today."\", \"".$_SESSION['login']."\", '$path')");
    $itemID = QueryToDB("SELECT ID FROM item WHERE name = \"".$_REQUEST['itemname']."\" AND description = \"".$_REQUEST['description']."\" AND price = \"".$_REQUEST['price']."\" AND publication_date = \"".$today."\" AND UUID_autor = \"".$UUID_autor."\" AND link_picture = \"".$path."\"");
    $row = $itemID->fetch_assoc();
    $result1 = QueryToDB("INSERT INTO stock (ID_item, available) VALUES (\"".$row['ID']."\", '$_REQUEST[number]')");
}
?>