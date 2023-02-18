<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"type="text/css" href="../index.css"/>
    <title>Article Admin</title>
</head>
<?php
    include '../common/ConnectionDB.php';
    session_start();
    $nbArticle = 2; #Number of Article to show by section
    $resultAdmin = QueryToDB("SELECT * FROM user WHERE uuid = \"".$_SESSION['login']."\" AND role = \"admin\"");
    $row = $resultAdmin->fetch_assoc();
    if($row == null){
        header('Location: ../index');
        Exit();
    }
?>
<body>
    <div class="Rect">
<?php
    $result = QueryToDB("SELECT * FROM item ORDER BY publication_date DESC");
    while($row = $result->fetch_assoc()){
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
                    <form method="POST" action="../edit">
                        <input type="submit" value="Edit/Delete" >
                        <!-- Redirection vers /edit quand terminé -->
                    </form>
                </div>
            
                <?php }
?>
</div>
</body>
</html>