<?php
    include ("partials/database.php");
    include ("partials/header.php");

    session_start();
    if (!isset($_SESSION["user"])){
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
</head>

<body>
  <!-- Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

        <!-- Indicator -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
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

            <div class="carousel-item active" data-bs-interval="10000">
                <a href="">
                <center><img src="../materials/image/<?php echo $pic?>" style="width:auto;height:360px;" class="" alt="..."></center>
                </a>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <div>
                        <h5 style="color:black;display: inline-block"><?php echo $name?> &nbsp;</h5>
                        <span class="badge rounded-pill position-absolute bg-danger" style="height:20px">Popular</span>
                    </div>
                    <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                </div>
            </div>

            <?php
                // Upcoming Competition
                $sql2 = "SELECT * FROM competition WHERE status='Upcoming' ORDER BY releaseDate ASC LIMIT 1";
                $res2 = mysqli_query($conn, $sql2);
                $compDetails = mysqli_fetch_assoc($res2);
                $name = $compDetails["compName"];
                $pic = $compDetails["compPic"];
            ?>

            <div class="carousel-item" data-bs-interval="2000">
                <a href="">
                <center><img src="../materials/image/<?php echo $pic?>" style="width:auto;height:360px;" class="" alt="..."></center>
                </a>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <div>
                        <h5 style="color:black;display: inline-block"><?php echo $name?> &nbsp;</h5>
                        <span class="badge rounded-pill position-absolute bg-primary" style="height:20px">Upcoming</span>
                    </div>
                    <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                </div>
            </div>

            <?php
                // New Competition
                $sql3 = "SELECT * FROM competition WHERE status='On-Going' ORDER BY releaseDate DESC LIMIT 2";
                $res3 = mysqli_query($conn, $sql3);
                $compDetails = mysqli_fetch_assoc($res3);
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
                        <h5 style="color:black;display: inline-block"><?php echo $name?> &nbsp;</h5>
                        <span class="badge rounded-pill position-absolute bg-success" style="height:20px">New</span>
                    </div>
                    <a class="align btn btn-outline-primary" href="" role="button">View Details</a>
                </div>
            </div>

        </div>

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
    <h2 class="ml-5" >Most Popular Competition</h2>

</body>

<?php
    include ("partials/footer.php");
?>

</html>