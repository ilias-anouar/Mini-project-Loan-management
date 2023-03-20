<?php
require "../connect.php";
$id_loan = $_POST['valid_loan'];
$id_member = $_POST['valid_member'];
// $id_member = 2;
// $id_loan = 1;
$return_loan = "UPDATE `loan` SET `return_date` = NOW() WHERE `loan`.`Id_loan` = $id_loan";
$return_loan = $conn->query($return_loan);
$check_date = "SELECT * FROM loan WHERE `Id_loan` = $id_loan";
$check_date = $conn->query($check_date);
$check_date = $check_date->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// var_dump($check_date);
// echo "</pre>";
$days = (strtotime($check_date['return_date']) - strtotime($check_date['loan_date'])) / (60 * 60 * 24);
$interval = floor($days);
$interval = 16;
if ($interval > 15) {
    $penalty = "UPDATE `members` SET `penalty` = penalty+1 WHERE `id_member` = $id_member";
    $penalty = $conn->query($penalty);
    $result = "SELECT penalty FROM members WHERE `id_member` = $id_member";
    $result = $conn->query($result);
    $result = $result->fetch(PDO::FETCH_ASSOC);
}
$id_reservation = $check_date['Id_reservation'];
$delete_loan = "DELETE FROM loan WHERE `Id_reservation` = $id_reservation";
$delete_reservation = "DELETE FROM reservation WHERE `Id_reservation` = $id_reservation";
$delete_loan = $conn->query($delete_loan);
$delete_reservation = $conn->query($delete_reservation);
header('Location: loan.php');
?>