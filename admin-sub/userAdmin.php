<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>User Admin</title>
    <link rel="stylesheet" href="../index.css">
</head>
<?php
    include '../common/ConnectionDB.php';
    session_start();
    $resultAdmin = QueryToDB("SELECT * FROM user WHERE uuid = \"".$_SESSION['login']."\" AND role = \"admin\"");
    $row = $resultAdmin->fetch_assoc();
    if($row == null){
        header('Location: ../index');
        Exit();
    }
    if(isset($_GET['deleteAccount'])){
        $resultUUID = QueryToDB("SELECT UUID FROM user WHERE ID = \"".$_GET['deleteAccount']."\"");
        $rowDel = $resultUUID->fetch_assoc();
        $uuid = $rowDel['UUID'];
        QueryToDB("DELETE FROM cart WHERE ID_user =\"".$uuid."\"");
        QueryToDB("DELETE FROM stock WHERE ID_item IN (SELECT ID FROM item WHERE ID_autor =\"".$uuid."\")");
        QueryToDB("DELETE FROM item WHERE ID_autor =\"".$uuid."\"");
        QueryToDB("DELETE FROM user WHERE ID =\"".$_GET['deleteAccount']."\"");
        header('Location: user');
        Exit();
    }
?>
<body>
    <ul class="list-group">
        <?php
            $result = QueryToDB("SELECT * FROM user WHERE role = \"user\" ORDER BY ID DESC");
            
            while($row = $result->fetch_assoc()){
                ?>
                <div class="list-group-item d-flex">
                    <h5><?php echo $row['username']; ?></h5>
                    <?php echo $row['email_adress'];
                    echo "<img src=".$row['profile_picture'].">";
                    ?>
                    <a href="../account?id=<?php echo $row['ID']; ?>">Edit Account</a>
                    <a href="?deleteAccount=<?php echo $row['ID']; ?>">Delete Account</a>
                </div>
                <?php
        } ?>
    </ul>
</body>
</html>