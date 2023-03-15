<?php
session_start();
include "../head.php";
include "../connect.php";
// $reservation = "SELECT * FROM reservation WHERE reservation_date = NOW()";
$loan = "SELECT * FROM loan";
$loan = $conn->query($loan);
$loan = $loan->fetchAll(PDO::FETCH_ASSOC);

?>