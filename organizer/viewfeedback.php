<?php include("../organizer/partials/header.php"); ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT comp_judge.compID, comp_judge.judgeIC, judge.judgeName, judge.judgeBio, judge.judgeProfilePic 
            FROM comp_judge INNER JOIN Judge ON comp_judge.judgeIC = judge.judgeIC and compID='$compID'";
    $res = mysqli_query($conn, $sql);
} else {
    header("Location: ../organizer/orghome.php");
}
?>
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
            <a class="nav-link" aria-current="page" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewentries.php.php?entryID=1&<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewcomp_rubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>

    <div class="container">
        <div class=" row">
            <div>
                <h2 style="display: inline-block">Meet the Judges</h2>
            </div>

            <div class="container my-5 d-flex justify-content-center">

                <?php while ($row = mysqli_fetch_assoc($res)) :
                    $compID = $row['compID'];
                    $judgeName = $row['judgeName'];
                    $judgeBio = $row['judgeBio'];
                    $judgeProfilePic = $row['judgeProfilePic'];
                ?>

                    <div class="card p-3 me-5 col-md-6">

                        <div class="d-flex align-items-center">

                            <div class="image">
                                <img src="../materials/judgeProfilePic/<?php echo $judgeProfilePic; ?>" class="rounded" width="155">
                            </div>

                            <div class="ms-3 w-100">

                                <h3 class="mb-0 mt-0"><?php echo $judgeName; ?></h3>

                                <div class="p-2 mt-2 bg-secondary bg-info bg-opacity-25 d-flex justify-content-between rounded text-white stats">

                                    <div class="d-flex flex-column text-dark">
                                        <span class="articles">Bio: </span>
                                        <span class="number1"><?php echo $judgeBio; ?></span>

                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>

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