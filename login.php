
<html>
    <form action="/php_exam/login.php" method="post">
        <label for="username">username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="insert">
    </form>
</html>


<?php
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
        header('Location: index.php');
    }else{
        echo 'Invalid password.';
    }
}
