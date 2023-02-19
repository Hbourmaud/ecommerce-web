<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Home</title>
        <link rel="stylesheet" href="index.css">
    </head>
<?php
include 'common/ConnectionDB.php';
$result = QueryToDB("SELECT * FROM item ORDER BY publication_date DESC");?>
<?php
    session_start();
    error_reporting(0);
if ($_SESSION['login']!= ""){
    ?>
    <form action="session_destroyer" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <form action="account" method="post">
        <button type="submit" name="account">Account</button>
    </form>
    <form action="cart" method="post">
        <button type="submit" name="cart">Cart</button>
    </form>
    <form action="sell" method="post">
        <button type="submit" name="sell">Sell</button>
    </form>
    <?php
}

if ($_SESSION['login'] == ""){?>
    <form action="login.php" method="post">
        <button type="submit" name="LOGIN">Login</button>
    </form>
    <form action="register.php" method="post">
        <button type="submit" name="REGISTER">Register</button>
    </form>
    <?php
}
?>


<?php $resultAdmin = QueryToDB("SELECT * FROM user WHERE uuid = \"".$_SESSION['login']."\" AND role = \"admin\"");
    $row = $resultAdmin->fetch_assoc();
    if($row != null){
        ?>
            <a href="./admin">Admin Page</a>
        <?php
    }
?>

    <div class="Rect">
    <?php while($row = $result->fetch_assoc()){
?> 
        <div class="box">
            <?php $id = $row['ID'];?>
            <?php $name = $row['name']; ?>
            <h3><?php echo $name ?></h3>
            <br />
            <?php $price = $row['price']; ?>

            <p>Price:<?php echo $price ?>$</p>

            <?php $date = $row['publication_date']; ?>

            <p>Published:<?php echo $date ?></p>

            <?php $picture = $row['link_picture'];?>

            <img src="<?php echo $picture ?>">
            <button onclick="window.location.href='detail.php?ArticleId=<?php echo $id;?>'">Details</button>
        </div>
    
        <?php }?>
        </div>
    
    
</html>