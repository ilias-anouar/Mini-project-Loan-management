<?php
include "head.php";
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
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nickname)) {
        $nickname_error = "Only letters and white space allowed";
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nickname)) {
        $error = "Only letters and white space allowed";
    }
} elseif (isset($_POST['signup'])) {

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
                                                        required="" title="Your own unique nickname">
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
                                                        required="">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" id="email" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="address" class="form-style"
                                                        placeholder="Your address" id="address" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-location-pin-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="tel" name="phone" class="form-style"
                                                        placeholder="Your phone" id="phone" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-phone-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="cin" class="form-style"
                                                        placeholder="Your C.I.N" id="cin" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-postcard"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="date" class="form-style"
                                                        placeholder="Your birth date" id="date" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-calender"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="occupation" class="form-style"
                                                        placeholder="Your occupation" id="occupation" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-smile"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="nickname" class="form-style"
                                                        placeholder="Enter nickname" id="nickname" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-user-circle"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="your password" id="password" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="cpassword" class="form-style"
                                                        placeholder="Conform password" id="cpassword" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="agree"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <a>Term & condition of user</a>
                                                        </label>
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

</body>

</html>