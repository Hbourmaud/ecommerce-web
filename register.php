
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>register</title>
        <link rel="stylesheet" href="index.css">
    </head>
<form action="/php_exam/register.php" method="post" class="register">
    <label for="username">username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">password:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="mail">email:</label>
    <input type="text" id="mail" name="mail"><br><br>
    <button type="submit" style="margin-left: 10%" name="register">submit</button>
</form>
</html>

<?php
session_start();
error_reporting(0);
if (($_SESSION['login'] != "")){
    header('Location: index');
}
if(array_key_exists('register', $_POST)){
    include 'common/ConnectionDB.php';
        

    // Taking all 3 values from the form data(input)
    $username = $_REQUEST['username'];
    $password = password_hash($_REQUEST['password'],PASSWORD_BCRYPT); //  hash the password in bcrypt
    $email_adress = $_REQUEST['mail'];
    $uuid = uniqid();
    if (!filter_var($email_adress, FILTER_VALIDATE_EMAIL)) { //check email format
        $emailErr = "Invalid email format";
        exit($emailErr);
    }
    //we will check if user is already in our db
    $select = QueryToDB("SELECT * FROM user WHERE username = '".$username."'");
    if(mysqli_num_rows($select)) {
        exit('This username is already used!');
    }else{
        // will search if email already in our php_exam_db
        $select = QueryToDB("SELECT * FROM user WHERE email_adress = '".$email_adress."'");
        if(mysqli_num_rows($select)) {
            exit('This email address is already used!');
        }else{
            // We are going to insert the data into our db
            QueryToDB("INSERT INTO user (UUID, username, password, email_adress, profile_picture, role) VALUES ('$uuid','$username', '$password','$email_adress', 'https://cdn.discordapp.com/attachments/905799668938723329/1068195827618697320/photo_de_rpofil.jpg', 'user')");
            session_start();
            $_SESSION['login'] = $uuid;
            header('Location: index');
        }
    }
}
        ?>