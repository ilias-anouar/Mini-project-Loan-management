<?php 
require "../connect.php";
$id_reservation = $_POST['valid_reseravtion'];
$id_member = $_POST['valid_member'];
$id_book = $_POST['valid_book'];
// $delete_reservation = "DELETE FROM reservation WHERE Id_reservation = '$id_reservation'";
// $deleted = $conn->query($delete_reservation);
$add_loan = "INSERT loan (`Id_loan`, `loan_date`, `return_date`, `Id_reservation`, `Id_book`, `id_member`) 
VALUES (NULL, NOW(), NULL, '$id_reservation', '$id_book', '$id_member')";
$loaned = $conn->query($add_loan);
header('Location: admin.php');
?>