<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Edit</title>
        <link rel="stylesheet" href="index.css">
    </head>
</html>
<?php
session_start();

include 'common/ConnectionDB.php';

$idItem = $_POST["ArticleId"];
$hasArticle = false;
if(preg_match("/^[0-9]*$/",$idItem) && $idItem != null){
    $result = QueryToDB("SELECT * FROM item INNER JOIN stock ON item.ID = stock.ID_item WHERE item.ID = ".$idItem);
    while($row = $result->fetch_assoc()){
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $date = $row['publication_date'];
        $picture = $row['link_picture'];
        $id_autor = $row['UUID_autor'];
        $available = $row['available'];
    }
    ?>
    <form method="post" enctype="multipart/form-data">
		Name:  <input type="text" id="itemname" name="itemname" enctype="multipart/form-data" required="required" value="<?php echo $name?>"/><br />
        <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
        <input type="submit" name="submit" value="Edit Name" />
    </form>
    <form method="post" enctype="multipart/form-data">
        Description: <input type="text" name="description" required="required" value="<?php echo $description?>"/><br />
        <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
        <input type="submit" name="submit" value="Edit Description" />
    </form>
    <form method="post" enctype="multipart/form-data">    
        Price: <input type="text" name="price" pattern="\d{1,5}\.[0-9]{2,2}" required="required" value="<?php echo $price?>"/><br />
        <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
        <input type="submit" name="submit" value="Edit Price" />
    </form>	
    <form method="post" enctype="multipart/form-data"> 
        Number: <input type="text" name="number" pattern="\d{1,4}" required="required" value="<?php echo $available?>"/><br />		
        <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
        <input type="submit" name="submit" value="Edit Stock" />
    </form>	
    <form method="post" enctype="multipart/form-data"> 
        Picture: <input type="file" name="file" /> <input type="submit" name="picture" value="Add picture" /><br />
        <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
        <input type="submit" name="submit" value="Edit picture" />
    </form>	
    <form action="deleteItem.php" method="post">
    <input type="hidden" name="ArticleId" value="<?php echo $idItem; ?>">
     <input type="submit" name="logout" value="DELETE" />
</form>	
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
}
$itemname =$_REQUEST["itemname"];
if ($name !=$itemname && $itemname !=""){
    QueryToDB("UPDATE item SET name = \"".$itemname."\" WHERE item.ID = ".$idItem."");
}
if ($description !=$_REQUEST['description'] && $_REQUEST['description'] !=""){
    QueryToDB("UPDATE item SET description = \"".$_REQUEST['description']."\" WHERE item.ID = ".$idItem."");
}
if ($price !=$_REQUEST['price'] && $_REQUEST['price'] !=""){
    QueryToDB("UPDATE item SET price = \"".$_REQUEST['price']."\" WHERE item.ID = ".$idItem."");
}
if ($available !=$_REQUEST['number'] && $_REQUEST['number'] !=""){
    QueryToDB("UPDATE stock SET available = \"".$_REQUEST['number']."\" WHERE ID_item = ".$idItem."");
}
if ($picture != $path && $path !=""){
    QueryToDB("UPDATE item SET link_picture = \"".$path."\" WHERE item.ID = ".$idItem."");
}
$ID_autor = $_SESSION['login'];

