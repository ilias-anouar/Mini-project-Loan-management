<?php
require "../connect.php";
// Get the item ID from the POST data
$item_id = $_POST['id'];
$stmt = $conn->prepare('SELECT * FROM `Books` WHERE `id_book` = :item_id');
$stmt->bindParam(':item_id', $item_id);
$stmt->execute();
// Retrieve the item details as an associative array
$reserve = $stmt->fetch(PDO::FETCH_ASSOC);
// Close the database connection
$conn = null;

// Check if the item was found in the database
if (!$reserve) {
    echo '<p>Item not found.</p>';
} else {

    $response = array(
        "details" => '<h5 class="card-title text-black">Book title : ' . $reserve['title'] . '</h5>'
        . '<p class="card-text text-black">Written by : ' . $reserve['author'] . '</p>'
        . '<p class="card-text text-black">Published in : ' . $reserve['publishing_date'] . '</p>'
        . '<p class="card-text text-black">State : ' . $reserve['state'] . '</p>'
        . '<p class="card-text text-black">Number of pages : ' . $reserve['pages'] . '</p>'
        . '<p class="card-text text-black">Type : ' . $reserve['type'] . '</p>',
        "image" => '../' . $reserve['image'],
        "input" => $reserve['Id_book']
    );

    // Encode the response as JSON and output it
    echo json_encode($response);
}
?>