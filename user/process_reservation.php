<?php
require "../connect.php";
// Get the item ID from the POST data
$item_id = $_POST['id'];
// Prepare a SELECT query to retrieve the item details
// $sql = "SELECT * FROM `Books` WHERE `id_book`='$id_book'";
// $stmt = $conn->query($sql);
// $reserve = $stmt->fetch(PDO::FETCH_ASSOC);
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
    // // Display the reservation details in the modal
    // echo '<h5 class="card-title text-black">Book title : ' . $reserve['title'] . '</h5>';
    // echo '<p class="card-text text-black">Written by : ' . $reserve['author'] . '</p>';
    // echo '<p class="card-text text-black">Published in : ' . $reserve['publishing_date'] . '</p>';
    // echo '<p class="card-text text-black">State : ' . $reserve['state'] . '</p>';
    // echo '<p class="text-danger">NB* : every reservation last for 24H </p>';
    $response = array(
        "details" => '<h5 class="card-title text-black">Book title : ' . $reserve['title'] . '</h5>'
        . '<p class="card-text text-black">Written by : ' . $reserve['author'] . '</p>'
        . '<p class="card-text text-black">Published in : ' . $reserve['publishing_date'] . '</p>'
        . '<p class="card-text text-black">State : ' . $reserve['state'] . '</p>'
        . '<p class="text-danger">NB* : every reservation last for 24H </p>',
        "image" => '../' . $reserve['image']
    );

    // Encode the response as JSON and output it
    echo json_encode($response);
}
?>