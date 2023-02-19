<?php
session_start();

include 'common/ConnectionDB.php';
$idItem = $_POST["ArticleId"];
    QueryToDB("DELETE FROM item WHERE ID = ".$idItem."");
    header('Location: index.php');