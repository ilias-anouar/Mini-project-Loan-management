<?php
session_start();
require "../connect.php";
include "../head.php";
$id_member = $_SESSION['id_member'];
$member = "SELECT * FROM members WHERE id_member = '$id_member'";
$stmt = $conn->query($member);
$member = $stmt->Fetch(PDO::FETCH_ASSOC);
?>

<body>
    <style>
        #information {
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            color: #c4c3ca;
            background-color: #1f2029;
            overflow-x: hidden;
        }

        .btn_log {
            border-radius: 4px;
            height: 44px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            padding: 0 30px;
            letter-spacing: 1px;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -ms-flex-pack: center;
            text-align: center;
            border: none;
            background-color: #ff0000;
            color: #ffffff;
            box-shadow: 0 8px 24px 0 rgba(252, 95, 95, 0.2);
        }

        .btn_log:active,
        .btn_log:focus {
            background-color: #bd5757;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
        }

        .btn_log:hover {
            background-color: #b34949;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-lg bg-warning-subtle">
            <div class="container-fluid">
                <a class="navbar-brand text-warning"><span id="brand">Choice</span> library</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="loan.php">Borrowing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="books.php">Books</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" href="profile.php" class="btn rounded-0 fs-4">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="text-center">
        <h4 class="fs-1 mt-5 mb-5">Personal information</h4>
        <section class="px-5 mx-5">
            <div class="px-5">
                <div id="information">
                    <form action="update.php" method="get">
                        <div class="d-flex">
                            <div class="w-100 p-5">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Full name</label>
                                    <input type="text" name="full_name" class="form-control"
                                        value="<?php echo $member['full_name'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo $member['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">birth date</label>
                                    <input type="date" class="form-control" name="date"
                                        value="<?php echo $member['date_of_birth'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="<?php echo $member['phone'] ?>">
                                </div>
                            </div>
                            <div class="w-100 p-5">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nickname</label>
                                    <input type="text" class="form-control" name="nickname"
                                        value="<?php echo $member['nickname'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="<?php echo $member['address'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">C.I.N</label>
                                    <input type="text" class="form-control" name="cin"
                                        value="<?php echo $member['C_I_N'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Occopation</label>
                                    <input type="text" class="form-control" name="occupation"
                                        value="<?php echo $member['type'] ?>">
                                </div>
                            </div>
                        </div>
                        <button class="btn mb-3" type="submit" name="update_prof">update profile</button>
                </div>
                </form>
            </div>
            </div>
            <div class="d-flex justify-content-center gap-5 mt-5">
                <button type="button" class="btn_log" data-bs-toggle="modal" data-bs-target="#password">
                    change your Password
                </button>
                <form action="logout.php" method="get">
                    <button type="submit" class="btn_log">
                        Log out
                    </button>
                </form>
            </div>
        </section>
    </main>
    <!-- Password  Modal -->
    <div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change your Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update.php" method="get">
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <input type="password" name="old_pass" class="form-style pass"
                                placeholder="Your current Password" id="old_pass" autocomplete="off" required=""
                                title="Your own password">
                            <i class="togglePassword input-icon far fa-eye"
                                style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" name="new_pass" class="form-style pass" placeholder="New Password"
                                id="new_pass" autocomplete="off" required="" title="Your own password">
                            <i class="togglePassword input-icon far fa-eye"
                                style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" name="c_new_pass" class="form-style pass"
                                placeholder="Confirm new Password" id="c_new_pass" autocomplete="off" required=""
                                title="Your own password">
                            <i class="togglePassword input-icon far fa-eye"
                                style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div id="warning">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_pass" class="btn_log">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include "../footer.php"
        ?>
    <script>
        const togglePassword = document.querySelectorAll(".togglePassword");
        // const password = document.querySelectorAll(".pass");
        for (let i = 0; i < togglePassword.length; i++) {
            togglePassword[i].addEventListener("click", function (e) {
                // toggle the type attribute
                let input = togglePassword[i].closest("div").firstElementChild;
                const type =
                    input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);
                // toggle the eye slash icon
                this.classList.toggle("fa-eye-slash");
            });
        }
        let new_pass = document.getElementById('new_pass');
        let c_new_pass = document.getElementById('c_new_pass');
        let warning = document.getElementById('warning');
        c_new_pass.addEventListener('input', function () {
            if (c_new_pass.value != new_pass.value) {
                let msg = ` <div class="alert alert-warning" role="alert">
                                please enter the same password as abouve
                            </div>`
                warning.innerHTML = msg;
            } else {
                warning.innerHTML = ''
            }
        })
    </script>
</body>