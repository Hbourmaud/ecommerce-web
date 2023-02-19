<html>
<link rel="stylesheet"type="text/css" href="index.css"/><?php
include 'common/ConnectionDB.php';
$result = QueryToDB("SELECT * FROM item ORDER BY publication_date DESC");?>
<?php
    session_start();
?>
<form action="session_destroyer" method="post">
    <input type="submit" name="logout" value="Logout" />
</form>
<form action="account" method="post">
    <input type="submit" name="account" value="Account" />
</form>
<form action="cart" method="post">
    <input type="submit" name="cart" value="Cart" />
</form>
<form action="sell" method="post">
    <input type="submit" name="sell" value="Sell" />
</form>

    <div class="Rect">
    <?php while($row = $result->fetch_assoc()){
?> 
        <div class="box">
            <?php $id = $row['ID'];?>
            <?php $name = $row['name']; ?>
            <h2><?php echo $name ?></h2>
            <br />
            <?php $price = $row['price']; ?>

            <p><?php echo $price ?>$</p>

            <?php $date = $row['publication_date']; ?>

            <p>Published : <?php echo $date ?></p>

            <?php $picture = $row['link_picture'];?>

            <img src="<?php echo $picture ?>">
            <a href="detail.php?ArticleId=<?php echo $id;?>">Details</a>
        </div>
    
        <?php }?>
        </div>
    
    
</html>