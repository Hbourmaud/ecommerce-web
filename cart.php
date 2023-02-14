<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>My Cart</title>
</head>
<body>

<?php
    include 'common/ConnectionDB.php';
    $cart_content = array();
    session_start();
    if($_SESSION['login'] == ""){
        header('Location: ./login');
        Exit();
    }

    if(isset($_GET['deleteItem'])){
        QueryToDB("DELETE FROM cart WHERE ID_user =\"".$_SESSION['login']."\" AND ID_item = \"".$_GET['deleteItem']."\"");
        header('Location: ./cart');
        Exit();
    }
    
    $result = QueryToDB("SELECT link_picture,name,description,price,COUNT(item.ID) AS 'nb',item.ID AS 'itemID' FROM cart INNER JOIN item ON cart.ID_item = item.ID WHERE ID_user =\"".$_SESSION['login']."\" GROUP BY item.ID;");
    while($row = $result->fetch_assoc()){
        $content = array();
        array_push($content,$row['link_picture']);
        array_push($content,$row['name']);
        array_push($content,$row['description']);
        array_push($content,$row['price']);
        array_push($content,$row['nb']);
        array_push($content,$row['itemID']);
        array_push($cart_content,$content);
    }
    if(count($cart_content) == 0){?>
        <p>Your cart is empty</p>
    <?php
    Exit();}
    foreach($cart_content as $item)
    {
        ?> 
            <div class="d-flex flex-row">
                <img src=<?php echo $item[0]; ?>>
                <h3><?php echo $item[1]; ?></h3>
                <p><?php echo $item[2]; ?></p>
                <h5><?php echo $item[3]; ?>$</h5>
                <input type="number" id="<?php echo "in".$item[1] ?>" value="<?php echo $item[4] ?>" min="1">
                <a href="<?php echo "?deleteItem=".$item[5] ?>">Remove</a>
                <br>
            </div>
        <?php
    }
?>
</body>
</html>