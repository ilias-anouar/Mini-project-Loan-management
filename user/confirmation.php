<?php
session_start();
require "../connect.php";
require "../functions.php";
// $id = $_GET['input'];
$id = 10;
$id_member = $_SESSION['id_member'];

// $check_reservation = "SELECT * FROM `reservation` loan WHERE id_member = '$id_member'";
$check_member_reservation = "SELECT * FROM reservation WHERE reservation.id_member = '$id_member'";
$check_member_loan = "SELECT * FROM loan WHERE loan.id_member = '$id_member'";

$check_book_reseravation = "SELECT * FROM reservation WHERE reservation.Id_book = '$id'";
$check_book_loan = "SELECT * FROM loan WHERE loan.Id_book = '$id'";

$reservation = $conn->query($check_member_reservation);
$loan = $conn->query($check_member_loan);
$num_reservation = $reservation->rowCount();
$num_loan = $loan->rowCount();
$member_total = $num_reservation+$num_loan;
echo $member_total;
$book_reservation = $conn->query($check_book_reseravation);
$book_loan = $conn->query($check_book_loan);
$book_reserved = $book_reservation->rowCount();
$book_loaned = $book_loan->rowCount();
$book_total = $book_reserved+$book_loaned;
echo $book_total;
if ($member_total<3 && $book_total==0) {
    $sql = "INSERT INTO `reservation` (`Id_reservation`, `reservation_date`, `id_member`, `Id_book`) 
    VALUES (NULL, NOW(), '$id_member', '$id')";
    $stmt = $conn->query($sql);
    $success = "Thank you for your reservation request! We're happy to inform you that your booking has been tentatively reserved.  we kindly remind you that you have 24 hours to confirm this reservation before it expires.the next step is the loan process.";
    // header("Location: user.php");
} elseif ($member_total==3) {
    $no_more = "Sorry but it's look like you have reache the maximume of books you can borrow and reserv";
    // header("Location: user.php");
} elseif($book_total==1){
    $book_is_reservred = "sorry but that book is alredy reserved";
    // header("Location: user.php");
}
?>