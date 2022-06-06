<?php include("../judge/partials/header.php");
session_start();
if (!isset($_SESSION["judge"])) {
    header("Location: ../general/judgeLogin.php");
}
?>

<?php
if (isset($_GET['entryID']) & isset($_GET['compID']) & isset($_SESSION['judge'])) {
    $entryID = $_GET['entryID'];
    $compID = $_GET['compID'];
    $judgeIC = $_SESSION['judge'];
    $sql = "SELECT * FROM entry WHERE entryID='$entryID'";
    $res = mysqli_query($conn, $sql);
    $sql1 = "SELECT * FROM comp_criteria INNER JOIN score_criteria ON comp_criteria.compID = score_criteria.compID WHERE score_criteria.entryID = '$entryID' AND comp_criteria.compID = '$compID' AND judgeIC = '$judgeIC'";
    $res1 = mysqli_query($conn, $sql1);
    $sql20 = "SELECT * FROM score_criteria WHERE compID='$compID' AND entryID='$entryID' AND judgeIC = '$judgeIC'";
    $res20 = mysqli_query($conn, $sql20);
    $sql500 = "SELECT * FROM comp_criteria WHERE compID='$compID'";
    $res500 = mysqli_query($conn, $sql500);
    $sql5 = "SELECT compPic FROM competition WHERE compID='$compID'";
    $res5 = mysqli_query($conn, $sql5);
    while ($row8 = mysqli_fetch_assoc($res5)) {
        $compPic = $row8['compPic'];
    }
} else {
    echo "mistake";
}
while ($row = mysqli_fetch_assoc($res)) {
    $entryID = $row['entryID'];
    $entryFile = $row['entryFile'];
    $title = $row['title'];
    $userEmail = $row['userEmail'];
    $vote = $row['vote'];
    $score = $row['score'];
    $totalScore = $row['totalScore'];
}

$count20 = mysqli_num_rows($res20);
if ($count20 > 0) {
    while ($row20 = mysqli_fetch_assoc($res20)) {
        $cri_tscore = $row20['cri_tscore'];
    }
} else {
    $cri_tscore = NULL;
}


if (isset($_POST['submit'])) {
    $count = mysqli_num_rows($res500);
    $i = 0;
    $total = 0;
    $sql2 = "INSERT INTO score_criteria (compID, entryID, judgeIC) VALUES ('$compID', '$entryID','$judgeIC')";
    $res2 = mysqli_query($conn, $sql2);

    while ($count > 0) {
        // echo "<script>alert('crit.$i');</script>";
        $crit = $_POST["crit$i"];
        // if (is_numeric($crit) == FALSE) {
        //     echo "<script>alert('Only integers allowed')</script>";
        //     break;
        // }
        $sql5 = "UPDATE score_criteria SET cri$i = '$crit' WHERE compID = '$compID' and entryID='$entryID' and judgeIC = '$judgeIC'";
        $res5 = mysqli_query($conn, $sql5);
        $total = $total + $crit;
        $i++;
        $count--;
    }
    while ($row3 = mysqli_fetch_assoc($res20)) {
        $cri0 = $row3['cri0'];
        $cri1 = $row3['cri1'];
        $cri2 = $row3['cri2'];
        $cri3 = $row3['cri3'];
        $cri4 = $row3['cri4'];
    }
    $count = mysqli_num_rows($res500);

    $avg = $total / $count;
    $sql3 = "UPDATE score_criteria SET cri_tscore = $avg WHERE compID = '$compID' AND entryID = '$entryID' and judgeIC = '$judgeIC'";
    $res3 = mysqli_query($conn, $sql3);
    $sql520 = "SELECT AVG(cri_tscore) AS cri_tscore FROM score_criteria WHERE compID = '$compID' and entryID = '$entryID'";
    $res520 = mysqli_query($conn, $sql520);
    while ($row520 = mysqli_fetch_assoc($res520)) {
        $entryscore = $row520['cri_tscore'];
    }
    $sql521 = "UPDATE entry SET score = $entryscore WHERE compID='$compID' AND entryID = '$entryID'";
    $res521 = mysqli_query($conn, $sql521);
    header("location:../judge/viewspecificentry.php?entryID=$entryID&compID=$compID");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../organizer/organizer.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="viewcompmain.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="new-entry.php?compID=<?php echo $compID; ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomprubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcompabout.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
    </ul>

    <div class="container pb-5">
        <a class="btn btn-outline-success rounded-end rounded-5 mb-4" href="new-entry.php?compID=<?php echo $compID ?>" role="button">&laquo; Back to View All Entries </a>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <img class="card-img-left" src="../materials/entries/<?php echo $entryFile; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?php echo $title ?></h5>
                        <p class="card-text"><small class="text-muted">By <?php echo $userEmail ?></small></p>
                        --------------------------------------------------------------
                        <h3 class="card-text">Scoring Form</small></h2>


                            <form action="" method="POST" class="d-flex">
                                <div class="col-md-4 order-md-2 mb-4">
                                    <?php
                                    $i = 0;
                                    $count1 = mysqli_num_rows($res1);
                                    if ($count1 == 0) {
                                        $sql1 = "SELECT * FROM comp_criteria WHERE compID = '$compID'";
                                        $res1 = mysqli_query($conn, $sql1);
                                        while ($row2 = mysqli_fetch_assoc($res1)) {
                                            $criteria = $row2['criteria']; ?>
                                            <div class="mb-3">
                                                <form action=" " method="POST" class="d-flex">
                                                    <label for="crit"><?php echo $criteria; ?> Score</label>
                                                    <input type="text" name="crit<?php echo $i; ?>" class="form-control" id="crit.<?php echo $i; ?>" value='' required <?php $i++; ?>>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        while ($row2 = mysqli_fetch_assoc($res1)) {
                                            $criteria = $row2['criteria'];
                                            $crit = $row2["cri$i"];
                                        ?>

                                            <div class="mb-3">
                                                <form action=" " method="POST" class="d-flex">
                                                    <label for="crit"><?php echo $criteria; ?> Score</label>
                                                    <input type="text" name="crit<?php echo $i; ?>" class="form-control" id="crit.<?php echo $i; ?>" value='<?php echo $crit;
                                                                                                                                                            ?>' required <?php $i++; ?>>
                                            </div>
                                    <?php }
                                    }
                                    ?>

                                    <div class="mb-3">
                                        <label for="total">Total Score</label>
                                        <input type="text" name="total" class="form-control" id="total" value="<?php echo $cri_tscore; ?>" readonly>
                                    </div>

                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Save</button>
                                </div>


                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>