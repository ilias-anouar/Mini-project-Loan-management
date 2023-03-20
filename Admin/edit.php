<?php

require "../connect.php";
// Get the item ID from the POST data
$item_id = $_GET['input'];
$value = $_GET['condition'];
$stmt = $conn->query("UPDATE `books` SET `state` = '$value' WHERE `Id_book` = $item_id");
$stmt->execute();
header('Location: books.php');
?>