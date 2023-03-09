<?php
session_start();
include "../head.php";
// include "../connect.php";
// // include "reservation.php"
// if (isset($_POST['Reserve'])) {
//     $id_book = $_POST['id'];
//     echo $id_book;
//     // $sql = "SELECT * FROM `Books` WHERE `id_book`='$id_book'";
//     // $stmt = $conn->query($sql);
//     // $reserve = $stmt->fetch(PDO::FETCH_ASSOC);
// }
?>

<body>
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
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My reservations</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn rounded-0 fs-4">Profile</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="d-flex justify-content-center mt-5">
            <form method="post">
                <div class="row g-3 align-items-center border border-secondary border-2 rounded pb-3 fs-5 px-3 fw-bold">
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">Type</label>
                    </div>
                    <div class="col-auto">
                        <input type="select" id="inputPassword6" class="form-control"
                            aria-describedby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">State</label>
                    </div>
                    <div class="col-auto">
                        <input type="select" id="inputPassword6" class="form-control"
                            aria-describedby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">Title</label>
                    </div>
                    <div class="col-auto">
                        <input type="select" id="inputPassword6" class="form-control"
                            aria-describedby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <input type="submit" name="search" value="Search" class="btn"
                            aria-describedby="passwordHelpInline">
                    </div>
                </div>
            </form>
        </section>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                    New books
                </div>
                <div class="d-flex cards">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="../images/a-Dolls-house.jpg" alt="book-cover"
                                    style="width:310px;height:400px;">
                            </div>
                            <div class="flip-card-back">
                                <h2 class="mt-5 fs-4">a Dolls house</h2>
                                <p class="text-black">Fyodor Dostoevsky</p>
                                <p class="text-black">1928</p>
                                <p class="text-black">Good condition</p>
                                <form id="reserve" action="" method="post">
                                    <input type="hidden" name="id" value="56">
                                    <button type="submit" name="Reserve" onclick="submitForm(event)"
                                        class="reservation px-4 py-2">Reserve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- modal reservations -->
    <div class="modal fade" id="reservation-modal" tabindex="-1" aria-labelledby="reservation" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="" alt="book image" id="book-image" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-5">
                                    loading...
                                </div>
                                <!-- <button type="submit" name="confirmation" class="confirmation">Confirm</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            var form = document.getElementById("reserve");
            var item_id = form.elements["id"].value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process_reservation.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Display the reservation details in the modal
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("reservation-modal").querySelector(".card-body").innerHTML = response.details;
                    document.getElementById("book-image").src = response.image;
                    $('#reservation-modal').modal('show');
                }
            }
            xhr.send("id=" + encodeURIComponent(item_id));
        }
    </script>
</body>

</html>