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
        include '../common/ConnectionDB.php';
        if($_SESSION['login'] == "" || ($_POST['toPaid'] == "" && $_POST['addressBilling'] = "")){
            header('Location: ../login');
            Exit();
        }elseif ($_POST['addressBilling'] != "") {
            $today = date("d/m/Y");
            QueryToDB("INSERT INTO invoice (ID_user, `date of a transaction`, amount, billing_adress, billing_city, billing_postal_code) VALUES (\"".$_SESSION['login']."\",\"".$today."\",\"".$_POST['toPaid']."\",\"".$_POST['addressBilling']."\",\"".$_POST['cityBilling']."\",\"".$_POST['postalBilling']."\")");
            header('Location: ../index');
            Exit();
        }
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
    <h3>Billing Information:</h3>
    <form action="" method="POST">
        <input type="text" name="addressBilling" placeholder="Billing Address">
        <input type="text" name="cityBilling" placeholder="Billing City">
        <input type="number" name="postalBilling" placeholder="Billing Postal Code">
        <input type="hidden" name="toPaid" value="<?php echo $_POST['toPaid'] ?>">
        <input type="submit" value="Confirm Payment">
    </form>
</body>
</html>