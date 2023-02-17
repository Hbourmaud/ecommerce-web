<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <?php
        session_start();
        if($_SESSION['login'] == "" || $_POST['toPaid'] == ""){
            header('Location: ../login');
            Exit();
        }
        include '../common/ConnectionDB.php';
        $result = QueryToDB("SELECT balance FROM USER WHERE UUID = \"".$_SESSION['login']."\"");
        while($row = $result->fetch_assoc()){
            $balanceUser = $row['balance'];
        }
    ?>

    Your actual balance : <?php echo $balanceUser ?>
    <br>
    Total Amount : <?php echo $_POST['toPaid'] ?>
    <br>
    Balance after payment : <?php echo $balanceUser - $_POST['toPaid'] ?>
    
</body>
</html>