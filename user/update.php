<?php
session_start();
require "../connect.php";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id_member = $_SESSION['id_member'];
if (isset($_GET['update_prof'])) {
    $name = test_input($_GET['full_name']);
    $mail = test_input($_GET['email']);
    $address = test_input($_GET['address']);
    $phone = test_input($_GET['phone']);
    $cin = test_input($_GET['cin']);
    $date = test_input($_GET['date']);
    $occupation = test_input($_GET['occupation']);
    $nickname = test_input($_GET['nickname']);

    $update = "UPDATE `members` SET full_name = '$name', address = '$address',phone = '$phone',email = '$mail',C_I_N='$cin', date_of_birth = '$date',type = '$occupation',nickname = '$nickname' WHERE `members`.`id_member` = '$id_member'";
    // Prepare statement
    $stmt = $conn->prepare($update);
    // execute the query
    $stmt->execute();
    header('Location: profile.php');
} elseif (isset($_GET['update_pass'])) {
    $sql = "SELECT * FROM `members` WHERE id_member` = '$id_member'";
    $stmt = $conn->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($_GET["old_pass"], $result['password'])) {
        $new_pass = $_GET['c_new_pass'];
        $hashed_pass = password_hash($new_pass, PASSWORD_BCRYPT);
        $update_pass = "UPDATE `members` SET password = '$hashed_pass' WHERE `members`.`id_member` = '$id_member'";
        // Prepare statement
        $stmt = $conn->prepare($update_pass);
        // execute the query
        $stmt->execute();
        header('Location: profile.php');
    }
}
?>