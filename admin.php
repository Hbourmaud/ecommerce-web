<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<?php
    include 'common/ConnectionDB.php';
    session_start();
    $resultAdmin = QueryToDB("SELECT * FROM user WHERE uuid = \"".$_SESSION['login']."\" AND role = \"admin\"");
    $row = $resultAdmin->fetch_assoc();
    if($row == null){
        header('Location: index');
        Exit();
    }
?>
<body>
    <a href="./admin/article">See Article Published</a>
    <a href="./admin/user">See User Account</a>
</body>
</html>