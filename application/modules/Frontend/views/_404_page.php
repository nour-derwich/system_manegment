<!-- Header -->
<?php require "template/header.php"; ?>

<div id="container">
    <div class="container">
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title-404 text-center">404</h1>
                <p class="text-center lead">Sorry!<br>
                    The page you requested cannot be found! </p>
                <div class="buttons text-center">
                    <button class="btn btn-primary btn-lg" onclick="javascript:history.go(-1);" type="button">
                        Continue
                    </button>
                </div>
                <br/><br/><br/>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>



<!-- Footer -->
<?php require "template/footer.php"; ?>