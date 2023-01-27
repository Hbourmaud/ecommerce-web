<?php
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
        $available = $row['available'];
        if($available == 0){$available = "Out of Stock";}else{$available .= " left";}
        $hasArticle = true;
    }
}
if(!$hasArticle){ ?>
    <p>Unknow Article</p>
<?php 
}else{?>

<h2><?php echo $name ?></h2>
<p><?php echo $description ?></p>
<p><?php echo $price ?>$</p>
<p><?php echo $available ?></p>
<p>Published : <?php echo $date ?></p>
<img src="<?php echo $picture ?>">
<form method="POST">
    <input type="submit" name="AddToCart" value="Add To Cart">
</form>
<?php }
if(array_key_exists('AddToCart', $_POST) && $available != "Out of Stock"){
    QueryToDB("INSERT INTO cart (ID_user, ID_item) VALUES (1,".$idItem.")");
}
?>