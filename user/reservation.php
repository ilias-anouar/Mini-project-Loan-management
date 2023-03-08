<?php
require "../connect.php";
if (isset($_POST['Reserve'])) {
    $id_book = $_POST['id'];
    $sql = "SELECT * FROM `Books` WHERE `id_book`='$id_book'";
    $stmt = $conn->query($sql);
    $reserve = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>