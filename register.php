
<html>
<form action="/php_exam/register.php" method="post">
    <label for="username">username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">password:</label>
    <input type="text" id="password" name="password"><br><br>
    <label for="mail">email:</label>
    <input type="text" id="mail" name="mail"><br><br>
    <input type="submit" name="register" value="insert">
</form>
</html>

<?php
if(array_key_exists('register', $_POST)){
    include 'common/ConnectionDB.php';
        

    // Taking all 3 values from the form data(input)
    $username = $_REQUEST['username'];
    $password = password_hash($_REQUEST['password'],PASSWORD_BCRYPT); //  hash the password in bcrypt
    $email_adress = $_REQUEST['mail'];
    $uuid = uniqid();

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
            header('Location: index.php');
        }
    }
}
        ?>