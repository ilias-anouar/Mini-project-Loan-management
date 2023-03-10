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
                            <button type="button" class="btn rounded-0 fs-4">Profile</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
        if (isset($success)) {
            include "confirmation.php";
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success ?>
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
                                <form action="confirmation.php" method="get">
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