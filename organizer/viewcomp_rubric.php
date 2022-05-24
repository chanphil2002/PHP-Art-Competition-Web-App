<?php include("../organizer/partials/header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="organizer.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img src="../materials/image/test1.jpg" alt="Responsive image" height="300" style="background-size:cover">
    <ul class="nav nav-pills nav-fill p-2">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="viewcomp_main.php">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewcomp_rubric.php">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php">About</a>
        </li>
    </ul>

    <div class="container">
        <div class=" row">
            <div>
                <h2 style="display: inline-block">Meet the Judges</h2>
            </div>
            <div class="row justify-content-center mb-2">
                <?php
                $query = "SELECT * FROM `tbl_service`";
                $result = mysqli_query($conn, $query);
                $check_faculty = mysqli_num_rows($result) > 0;

                if ($check_faculty) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <div class="col-lg-3 col-md-3 d-flex align-items-stretch">
                            <div class="service">
                                <div class="service-img">
                                    <?php if ($row['image'] != NULL) {
                                    ?>
                                        <img src="../img_upload/service_type/<?php echo $row["image"]; ?>" class="img-fluid" alt="No image">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../image/default.jpg" class="img-fluid" alt="No image">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="service-info">
                                    <h4><?php echo $row['service_type']; ?></h4>
                                    <span><?php echo $row['description']; ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img src="../materials/image/image-20150729-30889-ri221u.avif" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
        <h1>Scoring Criteria</h1>
        <h1>Performance</h1>
        <h1>Creativity</h1>
        <h1>Skills and Techniques</h1>
    </div>

</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>