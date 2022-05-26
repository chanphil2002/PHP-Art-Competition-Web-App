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
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <!-- Contents -->
        <?php
            // Latest Competition
            $sql1 = "SELECT * FROM competition WHERE status='On-Going' ORDER BY releaseDate DESC LIMIT 1";
            $res1 = mysqli_query($conn, $sql1);
            $compDetails = mysqli_fetch_assoc($res1);
            $name = $compDetails["compName"];
            
        ?>

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <center><img src="../materials/image/001.png" style="width:auto;height:360px;" class="" alt="..."></center>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#08007f">First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="2000">
                <center><img src="../materials/image/002.png" style="width:auto;height:360px;" class="" alt="..."></center>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#08007f">Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>

            <div class="carousel-item">
                <center><img src="../materials/image/003.png" style="width:auto;height:360px;" class="" alt="..."></center>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#08007f">Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>

            <div class="carousel-item">
                <center><img src="../materials/image/004.png" style="width:auto;height:360px;" class="" alt="..."></center>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#08007f">Forth slide label</h5>
                    <p>Some representative placeholder content for the forth slide.</p>
                </div>
            </div>

            <div class="carousel-item">
                <center><img src="../materials/image/005.png" style="width:auto;height:360px;" class="" alt="..."></center>
                <br><br><br><br><br><br>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#08007f">Fifth slide label</h5>
                    <p>Some representative placeholder content for the fifth slide.</p>
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


</body>

<?php
    include ("partials/footer.php");
?>

</html>