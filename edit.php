<?php
session_start();

include 'common/ConnectionDB.php';

$idItem = htmlspecialchars($_GET["ArticleId"]);
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
        <input type="submit" name="submit" value="Edit Name" />
    </form>
    <form method="post" enctype="multipart/form-data">
        Description: <input type="text" name="description" required="required" value="<?php echo $description?>"/><br />
        <input type="submit" name="submit" value="Edit Description" />
    </form>
    <form method="post" enctype="multipart/form-data">    
        Price: <input type="text" name="price" pattern="\d{1,5}\.[0-9]{2,2}" required="required" value="<?php echo $price?>"/><br />
	    <input type="submit" name="submit" value="Edit Price" />
    </form>	
    <form method="post" enctype="multipart/form-data"> 
        Number: <input type="text" name="number" pattern="\d{1,4}" required="required" value="<?php echo $available?>"/><br />		
        <input type="submit" name="submit" value="Edit Stock" />
    </form>	
    <form method="post" enctype="multipart/form-data"> 
        Picture: <input type="file" name="file" /> <input type="submit" name="picture" value="Add picture" /><br />
        <input type="submit" name="submit" value="Edit picture" />
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
if ($name !=$itemname){
    QueryToDB("UPDATE item SET name = \"".$itemname."\" WHERE item.ID = ".$idItem."");
}
if ($description !=$_REQUEST['description']){
    QueryToDB("UPDATE item SET description = \"".$_REQUEST['description']."\" WHERE item.ID = ".$idItem."");
}
if ($price !=$_REQUEST['price']){
    QueryToDB("UPDATE item SET price = \"".$_REQUEST['price']."\" WHERE item.ID = ".$idItem."");
}
if ($available !=$_REQUEST['number']){
    QueryToDB("UPDATE stock SET available = \"".$_REQUEST['number']."\" WHERE ID_item = ".$idItem."");
}
if ($picture != $path){
    $picture = $path;
}
include 'common/ConnectionDB.php';
$ID_autor = $_SESSION['login'];
$today = date("d/m/Y");
