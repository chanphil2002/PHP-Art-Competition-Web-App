<?php
include("partials/database.php");
include("partials/header.php");

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../general/registeredUserLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/72d9213ec5.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../judge/judge.css">
</head>

<body>
    <!-- Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

        <!-- Indicator -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <!-- Contents -->
        <div class="carousel-inner">

            <?php
            // Popular Competition
            $sql1 = "SELECT * FROM competition WHERE status = 'On-Going' ORDER BY noOFEntries DESC LIMIT 1";
            $res1 = mysqli_query($conn, $sql1);
            $compDetails = mysqli_fetch_assoc($res1);
            $name = $compDetails["compName"];
            $pic = $compDetails["compPic"];
            ?>

            <div class="carousel-item active" data-bs-interval="2000">
                <a href="">
                    <center><img src="../materials/image/<?php echo $pic ?>" style="width:auto;height:360px;" class="" alt="..."></center>
                </a>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <div>
                        <h5 style="color:black;display: inline-block"><?php echo $name ?> &nbsp;</h5>
                        <span class="badge rounded-pill position-absolute bg-danger" style="height:20px">Popular</span>
                    </div>
                    <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                </div>
            </div>

            <?php
            // Upcoming Competition
            $sql2 = "SELECT * FROM competition WHERE status='On-Going' ORDER BY releaseDate DESC LIMIT 2";
            $res2 = mysqli_query($conn, $sql2);

            while ($compDetails = mysqli_fetch_assoc($res2)) {
                $name = $compDetails["compName"];
                $pic = $compDetails["compPic"];
            ?>

                <div class="carousel-item" data-bs-interval="2000">
                    <a href="">
                        <center><img src="../materials/image/<?php echo $pic ?>" style="width:auto;height:360px;" class="" alt="..."></center>
                    </a>
                    <br><br><br><br><br><br>
                    <div class="carousel-caption d-none d-md-block">
                        <div>
                            <h5 style="color:black;display: inline-block"><?php echo $name ?> &nbsp;</h5>
                            <span class="badge rounded-pill position-absolute bg-success" style="height:20px">New</span>
                        </div>
                        <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                    </div>
                </div>

            <?php } ?>

            <?php
            // New Competition
            $sql3 = "SELECT * FROM competition WHERE status='Upcoming' ORDER BY releaseDate ASC LIMIT 2";
            $res3 = mysqli_query($conn, $sql3);

            while ($compDetails = mysqli_fetch_assoc($res3)) {
                $name = $compDetails["compName"];
                $pic = $compDetails["compPic"];
            ?>

                <div class="carousel-item" data-bs-interval="2000">
                    <a href="">
                        <center><img src="../materials/image/<?php echo $pic ?>" style="width:auto;height:360px;" class="" alt="..."></center>
                    </a>
                    <br><br><br><br><br><br>
                    <div class="carousel-caption d-none d-md-block">
                        <div>
                            <h5 style="color:black;display: inline-block"><?php echo $name ?> &nbsp;</h5>
                            <span class="badge rounded-pill position-absolute bg-primary" style="height:20px">Upcoming</span>
                        </div>
                        <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                    </div>
                </div>

            <?php } ?>

        </div>

        <!-- Prev & Next Button -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br>
    <hr>

    <!-- Popular Competition -->
    <h2 class="ml-5" style="margin-left: 15px;">Most Popular Competition</h2>

    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
            $sql4 = "SELECT * FROM competition WHERE status = 'On-Going' ORDER BY noOFEntries DESC LIMIT 3";
            $res4 = mysqli_query($conn, $sql4);

            while ($compDetails = mysqli_fetch_assoc($res4)) {
                $pic = $compDetails["compPic"];
                $name = $compDetails["compName"];
                $category = $compDetails["category"];
            ?>

                <div class="col-md-4 margincon1">
                    <div class="card border-1 grid-list">
                        <a href="" class="stretched-link">
                            <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                        </a>
                        <div class="card-body description text-truncate text-color-2">
                            <?php echo $category; ?>
                            <div class="title text-truncate">
                                <?php echo $name; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>

    <!-- 2D Digital Arts -->
    <div>
        <h2 class="ml-5" style="margin-left: 15px; display:inline-block">2D Digital Arts</h2>
        <a href="allComp.php?category=2D" style="color:darkblue; margin-left: 900px">See more&nbsp;<i class="fa-solid fa-angle-right"></i></a>
    </div>


    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
            $sql4 = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE category = '2D' AND status != 'Pending' LIMIT 3";
            $res4 = mysqli_query($conn, $sql4);

            while ($compDetails = mysqli_fetch_assoc($res4)) {
                $pic = $compDetails["compPic"];
                $name = $compDetails["compName"];
                $status = $compDetails["status"];
                $orgName = $compDetails["organizerName"];
            ?>

                <div class="col-md-4 margincon1">
                    <div class="card border-1 grid-list">
                        <a href="" class="stretched-link">
                            <?php if ($status == "Upcoming") { ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                            <?php } elseif ($status == "Past") { ?>
                                <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                            <?php } ?>
                            <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                        </a>
                        <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                            <?php echo $orgName; ?>
                            <div class="title text-truncate">
                                <?php echo $name; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>

    <!-- 3D Digital Arts -->
    <div>
        <h2 class="ml-5" style="margin-left: 15px; display:inline-block">3D Digital Arts</h2>
        <a href="allComp.php?category=3D" style="color:darkblue; margin-left: 900px">See more&nbsp;<i class="fa-solid fa-angle-right"></i></a>
    </div>


    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
            $sql5 = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE category = '3D' AND status != 'Pending' LIMIT 3";
            $res5 = mysqli_query($conn, $sql5);

            while ($compDetails = mysqli_fetch_assoc($res5)) {
                $pic = $compDetails["compPic"];
                $name = $compDetails["compName"];
                $status = $compDetails["status"];
                $orgName = $compDetails["organizerName"];
            ?>

                <div class="col-md-4 margincon1">
                    <div class="card border-1 grid-list">
                        <a href="" class="stretched-link">
                            <?php if ($status == "Upcoming") { ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                            <?php } elseif ($status == "Past") { ?>
                                <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                            <?php } ?>
                            <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                        </a>
                        <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                            <?php echo $orgName; ?>
                            <div class="title text-truncate">
                                <?php echo $name; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>

    <!-- Paintings -->
    <div>
        <h2 class="ml-5" style="margin-left: 15px; display:inline-block">Visual Art - Paintings</h2>
        <a href="allComp.php?category=Paintings" style="color:darkblue; margin-left: 800px">See more&nbsp;<i class="fa-solid fa-angle-right"></i></a>
    </div>


    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
            $sql6 = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE category = 'Paintings' AND status != 'Pending' LIMIT 3";
            $res6 = mysqli_query($conn, $sql6);

            while ($compDetails = mysqli_fetch_assoc($res6)) {
                $pic = $compDetails["compPic"];
                $name = $compDetails["compName"];
                $status = $compDetails["status"];
                $orgName = $compDetails["organizerName"];
            ?>

                <div class="col-md-4 margincon1">
                    <div class="card border-1 grid-list">
                        <a href="" class="stretched-link">
                            <?php if ($status == "Upcoming") { ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                            <?php } elseif ($status == "Past") { ?>
                                <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                            <?php } ?>
                            <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                        </a>
                        <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                            <?php echo $orgName; ?>
                            <div class="title text-truncate">
                                <?php echo $name; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>

    <!-- Photography -->
    <div>
        <h2 class="ml-5" style="margin-left: 15px; display:inline-block">Visual Art - Photography</h2>
        <a href="allComp.php?category=Photography" style="color:darkblue; margin-left: 750px">See more&nbsp;<i class="fa-solid fa-angle-right"></i></a>
    </div>


    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
            $sql7 = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE category = 'Photography' AND status != 'Pending' LIMIT 3";
            $res7 = mysqli_query($conn, $sql7);

            while ($compDetails = mysqli_fetch_assoc($res7)) {
                $pic = $compDetails["compPic"];
                $name = $compDetails["compName"];
                $status = $compDetails["status"];
                $orgName = $compDetails["organizerName"];
            ?>

                <div class="col-md-4 margincon1">
                    <div class="card border-1 grid-list">
                        <a href="" class="stretched-link">
                            <?php if ($status == "Upcoming") { ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                            <?php } elseif ($status == "Past") { ?>
                                <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                            <?php } ?>
                            <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                        </a>
                        <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                            <?php echo $orgName; ?>
                            <div class="title text-truncate">
                                <?php echo $name; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>

</body>

<?php
include("partials/footer.php");
?>

</html>