<?php
include "head.php";
require "connect.php"
?>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['login'])) {
    $nickname = test_input($_POST["nickname"]);
    $password = test_input($_POST["logpass"]);

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
    $agree = $_POST['agree'];
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
                                                    <input type="password" name="logpass" class="form-style"
                                                        placeholder="Your Password" id="logpass" autocomplete="off"
                                                        required="" title="Your own password">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
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
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                                method="post">
                                                <div class="form-group">
                                                    <input type="text" name="signname" class="form-style"
                                                        placeholder="Your Full Name" id="signname" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' ]+$">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" id="email" autocomplete="off"
                                                        required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="address" class="form-style"
                                                        placeholder="Your address" id="address" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-location-pin-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="tel" name="phone" class="form-style"
                                                        placeholder="Your phone" id="phone" autocomplete="off"
                                                        required="" pattern="^(06|07|05)\d{8}">
                                                    <i class="input-icon uil uil-phone-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="cin" class="form-style"
                                                        placeholder="Your C.I.N" id="cin" autocomplete="off" required=""
                                                        pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-postcard"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="date" name="date" class="form-style"
                                                        placeholder="Your birth date" id="date" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-calender"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="occupation" class="form-style"
                                                        placeholder="Your occupation" id="occupation" autocomplete="off"
                                                        required="" pattern="(Student|officials|housewife)">
                                                    <i class="input-icon uil uil-smile"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="nickname" class="form-style"
                                                        placeholder="Enter nickname" id="nickname" autocomplete="off"
                                                        required="" pattern="[a-zA-Z]+">
                                                    <i class="input-icon uil uil-user-circle"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="your password" id="password" autocomplete="off"
                                                        required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="cpassword" class="form-style"
                                                        placeholder="Conform password" id="cpassword" autocomplete="off"
                                                        required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
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