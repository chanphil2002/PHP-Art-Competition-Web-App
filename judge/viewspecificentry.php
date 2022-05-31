<?php include("../judge/partials/header.php"); ?>

<?php
if (isset($_GET['entryID']) & isset($_GET['compID'])) {
    $entryID = $_GET['entryID'];
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM entry WHERE entryID='$entryID'";
    $res = mysqli_query($conn, $sql);
    $sql1 = "SELECT * FROM comp_criteria WHERE compID='$compID'";
    $res1 = mysqli_query($conn, $sql1);
    $sql4 = "SELECT * from score_criteria WHERE compID='$compID' AND entryID='$entryID'";
    $res4 = mysqli_query($conn, $sql4);
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

// while ($row3 = mysqli_fetch_assoc($res4)) {
//     $cri0 = $row3['cri0'];
//     $cri1 = $row3['cri1'];
//     $cri2 = $row3['cri2'];
//     $cri3 = $row3['cri3'];
//     $cri4 = $row3['cri4'];
// }


if (isset($_POST['submit'])) {
    $count = mysqli_num_rows($res1);
    $i = 0;
    $total = 0;
    $sql2 = "INSERT INTO score_criteria (compID, entryID) VALUES ('$compID', '$entryID')";
    $res2 = mysqli_query($conn, $sql2);
    while ($count > 0) {
        // echo "<script>alert('crit.$i');</script>";
        $crit = $_POST["crit$i"];
        $sql5 = "UPDATE score_criteria SET cri$i = '$crit'";
        $res5 = mysqli_query($conn, $sql5);
        $total = $total + $crit;
        $i++;
        $count--;
    }
    while ($row3 = mysqli_fetch_assoc($res4)) {
        $cri0 = $row3['cri0'];
        $cri1 = $row3['cri1'];
        $cri2 = $row3['cri2'];
        $cri3 = $row3['cri3'];
        $cri4 = $row3['cri4'];
    }
    $count = mysqli_num_rows($res1);
    $avg = $total / $count;
    $sql3 = "UPDATE entry SET score = $avg WHERE compID = '$compID'";
    $res3 = mysqli_query($conn, $sql3);
    header("location:../judge/viewspecificentry.php?entryID=$entryID&compID=$compID");
}

// while ($row1 = mysqli_fetch_assoc($res1)) {
//     $criteria = $row1['criteria'];
// }


// if (isset($_GET['entryID']) & isset($_GET['compID'])) {
//     $entryID = $_GET['entryID'];
//     $compID = $_GET['compID'];
//     $sql2 = "SELECT * FROM comp_criteria WHERE compID='$compID'";
//     $res = mysqli_query($conn, $sql2);
// }
// if (isset($_POST['submit'])) {
//     $crit1 = $_POST['crit1'];
//     $crit2 = $_POST['crit2'];
//     $crit3 = $_POST['crit3'];
//     $crit4 = $_POST['crit4'];
//     $crit5 = $_POST['crit5'];
//     $total = ($crit1 + $crit2 + $crit3 + $crit4 + $crit5) / 5;
// }
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
    <img src="../materials/image/test1.jpg" alt="Responsive image" height="300" style="background-size:cover">
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
            <a class="nav-link" href="viewcompabout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>

    <div class="container pb-5">
        <a class="btn btn-outline-success rounded-end rounded-5 mb-4" href="new-entry.php?compID=<?php echo $compID ?>" role="button">&laquo; Back to View All Entries </a>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <img class="card-img-left" src="../materials/image/<?php echo $entryFile ?>" class="img-fluid rounded-start" alt="...">
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
                                    while ($row2 = mysqli_fetch_assoc($res1)) {
                                        $criteria = $row2['criteria'];
                                    ?>

                                        <div class="mb-3">
                                            <form action=" " method="POST" class="d-flex">
                                                <label for="crit"><?php echo $criteria; ?> Score</label>
                                                <input type="text" name="crit<?php echo $i; ?>" class="form-control" id="crit.<?php echo $i; ?>" value='<?php while ($row3 = mysqli_fetch_assoc($res4)) {
                                                                                                                                                            echo $row3["cri$i"];
                                                                                                                                                        } ?>' required <?php $i++; ?>>
                                        </div>
                                    <?php }
                                    ?>

                                    <div class="mb-3">
                                        <label for="total">Total Score</label>
                                        <input type="text" name="total" class="form-control" id="total" value="<?php echo $score ?>" readonly>
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