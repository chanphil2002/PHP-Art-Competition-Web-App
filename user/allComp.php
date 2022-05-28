<?php
    include ("partials/database.php");
    include ("partials/header.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ../general/registeredUserLogin.php");
    }

    if (isset($_GET["category"])){
        $category = $_GET["category"];
        $sql = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE category = '$category'";
        $res = mysqli_query($conn, $sql);
    }else{
        $sql = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID";
        $res = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Competition</title>

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/72d9213ec5.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../judge/judge.css">

    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>

<body>

    <?php
        if (isset($_GET["category"])){
            if ($_GET["category"] == "2D"){
    ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:20px">
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php"><button class="nav-link" id="all-tab" data-bs-toggle="tab" type="button" role="tab">All Competitions</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=2D"><button class="nav-link active" id="2D-tab" data-bs-toggle="tab" type="button" role="tab">2D Digital Arts</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=3D"><button class="nav-link" id="3D-tab" data-bs-toggle="tab" type="button" role="tab">3D Digital Arts</button></s>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Paintings"><button class="nav-link" id="Paintings-tab" data-bs-toggle="tab" type="button" role="tab">Paintings</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Photography"><button class="nav-link" id="Photography-tab" data-bs-toggle="tab" type="button" role="tab">Photography</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href=""><button class="nav-link" id="participated-tab" data-bs-toggle="tab" type="button" role="tab">Participated</button></a>
                    </li>
                </ul>
        <?php }elseif ($_GET["category"] == "3D"){ ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:20px">
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php"><button class="nav-link" id="all-tab" data-bs-toggle="tab" type="button" role="tab">All Competitions</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=2D"><button class="nav-link" id="2D-tab" data-bs-toggle="tab" type="button" role="tab">2D Digital Arts</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=3D"><button class="nav-link active" id="3D-tab" data-bs-toggle="tab" type="button" role="tab">3D Digital Arts</button></s>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Paintings"><button class="nav-link" id="Paintings-tab" data-bs-toggle="tab" type="button" role="tab">Paintings</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Photography"><button class="nav-link" id="Photography-tab" data-bs-toggle="tab" type="button" role="tab">Photography</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href=""><button class="nav-link" id="participated-tab" data-bs-toggle="tab" type="button" role="tab">Participated</button></a>
                    </li>
                </ul>
        <?php }elseif ($_GET["category"] == "Paintings"){ ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:20px">
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php"><button class="nav-link" id="all-tab" data-bs-toggle="tab" type="button" role="tab">All Competitions</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=2D"><button class="nav-link" id="2D-tab" data-bs-toggle="tab" type="button" role="tab">2D Digital Arts</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=3D"><button class="nav-link" id="3D-tab" data-bs-toggle="tab" type="button" role="tab">3D Digital Arts</button></s>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Paintings"><button class="nav-link active" id="Paintings-tab" data-bs-toggle="tab" type="button" role="tab">Paintings</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Photography"><button class="nav-link" id="Photography-tab" data-bs-toggle="tab" type="button" role="tab">Photography</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href=""><button class="nav-link" id="participated-tab" data-bs-toggle="tab" type="button" role="tab">Participated</button></a>
                    </li>
                </ul>
        <?php }elseif ($_GET["category"] == "Photography"){ ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:20px">
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php"><button class="nav-link" id="all-tab" data-bs-toggle="tab" type="button" role="tab">All Competitions</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=2D"><button class="nav-link" id="2D-tab" data-bs-toggle="tab" type="button" role="tab">2D Digital Arts</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=3D"><button class="nav-link" id="3D-tab" data-bs-toggle="tab" type="button" role="tab">3D Digital Arts</button></s>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Paintings"><button class="nav-link" id="Paintings-tab" data-bs-toggle="tab" type="button" role="tab">Paintings</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Photography"><button class="nav-link active" id="Photography-tab" data-bs-toggle="tab" type="button" role="tab">Photography</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href=""><button class="nav-link" id="participated-tab" data-bs-toggle="tab" type="button" role="tab">Participated</button></a>
                    </li>
                </ul>
        <?php }}else{ ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:20px">
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php"><button class="nav-link active" id="all-tab" data-bs-toggle="tab" type="button" role="tab">All Competitions</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=2D"><button class="nav-link" id="2D-tab" data-bs-toggle="tab" type="button" role="tab">2D Digital Arts</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=3D"><button class="nav-link" id="3D-tab" data-bs-toggle="tab" type="button" role="tab">3D Digital Arts</button></s>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Paintings"><button class="nav-link" id="Paintings-tab" data-bs-toggle="tab" type="button" role="tab">Paintings</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="allComp.php?category=Photography"><button class="nav-link" id="Photography-tab" data-bs-toggle="tab" type="button" role="tab">Photography</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href=""><button class="nav-link" id="participated-tab" data-bs-toggle="tab" type="button" role="tab">Participated Competitions</button></a>
                    </li>
                </ul>
    <?php } ?>

    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
                while ($compDetails = mysqli_fetch_assoc($res)){
                    $pic = $compDetails["compPic"];
                    $name = $compDetails["compName"];
                    $org = $compDetails["organizerName"];
                    $status = $compDetails["status"];
                    $category = $compDetails["category"];
            ?>

            <div class="col-md-4 margincon1">
                <div class="card border-1 grid-list">
                    <a href="" class="stretched-link">
                        <?php if ($status == "Upcoming"){ ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                        <?php } elseif ($status == "Past"){ ?>
                            <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                        <?php } ?>
                        <img class="card-img-top lazy" src="../materials/image/<?php echo $pic; ?>">
                    </a>
                    <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                        <?php echo $org; ?>
                        <?php
                            if (!isset($_GET["category"])){
                                echo " / ";
                                echo $category;
                            }
                        ?>
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
<?php include ("partials/footer.php"); ?>
</html>