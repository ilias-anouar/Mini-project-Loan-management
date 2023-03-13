<?php
session_start();
include "../head.php";
include "../connect.php";
$type = "SELECT DISTINCT `type` FROM `books`";
$state = "SELECT DISTINCT `state` FROM `books`";
$types = $conn->query($type);
$states = $conn->query($state);
$types = $types->fetchAll(PDO::FETCH_ASSOC);
$states = $states->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['type'])) {
        $search_param[] = "type = '{$_POST['type']}'";
    }
    if (!empty($_POST['State'])) {
        $search_param[] = "state = '{$_POST['State']}'";
    }
    if (!empty($_POST['title'])) {
        $search_param[] = "title LIKE '%{$_POST['title']}'";
    }

    // calculate the start index based on the current page number and the number of results per page
    $filter = "SELECT * FROM Books";
    if (!empty($search_param)) {
        $filter .= " WHERE " . implode(" AND ", $search_param);
    }
    $filter = $conn->query($filter);
    $result = $filter->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Get the current date
    $current_date = date('Y-m-d');

    // Prepare and execute the query
    try {
        $stmt = $conn->prepare('SELECT * FROM Books WHERE state="New" ORDER BY ABS(DATEDIFF(date_of_purchase, NOW())) ASC LIMIT 4');
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error executing query: ' . $e->getMessage();
        exit();
    }

    try {
        $books = $conn->prepare('SELECT * FROM Books WHERE state="Good condition" LIMIT 8');
        $books->execute();
    } catch (PDOException $e) {
        echo 'Error executing query: ' . $e->getMessage();
        exit();
    }

    // Fetch the results
    $new_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $books = $books->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_GET['confirmation'])) {
    $id = $_GET['input'];
    // $id = 10;
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
    $member_total = $num_reservation + $num_loan;
    $book_reservation = $conn->query($check_book_reseravation);
    $book_loan = $conn->query($check_book_loan);
    $book_reserved = $book_reservation->rowCount();
    $book_loaned = $book_loan->rowCount();
    $book_total = $book_reserved + $book_loaned;
    if ($member_total < 3 && $book_total == 0) {
        $sql = "INSERT INTO `reservation` (`Id_reservation`, `reservation_date`, `id_member`, `Id_book`) 
    VALUES (NULL, NOW(), '$id_member', '$id')";
        $stmt = $conn->query($sql);
        $success = "Thank you for your reservation request! We're happy to inform you that your booking has been tentatively reserved.  we kindly remind you that you have 24 hours to confirm this reservation before it expires.the next step is the loan process.";
        // header("Location: user.php");
    } elseif ($member_total == 3) {
        $no_more = "Sorry but it's look like you have reache the maximume of books you can borrow and reserve";
        // header("Location: user.php");
    } elseif ($book_total == 1) {
        $book_is_reservred = "sorry but that book is alredy reserved";
        // header("Location: user.php");
    }
}

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
        <?php
        if (isset($success)) {
            ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo $success ?>
            </div>
            <?php
        } elseif (isset($no_more)) {
            ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $no_more ?>
            </div>
            <?php
        } elseif (isset($book_is_reservred)) {
            ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $book_is_reservred ?>
            </div>
            <?php
        }
        ?>
        <section class="d-flex justify-content-center mt-5">
            <form method="post">
                <div class="row g-3 align-items-center border border-secondary border-2 rounded pb-3 fs-5 px-3 fw-bold">
                    <div class="col-auto">
                        <label for="type" class="col-form-label">Type</label>
                    </div>
                    <div class="col-auto">
                        <select type="select" id="type" class="form-select" name="type"
                            aria-describedby="passwordHelpInline">
                            <option value=""></option>

                            <?php
                            for ($i = 0; $i < count($types); $i++) {
                                $type = $types[$i]['type'];
                                echo "<option value='$type'>$type</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="State" class="col-form-label">State</label>
                    </div>
                    <div class="col-auto">
                        <select type="select" id="State" name="State" class="form-select"
                            aria-describedby="passwordHelpInline">
                            <option value=""></option>
                            <?php
                            for ($i = 0; $i < count($states); $i++) {
                                $state = $states[$i]['state'];
                                echo "<option value='$state'>$state</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="title" class="col-form-label">Title</label>
                    </div>
                    <div class="col-auto">
                        <input type="select" id="title" name="title" class="form-control"
                            aria-describedby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <input type="submit" name="search" value="Search" class="btn" aria-describedby="submit">
                    </div>
                </div>
            </form>
        </section>
        <?php
        if (isset($_POST['search'])) {
            ?>
            <section class="px-5 mt-5">
                <div class="px-5">
                    <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                        Your search result
                    </div>
                    <div class="d-flex flex-wrap" style="gap: 5em;">
                        <?php
                        foreach ($result as $book) {
                            ?>
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src="../<?php echo $book['image'] ?>" alt="book-cover"
                                            style="width:310px;height:400px;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h2 class="mt-5 fs-4">
                                            <?php echo $book['title'] ?>
                                        </h2>
                                        <p class="text-black">
                                            <?php echo $book['author'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['publishing_date'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['state'] ?>
                                        </p>
                                        <form id="reserve" action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $book['Id_book'] ?>">
                                            <button type="submit" name="Reserve" class="reservation px-4 py-2"
                                                data-bookid="<?php echo $book['Id_book'] ?>">Reserve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
        } else {
            ?>
            <section class="px-5 mt-5">
                <div class="px-5">
                    <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                        New books
                    </div>
                    <div class="d-flex cards">
                        <?php
                        foreach ($new_books as $book) {
                            ?>
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src="../<?php echo $book['image'] ?>" alt="book-cover"
                                            style="width:310px;height:400px;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h2 class="mt-5 fs-4">
                                            <?php echo $book['title'] ?>
                                        </h2>
                                        <p class="text-black">
                                            <?php echo $book['author'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['publishing_date'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['state'] ?>
                                        </p>
                                        <form id="reserve" action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $book['Id_book'] ?>">
                                            <button type="submit" name="Reserve" class="reservation px-4 py-2"
                                                data-bookid="<?php echo $book['Id_book'] ?>">Reserve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="px-5 mt-5 mb-5">
                <div class="px-5">
                    <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                        books
                    </div>
                    <div class="d-flex flex-wrap" style="gap: 5em;">
                        <?php
                        foreach ($books as $book) {
                            ?>
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src="../<?php echo $book['image'] ?>" alt="book-cover"
                                            style="width:310px;height:400px;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h2 class="mt-5 fs-4">
                                            <?php echo $book['title'] ?>
                                        </h2>
                                        <p class="text-black">
                                            <?php echo $book['author'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['publishing_date'] ?>
                                        </p>
                                        <p class="text-black">
                                            <?php echo $book['state'] ?>
                                        </p>
                                        <form id="reserve" action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $book['Id_book'] ?>">
                                            <button type="submit" name="Reserve" class="reservation px-4 py-2"
                                                data-bookid="<?php echo $book['Id_book'] ?>">Reserve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
        }
        ?>
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
                                <!-- <p class="text-danger">NB* : every reservation last for 24H </p> -->
                            </div>
                            <div class="col-md-8">
                                <form action="" method="get">
                                    <div class="card-body p-5">
                                        loading...
                                    </div>
                                    <input type="hidden" id="input" name="input">
                                    <button type="submit" name="confirmation" class="confirmation">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "../footer.php"
        ?>
    <script>
        $(document).on('click', '.reservation', function () {
            event.preventDefault();
            var bookid = $(this).data('bookid');
            $.ajax({
                url: 'process_reservation.php',
                type: 'POST',
                data: { id: bookid },
                dataType: 'json',
                success: function (response) {
                    $('#reservation-modal .card-body').html(response.details);
                    $('#reservation-modal #book-image').attr('src', response.image);
                    $('#reservation-modal #input').val(response.input);
                    $('#reservation-modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>
</body>

</html>