<?php
$title = 'Home';
include_once "layout/header.php";
include_once "middlewares/guest.php";
include_once "layout/nav.php";
?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card text-left">
                <img class="card-img-top" src="images/product/1.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">laptop</h4>
                    <p class="card-text">15000 EGP</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-left" >
                <img class="card-img-top " src="images/product/3.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">phone</h4>
                    <p class="card-text">9000 EGP</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-left">
                <img class="card-img-top" src="images/product/2.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">TV</h4>
                    <p class="card-text">7000 EGP</p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include_once "layout/footer.php";
?>