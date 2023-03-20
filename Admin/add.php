<?php
include "../connect.php";
$title = $_GET['title'];
$author = $_GET['author'];
$image = $_GET['image'];
$state = $_GET['state'];
$publishing_date = $_GET['publishing_date'];
$date_of_purchase = 'NOW()';
$pages = $_GET['pages'];
$type = $_GET['type'];

$sql = "INSERT INTO books (title, author, image, state, publishing_date, date_of_purchase, pages, type) 
            VALUES ('$title', '$author', 'images/$image', '$state', '$publishing_date', $date_of_purchase, '$pages', '$type')";

$conn->exec($sql);
header('Location: books.php');
?>