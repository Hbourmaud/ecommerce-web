<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
    if(isset($_GET['changeQuantity']) && isset($_GET['numberToChange'])){
        QueryToDB("DELETE FROM cart WHERE ID_user =\"".$_SESSION['login']."\" AND ID_item = \"".$_GET['changeQuantity']."\"");
        $number = $_GET['numberToChange'];
        if($number < 1){
            $number = 1;
        }
        for ($i=0; $i < $number; $i++) {
            QueryToDB("INSERT INTO cart (ID_user, ID_item) VALUES (\"".$_SESSION['login']."\" , \"".$_GET['changeQuantity']."\")");
        }
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
    $subtotal = 0;
    $numberItem = 0;
    foreach($cart_content as $item)
    {
        ?> 
            <div class="d-flex flex-row">
                <img src=<?php echo $item[0]; ?>>
                <h3><?php echo $item[1]; ?></h3>
                <p><?php echo $item[2]; ?></p>
                <h5><?php echo $item[3]; ?>$</h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Qty: <?php echo $item[4] ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo "?changeQuantity=".$item[5] . "&numberToChange=1" ?>">1</a>
                        <a class="dropdown-item" href="<?php echo "?changeQuantity=".$item[5] . "&numberToChange=2" ?>">2</a>
                        <a class="dropdown-item" href="<?php echo "?changeQuantity=".$item[5] . "&numberToChange=3" ?>">3</a>
                        <a class="dropdown-item" href="<?php echo "?changeQuantity=".$item[5] . "&numberToChange=4" ?>">4</a>
                        <a class="dropdown-item" href="<?php echo "?changeQuantity=".$item[5] . "&numberToChange=5" ?>">5</a>
                        <form method="GET" action="./cart">
                            <input type="hidden" name="changeQuantity" value="<?php echo $item[5] ?>">
                            <input name="numberToChange" class="dropdown-item" id="QuantityPersonalize" placeholder="Specify ..." type="number" min="1">
                            <button type="submit">Update</button>
                        </form>
                </div>
                <a href="<?php echo "?deleteItem=".$item[5] ?>">Remove</a>
            </div>
        <?php
        $subtotal += $item[4] * $item[3];
        $numberItem += $item[4];
    }
?>
<h2>SubTotal<?php echo " (".$numberItem." Articles) : ".$subtotal." $" ?></h2>
</body>
</html>