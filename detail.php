<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Detail</title>
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Product add to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="outModal" tabindex="-1" aria-labelledby="outModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="outModal">Product actually Unavailable</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>

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
    QueryToDB("INSERT INTO cart (ID_user, ID_item) VALUES (\"".$_SESSION['login']."\" , ".$idItem.")");
    ?>
    <script> 
        const ModalOK = new bootstrap.Modal(document.getElementById('exampleModal'));
        ModalOK.show();
    </script>
    <?php
}elseif(array_key_exists('AddToCart', $_POST) && $available == "Out of Stock"){
    ?>
    <script> 
        const ModalOut = new bootstrap.Modal(document.getElementById('outModal'));
        ModalOut.show();
    </script>
    <?php
}
?>
</body>
</html>