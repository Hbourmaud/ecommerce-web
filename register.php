<html>
<div>
    <a class="goback" href="/">  ← go back to the main page </a>
</div>
<form action="/php_exam/register.php" method="post">
    <label for="username">username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">password:</label>
    <input type="text" id="password" name="password"><br><br>
    <label for="mail">email:</label>
    <input type="text" id="mail" name="mail"><br><br>
    <input type="submit" value="insert">
</form>
</html>

<?php

        $conn = mysqli_connect("localhost", "root", "", "php_exam_db");

        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        // Taking all 3 values from the form data(input)
        $username = $_REQUEST['username'];
        $password = password_hash($_REQUEST['password'],PASSWORD_DEFAULT); //  hash the password in bcrypt
        $email_adress = $_REQUEST['mail'];

        //we will check if user is already in our db
        $select = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$username."'");
        if(mysqli_num_rows($select)) {
            exit('This username is already used!');
        }else{
            // will search if email already in our php_exam_db
            $select = mysqli_query($conn, "SELECT * FROM user WHERE email_adress = '".$email_adress."'");
            if(mysqli_num_rows($select)) {
                exit('This email address is already used!');
            }else{
                // We are going to insert the data into our db
                $sql = "INSERT INTO user VALUES ('','$username', '$password','$email_adress', ' ', 'https://cdn.discordapp.com/attachments/905799668938723329/1068195827618697320/photo_de_rpofil.jpg', 'user')";
            }
        }
        

        // Check if the query is successful
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";

            echo nl2br("\n$username\n $password\n "
                . "$email_adress\n");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>