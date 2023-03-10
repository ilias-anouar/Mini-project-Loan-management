<?php
session_start();
require "../connect.php";
require "../functions.php";
$id = $_GET['input'];
$id_member = $_SESSION['id_member'];
$check_reservation = "SELECT * FROM `reservation` NATURAL JOIN loan WHERE id_member = '$id_member'";
$check_book = "SELECT * FROM `reservation` NATURAL JOIN loan WHERE Id_book = '$id'";
$stmt = $conn->query($check_reservation);
$checked_reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $sql = "INSERT INTO `reservation` (`Id_reservation`, `reservation_date`, `id_member`, `Id_book`) VALUES (NULL, NOW(), '$id_member', '$id'";
// $stmt = $conn->query($sql);
// $success = "Thank you for your reservation request! We're happy to inform you that your booking has been tentatively reserved.  we kindly remind you that you have 24 hours to confirm this reservation before it expires.the next step is the loan process.";
// header("Location: user.php");
?>