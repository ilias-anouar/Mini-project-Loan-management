<?php
require "../connect.php";
$id_reservation = $_GET['cancel'];
$delete = "DELETE FROM reservation WHERE Id_reservation = '$id_reservation'";
$stmt = $conn->query($delete);
header('Location: reservation.php');
?>