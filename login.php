<?php
include "head.php";
require "connect.php";
include "functions.php";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['login'])) {
    $nickname = $_POST["nickname"];
    // $password = ;

    $sql = "SELECT * FROM `members` WHERE `nickname`='$nickname'";
    $stmt = $conn->query($sql);
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($_POST["login_pass"], $result['password'])) {
            if ($result['Role'] == 0) {
                session_start();
                $_SESSION['full_name'] = $result['full_name'];
                $_SESSION['nickname'] = $result['nickname'];
                $_SESSION['password'] = $result['password'];
                $_SESSION['id_member'] = $result['id_member'];
                header("Location: ./user/user.php");
            } else {
                session_start();
                $_SESSION['full_name'] = $result['full_name'];
                $_SESSION['nickname'] = $result['nickname'];
                $_SESSION['password'] = $result['password'];
                $_SESSION['id_member'] = $result['id_member'];
                header("Location: ./Admin/admin.php");
            }
        } else {
            echo $result['password'];
            $login_error = "You can't use your account any more";
        }
    } else {
        $login_error = "This account not exist";
    }

} elseif (isset($_POST['signup'])) {
    $name = test_input($_POST['signname']);
    $mail = test_input($_POST['email']);
    $address = test_input($_POST['address']);
    $phone = test_input($_POST['phone']);
    $cin = test_input($_POST['cin']);
    $date = test_input($_POST['date']);
    $occupation = test_input($_POST['occupation']);
    $nickname = test_input($_POST['nickname']);
    $password = test_input($_POST['password']);
    $cpassword = test_input($_POST['cpassword']);
    $member = new Member($name, $mail, $address, $phone, $cin, $date, $occupation, $nickname);

    $check_mail = "SELECT * FROM `members` WHERE `email`='$member->mail'";
    $stmt = $conn->query($check_mail);
    $checked_mail = $stmt->fetch(PDO::FETCH_ASSOC);

    $check_nickname = "SELECT * FROM `members` WHERE `nickname`='$member->nickname'";
    $stmt = $conn->query($check_nickname);
    $checked_nickname = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($checked_mail)) {
        $mail_error = "This email is already used";
    } elseif (is_array($check_nickname)) {
        $nickname_error = "This nickname is already used";
    } else {
        $password_hash = $member->hash_pass($password);
        $role = $member->check_member($mail);
        $insert = "INSERT INTO `members` (`id_member`, `full_name`, `address`, `email`, `phone`, `C_I_N`, `date_of_birth`, `type`, `nickname`, `password`, `opening_date`, `penalty`, `Role`) 
        VALUES (NULL, '$member->name', '$member->address', '$member->mail', '$member->phone', '$member->cin', '$member->date', '$member->occupation','$member->nickname','$password_hash',NOW(), '0', '$role')";
        $stmt = $conn->query($insert);
        $signed_up = "your account is created successfully please log in to your account";
        header("Location: login.php");
    }

}
?>

<body id="login">
    <!-- partial:index.partial.html -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand"><span id="brand">Choice</span> library</a>
            </div>
        </nav>
    </header>
    <div class="section">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 text-center align-self-center py-2">
                    <?php
                    if (isset($signed_up)) {
                        $element =
                            "<div class=\"alert alert-success\" role=\"alert\">
                                $signed_up
                            </div>";
                        echo $element;
                    }
                    ?>
                    <div class="section pb-5 pt-2 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form method="post"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="form-group">
                                                    <input type="text" name="nickname" class="form-style"
                                                        placeholder="Your nickname" id="nickname" autocomplete="off"
                                                        required="" pattern="[a-zA-Z]+"
                                                        title="Your own unique nickname">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="login_pass" class="form-style pass"
                                                        placeholder="Your Password" id="login_pass" autocomplete="off"
                                                        required="" title="Your own password">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <?php
                                                if (isset($login_error)) {
                                                    $element =
                                                        "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                                $login_error
                                                            </div>
                                                        </div>";
                                                    echo $element;
                                                }
                                                ?>
                                                <button name="login" type="submit" class="btn mt-4">submit</button>
                                                <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your
                                                        password?</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Sign Up</h4>
                                            <form id="signup_form"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                                method="post">
                                                <div class="form-group">
                                                    <input type="text" name="signname" class="form-style" value="<?php if (isset($name)) {
                                                        echo $name;
                                                    } ?>" placeholder="Your Full Name" id="signname" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' ]+$">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style" value="<?php if (isset($mail)) {
                                                        echo $mail;
                                                    } ?>" placeholder="Your Email" id="email" autocomplete="off"
                                                        required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <?php
                                                if (isset($mail_error)) {
                                                    $element =
                                                        "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                                $mail_error
                                                            </div>
                                                        </div>";
                                                    echo $element;
                                                }
                                                ?>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="address" class="form-style" value="<?php if (isset($address)) {
                                                        echo $address;
                                                    } ?>" placeholder="Your address" id="address" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-location-pin-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="tel" name="phone" class="form-style" value="<?php if (isset($phone)) {
                                                        echo $phone;
                                                    } ?>" placeholder="Your phone" id="phone" autocomplete="off"
                                                        required="" pattern="^(06|07|05)\d{8}">
                                                    <i class="input-icon uil uil-phone-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="cin" class="form-style" value="<?php if (isset($cin)) {
                                                        echo $cin;
                                                    } ?>" placeholder="Your C.I.N" id="cin" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-postcard"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="date" name="date" class="form-style" value="<?php if (isset($date)) {
                                                        echo $date;
                                                    } ?>" placeholder="Your birth date" id="date" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-calender"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="occupation" class="form-style" value="<?php if (isset($occupation)) {
                                                        echo $occupation;
                                                    } ?>" placeholder="Your occupation" id="occupation"
                                                        autocomplete="off" required=""
                                                        pattern="(Student|officials|housewife)"
                                                        title="Student/officials/housewife...">
                                                    <i class="input-icon uil uil-smile"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="nickname" class="form-style" value="<?php if (isset($nickname)) {
                                                        echo $nickname;
                                                    } ?>" placeholder="Enter nickname" id="nickname" autocomplete="off"
                                                        required="" pattern="[a-zA-Z]+">
                                                    <i class="input-icon uil uil-user-circle"></i>
                                                </div>
                                                <?php
                                                if (isset($nickname_error)) {
                                                    $element =
                                                        "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                                $nickname_error
                                                            </div>
                                                        </div>";
                                                    echo $element;
                                                }
                                                ?>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style pass"
                                                        value="<?php if (isset($password)) {
                                                            echo $password;
                                                        } ?>" placeholder="your password" id="password"
                                                        autocomplete="off" required=""
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="cpassword" class="form-style pass"
                                                        value="<?php if (isset($cpassword)) {
                                                            echo $cpassword;
                                                        } ?>" placeholder="Conform password" id="cpassword"
                                                        autocomplete="off" required=""
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <p id="pass_error"></p>
                                                <div class="form-group mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="agree"
                                                            id="flexCheckDefault" name="agree">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            By checking that you are agreeing to
                                                        </label><br>
                                                        <a class="text-decoration-underline text-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#term&conditions">Term & condition of
                                                            user</a>
                                                    </div>
                                                    <p id="check_error"></p>
                                                </div>
                                                <button name="signup" type="submit" class="btn mt-4">submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <!-- Modal -->
    <div class="modal fade" id="term&conditions" tabindex="-1" aria-labelledby="term&conditions" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p class="modal-title fs-5" id="term&conditions">Terms & conditions</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="text-black fw-bold">
                        <li>A person cannot borrow or reserve more than three books at the same time.</li>
                        <li>A borrowing operation must be preceded by a reservation.</li>
                        <li>The validity of a reservation is limited to 24 hours.</li>
                        <li>The loan period must not exceed 15 days.</li>
                        <li>A person who submits a work beyond 15 days, receives a penalty.</li>
                        <li>A person who accumulates more than 3 penalties does not have the right to continue to borrow
                            the books. And his account will be immediately locked.</li>
                        <li>No operation will be possible without authentication, even a simple consultation.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>