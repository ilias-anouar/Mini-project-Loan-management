<?php
if (isset($_POST['Reserve'])) {
    $value = $_POST['id'];
}
?>
<!-- modal reservations -->
<div class="modal fade" id="reservation" tabindex="-1" aria-labelledby="reservation" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/a-Dolls-house.jpg" alt="book image" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-5">
                                <h5 class="card-title text-black"><?php echo $value ?></h5>
                                <h5 class="card-title text-black">Book title : a Dolls house</h5>
                                <p class="card-text text-black">written by : Fyodor Dostoevsky</p>
                                <p class="card-text text-black">Published in : 1928</p>
                                <p class="card-text text-black">State : Good condition</p>
                                <p class="text-danger">NB*: every reservation last for 24H </p>
                                <!-- <button type="submit" name="confirmation" class="confirmation">Confirm</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
// header("Location: user.php")
?>