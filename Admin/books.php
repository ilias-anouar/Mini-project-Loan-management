<?php
session_start();
include "../head.php";
include "../connect.php";
if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['title'])) {
        $title = "title = '{$_POST['title']}'";
        $book_title = "SELECT Id_book FROM books WHERE $title";
        $id_book = $conn->query($book_title);
        $id_book = $id_book->fetch(PDO::FETCH_ASSOC);
        $id_book = $id_book['Id_book'];
        $search_param[] = "Id_book = '$id_book'";
    }
    if (!empty($_POST['nikename'])) {
        $nickname = "nickname = '{$_POST['nikename']}'";
        $nickname = "SELECT id_member FROM members WHERE $nickname";
        $id_member = $conn->query($nickname);
        $id_member = $id_member->fetch(PDO::FETCH_ASSOC);
        $id_member = $id_member['id_member'];
        $search_param[] = "id_member = '$id_member'";
    }



    $filter = "SELECT * FROM loan";
    if (!empty($search_param)) {
        if (count($search_param) == 1) {
            $filter .= " WHERE " . implode($search_param);
        } else {
            $filter .= " WHERE " . implode(" AND ", $search_param);
        }
    }
    $filter = $conn->query($filter);
    $result = $filter->fetchAll(PDO::FETCH_ASSOC);
} else {
    $pageId;

    if (isset($_GET['pageId'])) {
        $pageId = $_GET['pageId'];
    } else {
        $pageId = 1;
    }

    $endIndex = $pageId * 6;
    $StartIndex = $endIndex - 6;

    $sql = ("SELECT * FROM `books` LIMIT 8 OFFSET $StartIndex");

    $page = 'SELECT * FROM books';

    $books_lentgh = $conn->query($page)->rowCount();

    $pagesNum = 0;

    if (($books_lentgh % 8) == 0) {

        $pagesNum = $books_lentgh / 8;
    } else {
        $pagesNum = ceil($books_lentgh / 8);
    }

    $books = $conn->query($sql);
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
    <section class="d-flex justify-content-center mt-5">
        <form method="post">
            <div class="row g-3 align-items-center border border-secondary border-2 rounded pb-3 fs-5 px-3 fw-bold">
                <div class="col-auto">
                    <label for="title" class="col-form-label">Title</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="col-auto">
                    <label for="nikename" class="col-form-label">User nikename</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="nikename" name="nikename" class="form-control">
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
                    books
                </div>
                <div class="d-flex cards flex-wrap">
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
                                            data-bookid="<?php echo $book['Id_book'] ?>">edite</button>
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
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>
        <nav class="mt-5 mb-5 " aria-label="Page navigation example">
            <ul class=" flex-wrap pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="<?php echo "books.php?pageId=" . $i ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php }
    ?>
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