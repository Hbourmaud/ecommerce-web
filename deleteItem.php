<?php
session_start();

include 'common/ConnectionDB.php';
$idItem = $_POST["ArticleId"];
    QueryToDB("DELETE FROM item WHERE ID = ".$idItem."");
    QueryToDB("DELETE FROM stock WHERE ID_item = ".$idItem."");
    QueryToDB("DELETE FROM cart WHERE ID_item = ".$idItem."");
    header('Location: index.php');