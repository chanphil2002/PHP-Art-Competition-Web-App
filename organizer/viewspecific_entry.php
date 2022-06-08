<?php include("../organizer/partials/header.php"); ?>

<?php

if (isset($_GET['entryID']) & isset($_GET['compID'])) {
    $entryID = $_GET['entryID'];
    $compID = $_GET['compID'];
    $sql = "SELECT C.*, E.* FROM competition C INNER JOIN entry E ON C.compID = E.compID AND entryID='$entryID'";
    $res = mysqli_query($conn, $sql);
    $sql20 = "SELECT score_criteria.*, judge.judgeName FROM score_criteria INNER JOIN judge ON score_criteria.judgeIC = judge.judgeIC WHERE compID='$compID' AND entryID='$entryID'";
    $res20 = mysqli_query($conn, $sql20);
} else {
    header("Location: ../organizer/orghome.php");
}
while ($row = mysqli_fetch_assoc($res)) {
    $entryID = $row['entryID'];
    $entryFile = $row['entryFile'];
    $title = $row['title'];
    $userEmail = $row['userEmail'];
    $vote = $row['vote'];
    $score = $row['score'];
    $totalScore = $row['totalScore'];
    $compPic = $row['compPic'];
}

$count20 = mysqli_num_rows($res20);
// if ($count20 > 0) {
//     while ($row20 = mysqli_fetch_assoc($res20)) {
//         $cri_tscore = $row20['cri_tscore'];
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="organizer.css" rel="stylesheet">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewentries.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_rubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewfeedback.php?compID=<?php echo $compID; ?>">View Feedback</a>
        </li>
    </ul>

    <div class="container pb-5">
        <a class="btn btn-outline-success rounded-end rounded-5 mb-4" href="viewentries.php?compID=<?php echo $compID ?>" role="button">&laquo; Back to View All Entries </a>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <img class="card-img-left" src="../materials/entries/<?php echo $entryFile ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?php echo $title ?></h5>
                        <p class="card-text"><small class="text-muted">By <?php echo $userEmail ?></small></p>
                    </div>

                    <div class="card-body">
                        <?php if ($count20 > 0) {
                            while ($row20 = mysqli_fetch_assoc($res20)) {
                                $cri_tscore = $row20['cri_tscore'];
                                $judgeName = $row20['judgeName'];
                        ?>
                                <div class="mb-3">
                                    <label for="total">Total Score From Judge <?php echo $judgeName ?></label>
                                    <input type="text" name="total" class="form-control" id="total" value="<?php echo $cri_tscore; ?>" readonly>
                                </div>
                        <?php }
                        } ?>
                    </div>

                </div>

            </div>
        </div>
    </div>


</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>