<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "choise library";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$json_file = file_get_contents('Books.json');
$books_array = json_decode($json_file, true);
foreach ($books_array as $book) {
    $title = $book['title'];
    $author = $book['author'];
    $image = $book['imageLink'];
    $state = $book['state'];
    $publishing_date = $book['year'];
    $date_of_purchase = 'NOW()';
    $pages = $book['pages'];
    $type = $book['type'];

    $sql = "INSERT INTO books (title, author, image, state, publishing_date, date_of_purchase, pages, type) 
            VALUES ('$title', '$author', '$image', '$state', '$publishing_date', $date_of_purchase, '$pages', '$type')";

    $conn->exec($sql);
}
$conn = null;

?>