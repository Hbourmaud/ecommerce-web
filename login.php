
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Login</title>
        <link rel="stylesheet" href="index.css">
    </head>

    <form action="/php_exam/login" method="post" class="middle">
        <label for="username">username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" style="margin-left: 10%" name="login" value="insert">
    </form>
</html>


<?php
session_start();
error_reporting(0);
if (($_SESSION['login'] != "")){
    header('Location: index');
}
if(array_key_exists('login', $_POST)){
    include 'common/ConnectionDB.php';
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $requested_password = "";
    $result = QueryToDB("SELECT * FROM user WHERE username = '$username'");
    while($row = $result->fetch_assoc()){
        $requested_password = $row['password'];
        $uuid = $row['UUID'];
    }
    
    if (password_verify($password, $requested_password)) {
        echo 'Password is valid!';
        session_start();
        $_SESSION['login'] = $uuid;
        header('Location: index');
    }else{
        echo 'Invalid password.';
    }
}
