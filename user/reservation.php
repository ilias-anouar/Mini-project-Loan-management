<?php
session_start();
require "../connect.php";
include "../head.php";
$id_member = $_SESSION['id_member'];
$reservation = "SELECT * FROM reservation WHERE id_member = '$id_member'";
$result_reservation = $conn->query($reservation);
$my_reservation = $result_reservation->fetchAll(PDO::FETCH_ASSOC);

$loan = "SELECT * FROM loan WHERE id_member = '$id_member'";
$result_loan = $conn->query($loan);
$my_loan = $result_loan->fetchAll(PDO::FETCH_ASSOC);

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
                            <a class="nav-link" href="user.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservation.php">My reservations</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" href="profile.php" class="btn rounded-0 fs-4">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                    My reservation
                </div>
                <div>
                    <table class="table table-bordered text-center fw-bold fs-4">
                        <tr>
                            <th>Cover image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Author name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach ($my_reservation as $book) {
                            $id_book = $book['Id_book'];
                            $id_reservation = $book['Id_reservation'];
                            $book = "SELECT * FROM books WHERE Id_book = '$id_book'";
                            $book = $conn->query($book);
                            $resulte = $book->Fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td class="p-0"><img src="../<?php echo $resulte['image'] ?>" alt="cover"
                                        style="width:300px;height:390px;" class="p-0"></td>
                                <td class="align-middle">
                                    <?php echo $resulte['title'] ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $resulte['type'] ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $resulte['author'] ?>
                                </td>
                                <td class="align-middle">
                                    <button type="button" name="check_cancel" data-bs-toggle="modal"
                                        data-bs-target="#cancel-modal<?php echo $id_reservation ?>">cancel</button>
                                </td>
                            </tr>
                            <!-- modal cancel -->
                            <div class="modal fade" id="cancel-modal<?php echo $id_reservation ?>" tabindex="-1"
                                aria-labelledby="reservation" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-3 text-center">
                                            <form action="cancel.php" method="get">
                                                <div class="card-body p-5 fw-bold fs-5">
                                                    are you sure you want to cancel this reservation
                                                </div>
                                                <input type="hidden" id="cancel" name="cancel"
                                                    value="<?php echo $id_reservation ?>">
                                                <button type="submit" class="btn-danger px-3 py-2"
                                                    name="Confirm">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                    My borrowing
                </div>
                <div>
                    <table class="table table-bordered text-center fw-bold fs-4">
                        <tr>
                            <th>Cover image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Author name</th>
                            <th>info</th>
                        </tr>
                        <?php
                        if (count($my_loan)<0) {
                            foreach ($my_loan as $book) {
                                $id_book = $book['Id_book'];
                                $Id_loan = $book['Id_loan'];
                                $book = "SELECT * FROM books WHERE Id_book = '$id_book'";
                                $book = $conn->query($book);
                                $resulte = $book->Fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                    <td class="p-0"><img src="../<?php echo $resulte['image'] ?>" alt="cover"
                                            style="width:300px;height:390px;" class="p-0"></td>
                                    <td class="align-middle">
                                        <?php echo $resulte['title'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo $resulte['type'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo $resulte['author'] ?>
                                    </td>
                                    <td class="align-middle">

                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-info text-center" role="alert">
                                you don't have any currunt reservation
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <?php
    include "../footer.php"
        ?>
</body>