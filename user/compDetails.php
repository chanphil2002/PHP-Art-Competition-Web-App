<?php 
    include("partials/header.php"); 
    include("partials/database.php");
?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT C.*, O.organizerName FROM competition C INNER JOIN organizer O ON C.compID=$compID";
    $res = mysqli_query($conn, $sql);
} else {
    echo "mistake";
}
while ($row = mysqli_fetch_assoc($res)) {
    $compID = $row['compID'];
    $compName = $row['compName'];
    $organizerID = $row['organizerID'];
    $organizerName = $row['organizerName'];
    $description = $row['description'];
    $rules = $row['rules'];
    $category = $row['category'];
    $status = $row['status'];
    $releaseDate = $row['releaseDate'];
    $registrationDeadline = $row['registrationDeadline'];
    $evaluationDays = $row['evaluationDays'];
    $judgeScore = $row['judgeScore'];
    $publicVote = $row['publicVote'];
    $prizePool = $row['prizePool'];
    $compPic = $row['compPic'];
    $status = $row['status'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="organizer.css" rel="stylesheet"> -->
    <title>Document</title>
</head>

<body>

<!-- <img src="../materials/image/" alt="Responsive image" height="300" style="background-size:cover"> -->
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewEntries.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compRubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compAbout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>

    <br>

    <div class="container pb-5">
        <div class="row">
            <div class="col-9">
                <div>
                    <h2 class="mr-2" style="display: inline-block"><?php echo $compName ?></h2>
                    <span class="ml-2 badge text-bg-success align-top even-larger-badge"><?php echo $status; ?></span>
                </div>
                <h3 class="text-muted"><small class="text-muted">By <?php echo $organizerName ?></small>, <?php echo $category ?> Category</h3>

                <div class=" row">
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Competition Date</h3>
                                <h2><?php echo $releaseDate; ?> - <?php echo $registrationDeadline; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Scoring Format</h3>
                                <h2><u><?php echo $publicVote; ?> </u> Public Vote</h2>
                                <h2><u><?php echo $judgeScore; ?></u> Judge</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Total Prize Pool</h3>
                                <h2><?php echo 'RM '. $prizePool; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>
                        Description
                    </h2>
                    <h3>
                        <?php echo $description; ?>
                    </h3>
                </div>
                <div>
                    <h2>
                        Rules and Regulation
                    </h2>
                    <h3>
                        <?php echo $rules; ?>
                    </h3>
                </div>
            </div>
            <div class="col-3">
                <a href="joinComp.php?competition=<?php echo $compID; ?>" style="text-decoration: none"><h3>&#128101; Join</h3></a>
                <!-- <h3>&#128147; Bookmark</h3> -->
                <?php
                    if ($status == 'Past'){
                ?>
                        <hr>
                        <h2><u>Winner</u></h2>
                        <img src="../materials/image/download.jpg" alt="">
                <?php } ?>                
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/8deb7b58d3.js" crossorigin="anonymous"></script>
</body>

</html>

<?php include("partials/footer.php"); ?>