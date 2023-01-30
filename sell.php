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
	<form method="post" enctype="multipart/form-data">
		Name:  <input type="text" name="username" enctype="multipart/form-data" required="required" /><br />
		Description: <input type="text" name="description" required="required" /><br />
		Price: <input type="text" name="price" placeholder="X.XX€" pattern="\d{1,5}\.[0-9]{2,2}" required="required" /><br />
		Number: <input type="text" name="number" pattern="\d{1,4}" required="required" /><br />
		Picture: <input type="file" name="file" /> <input type="submit" name="picture" value="Add picture" /><br />
		<input type="submit" name="submit" value="Add article" />
	</form>
</body>
</html>
<?php


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
		echo $path;
    }
    else{
        echo "Une erreur est survenue";
    }
}

include 'ConnectionDB.php';
$id_author = 1;
$today = date("d/m/Y");

echo QueryToDB("INSERT INTO item (name, description, price, publication_date, ID_autor, link_picture) VALUES ('$_REQUEST[username]', '$_REQUEST[description]', '$_REQUEST[price]', '$today', 5, '$path')");
?>