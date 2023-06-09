<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme_user.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@1,8..144,200&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@200&display=swap');

    .footer-text {
        font-family: 'Sarabun', sans-serif;
        font-size: 24px;
    }

    a {
        font-family: 'Sarabun', sans-serif;
    }

    h3 {
        font-family: 'Sarabun', sans-serif;
    }

    h2 {
        font-family: 'Sigmar', cursive;
        font-size: 32px;
        color: #696cff;
    }

    .navbar {
        background-color: #ffffff;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    a.navbar-brand {
        color: white;
    }

    .card {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
        cursor: pointer;

    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    .carousel-item {
        width: 100%;
        height: 700px;
    }

    .slide {
        width: 100%;
        height: 700px;
    }

    .card-img-top {
        width: 100%;
        height: 400px;
        padding: 10px;
    }

    @media (max-width:767px) {
        .slide {
            max-width: 100%;
            height: 200px;
        }
    }

    @media (max-width:767px) {
        .carousel-item {
            max-width: 100%;
            height: 200px;
        }
    }

    #navbarSupportedContent {
        text-align: center;
    }

    .bi-cart-plus {
        font-size: 20px;
        padding: 5px;
        display: flex;
        align-items: center;
    }

    .num {
        font-family: 'Sigmar', cursive;
        background-color: red;
        position: absolute;
        color: white;
        font-size: 14px;
        margin-left: 16px;
        margin-bottom: 20px;
        width: 30px;
        text-align: center;
        padding: 4px;
        border-radius: 20px;
    }

    @media (min-width:992px) {
        .buy-now {
            display: none;
        }

    }

    @media (max-width:991px) {
        .max {
            display: none;
        }
    }

    .nav-link a {
        font-size: 24px;
    }

    @media only screen and (min-width: 375px) and (max-width: 767px) {
        a {
            font-size: 18px;
        }

        .navbar-light .navbar-nav .nav-link:hover:after,
        .navbar-light .navbar-nav .nav-link:focus:after {
            color: #696cff;
            transform: scaleX(0);
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        a {
            font-size: 24px;
        }

        .navbar-light .navbar-nav .nav-link:hover:after,
        .navbar-light .navbar-nav .nav-link:focus:after {
            color: #696cff;
            transform: scaleX(0);
        }


    }
</style>

<body>
    <?php
    if (!isset($_SESSION['username_user'])) {
        header("location: auth-login-basic.php");
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username_user']);
        header("location: auth-login-basic.php");
    }
    if (isset($_POST['add'])) {
        print_r($_POST['productid']);
        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'],  "productid");

            if (in_array($_POST['productid'], $item_array_id)) {
                echo "<script>alert('Product is already add in the cart')</script>";
                echo "<script>window.location = 'cart2.php'</script>";
            } else {

                $count = count($_SESSION['cart']);
                $item_array = array(
                    'productid' => $_POST['productid']
                );
                $_SESSION['cart'][$count] = $item_array;
                print_r($_SESSION['cart']);
            }
        } else {
            $item_array = array(
                'productid' => $_POST['productid']
            );
            //create new session variable
            $_SESSION['cart'][0] = $item_array;
            print_r($_SESSION['cart']);
        }
    }
    ?>
    <?php include('nav.php'); ?>

    <!-- ภาพสไลด์ -->
    <section>
        <div class="container-fluid p-0 mb-0">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <ol class="img carousel-indicators">
                    <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="slide" src="upload/ex.jpg" alt="First slide" />
                    </div>
                    <div class="carousel-item">
                        <img class="slide" src="upload/ex.jpg" alt="Second slide" />
                    </div>
                    <div class="carousel-item">
                        <img class="slide" src="upload/ex.jpg" alt="Third slide" />
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- /ภาพสไลด์ -->

    <!-- สินค้า -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">สินค้า /</span> สินค้าทั้งหมด</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-3">
                <?php
                include('connect.php');
                $sql = "SELECT * FROM product WHERE category_id = '6'";
                $result = mysqli_query($conn, $sql);
                while ($fetch = mysqli_fetch_array($result)) {
                ?>
                    <form action="cart2.php" method="post">
                        <div class="card-group mb-5">
                            <div class="card h-100">
                                <img class="card-img-top" src="<?php echo $fetch['product_img'] ?>" alt="Card image cap" />
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $fetch['product_name'] ?> <?php echo $fetch['product_width'] ?> X <?php echo $fetch['product_length'] ?> ซม.</h3>
                                    <h2 class="card-text text-center p-0">
                                        <?php echo $fetch['product_price'] ?> ฿
                                        <h2 />
                                        <hr class="dropdown-divider mb-4" />
                                        <input type="hidden" id="number" class="form-control" name="productid" value="<?php echo $fetch['product_id'] ?>" hidden />
                                        <div class="row d-grid gap-2 col-6 mx-auto mx-2">
                                            <button class="bt btn rounded-pill btn-outline-primary" type="submit" name="add">เพิ่มลงรถเข็น</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>


    <section id="basic-footer">
        <div class="container-fluid p-0">
            <footer class="footer bg-primary">
                <div class="container d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                    <div>
                        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                        <a href="javascript:void(0)" class="footer-link me-4">Help</a>
                        <a href="javascript:void(0)" class="footer-link me-4">Contact</a>
                        <a href="javascript:void(0)" class="footer-link">Terms &amp; Conditions</a>
                    </div>
                </div>
            </footer>
        </div>
    </section>
    <!-- /สินค้า -->

    <!-- ตระกร้าขนาดมือถือ -->
    <div class="buy-now">

        <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn rounded-pill btn-icon btn-danger btn-buy-now"> <i class="bi bi-cart-plus fs-3">
                <?php
                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span id='cart_count' class='num'>$count</span>";
                } else {
                    echo "<span id='cart_count' class='num'>0</span>";
                } ?>
            </i></a>
    </div>
    <!-- /ตระกร้าขนาดมือถือ -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>