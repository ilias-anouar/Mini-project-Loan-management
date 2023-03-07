<?php
session_start();
include "../head.php";
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
                <div class="row g-3 align-items-center border border-secondary border-2 rounded pb-3 fs-5 px-3">
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
        <section>
            <h2>New books</h2><br>
            <hr>
        </section>
    </main>
</body>

</html>