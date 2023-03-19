<?php
require "../connect.php";
$id_loan = $_POST['valid_loan'];
$id_member = $_POST['valid_member'];
// $id_member = 2;
// $id_loan = 1;
$return_loan = "UPDATE `loan` SET `return_date` = NOW() WHERE `loan`.`Id_loan` = $id_loan";
$return_loan = $conn->query($return_loan);
$check_date = "SELECT return_date,loan_date FROM loan WHERE `Id_loan` = $id_loan";
$check_date = $conn->query($check_date);
$check_date = $check_date->fetch(PDO::FETCH_ASSOC);
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
$delete_loan = "DELETE FROM loan WHERE `loan`.`Id_loan` = $id_loan";
$delete_loan = $conn->query($delete_loan);
header('Location: loan.php');
?>