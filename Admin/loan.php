<?php
session_start();
include "../head.php";
include "../connect.php";
// $reservation = "SELECT * FROM reservation WHERE reservation_date = NOW()";

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

    $sql = ("SELECT * FROM `loan` LIMIT 6 OFFSET $StartIndex");

    $page = 'SELECT * FROM loan';

    $loan_lentgh = $conn->query($page)->rowCount();

    $pagesNum = 0;

    if (($loan_lentgh % 6) == 0) {

        $pagesNum = $loan_lentgh / 6;
    } else {
        $pagesNum = ceil($loan_lentgh / 6);
    }

    $result_loan = $conn->query($sql);
    $loan = $result_loan->fetchAll(PDO::FETCH_ASSOC);
}
?>
<style>
    .btn_valid {
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
        background-color: green;
        color: #ffffff;
        box-shadow: 0 8px 24px 0 rgba(252, 95, 95, 0.2);
    }

    .btn_valid:active,
    .btn_valid:focus {
        background-color: #D5E28C;
        color: green;
        box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
    }

    .btn_valid:hover {
        background-color: #D5E28C;
        color: green;
        box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
    }
</style>

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
                    search result
                </div>
                <div>
                    <table class="table table-bordered text-center fw-bold fs-4">
                        <tr>
                            <th>Cover image</th>
                            <th>Title</th>
                            <th>User nikename</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (count($result) > 0) {
                            foreach ($result as $book) {
                                $id_book = $book['Id_book'];
                                $id_memebr = $book['id_member'];
                                $date = $book['reservation_date'];
                                $id_loan = $book['Id_loan'];

                                $user_nikename = "SELECT nickname FROM members WHERE id_member = '$id_memebr'";
                                $nikename = $conn->query($user_nikename);
                                $nikename = $nikename->Fetch(PDO::FETCH_ASSOC);

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
                                        <?php echo $nikename['nickname'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo $date ?>
                                    </td>
                                    <td class="align-middle">
                                        <form action="Valid.php" method="post">
                                            <input type="hidden" value="<?php echo $id_loan ?>" name="valid_loan">
                                            <button class="btn_valid" type="button" name="valid_reservation">Valid</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-info text-center" role="alert">
                                you don't have any currunt reseravation
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <?php
    } else {
        ?>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-5 border-dark">
                    Borrowing
                </div>
                <div>
                    <table class="table table-bordered text-center fw-bold fs-4">
                        <tr>
                            <th>Cover image</th>
                            <th>Title</th>
                            <th>User nikename</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (count($loan) > 0) {
                            foreach ($loan as $book) {
                                $id_book = $book['Id_book'];
                                $id_memebr = $book['id_member'];
                                $date = $book['loan_date'];
                                $id_loan = $book['Id_reservation'];

                                $user_nikename = "SELECT nickname FROM members WHERE id_member = '$id_memebr'";
                                $nikename = $conn->query($user_nikename);
                                $nikename = $nikename->Fetch(PDO::FETCH_ASSOC);

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
                                        <?php echo $nikename['nickname'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo $date ?>
                                    </td>
                                    <td class="align-middle">
                                        <form action="check_return.php" method="post">
                                            <input type="hidden" value="<?php echo $id_loan ?>" name="valid_loan">
                                            <input type="hidden" value="<?php echo $id_memebr ?>" name="valid_member">
                                            <button class="btn_valid" type="submit" name="valid_reservation">Returned</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-info text-center" role="alert">
                                you don't have any currunt reseravation
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>
        <nav class="mt-5 mb-5 " aria-label="Page navigation example">
            <ul class=" flex-wrap pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="<?php echo "admin.php?pageId=" . $i ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php }
    ?>
    <?php
    include "../footer.php"
        ?>
</body>