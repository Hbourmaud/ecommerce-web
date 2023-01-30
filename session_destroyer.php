<?php
session_start();
session_destroy();
unset($_SESSION);
header('Location: index.php');

?>


<html>
    <!-- à mettre dans index/ deconnection -->
</html>
<!-- <?php
// session_start();
?>
<form action="session_destroyer.php" method="post">
     <input type="submit" name="logout" value="Déconnexion" />
</form>

