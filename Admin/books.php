<?php
session_start();
include "../head.php";
include "../connect.php";
if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['title'])) {
        $search_param[] = "title = '{$_POST['title']}'";
    }
    if (!empty($_POST['Author'])) {
        $search_param[] = "author = '{$_POST['Author']}'";
    }
    if (!empty($_POST['Condition'])) {
        $search_param[] = "state = '{$_POST['Condition']}'";
    }



    $filter = "SELECT * FROM books";
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
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#add-modal">add book</a>
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
                    <label for="Author" class="col-form-label">Author name</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="Author" name="Author" class="form-control">
                </div>
                <div class="col-auto">
                    <label for="Condition" class="col-form-label">Condition</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="Condition" name="Condition" class="form-control">
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
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="<?php echo "books.php?pageId=" . $i ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php }
    ?>
    <!-- modal reservations -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="reservation" aria-hidden="true">
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
                                <form action="edit.php" method="get">
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
    <!-- add modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">add book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="information">
                        <form action="add.php" method="get">
                            <div class="d-flex">
                                <div class="w-100 p-5">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">title</label>
                                        <input type="text" name="title" class="form-control" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">author</label>
                                        <input type="text" name="author" class="form-control" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">image</label>
                                        <input type="file" class="form-control" name="image" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">state</label>
                                        <input type="text" class="form-control" name="state" required="">
                                    </div>
                                </div>
                                <div class="w-100 p-5">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">publishing date</label>
                                        <input type="date" class="form-control" name="publishing_date" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">pages</label>
                                        <input type="number" class="form-control" name="pages" required="">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="exampleInputEmail1" class="form-label">type</label>
                                        <input type="text" class="form-control" name="type" required="">
                                    </div>
                                </div>
                            </div>
                            <button class="btn mb-3" type="submit" name="update_prof">add book</button>
                    </div>
                    </form>
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
                url: 'process.php',
                type: 'POST',
                data: { id: bookid },
                dataType: 'json',
                success: function (response) {
                    $('#modal .card-body').html(response.details);
                    $('#modal #book-image').attr('src', response.image);
                    $('#modal #input').val(response.input);
                    $('#modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>
</body>