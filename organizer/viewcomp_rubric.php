<?php include("../organizer/partials/header.php"); ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT CJ.compID, CJ.judgeIC, J.judgeName, J.judgeBio, J.judgeProfilePic 
            FROM comp_judge CJ INNER JOIN Judge J ON CJ.judgeIC = J.judgeIC AND compID='$compID'";
    $sql2 = "SELECT * from comp_criteria WHERE compID = '$compID'";
    $sql3 = "SELECT * from competition WHERE compID = '$compID'";
    $res = mysqli_query($conn, $sql);
    $res2 = mysqli_query($conn, $sql2);
    $res3 = mysqli_query($conn, $sql3);
} else {
    echo "mistake";
}
while ($row = mysqli_fetch_assoc($res3)) {
    $compID = $row['compID'];
    $compPic = $row['compPic'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="organizer.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewentries.php?compID=<?php echo $compID; ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewcomp_rubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewfeedback.php?compID=<?php echo $compID; ?>">View Feedback</a>
        </li>
    </ul>

    <div class="container">
        <div style="margin-bottom: 3em;">
            <h2>Criterias:</h2>
            <?php
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $criteria = $row2['criteria'];
                    $description = $row2['description'];
            ?>

                    <h3><strong><?php echo $criteria ?></strong> - <?php echo $description ?></h3>
            <?php }
            } else {
                echo "<h2 class='text-danger'>No Result Found!</h2>";
            } ?>
        </div>
        <div class=" row mb-5 pb-5">
            <div>
                <h2 style="display: inline-block">Meet the Judges</h2>
            </div>
            <?php
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $compID = $row['compID'];
                    $judgeName = $row['judgeName'];
                    $judgeBio = $row['judgeBio'];
                    $judgeProfilePic = $row['judgeProfilePic'];
            ?>

                    <div class="col-md-6">
                        <div class="card mb-4 shadow-sm p-3">
                            <div class="d-flex align-items-center">
                                <div class="image">
                                    <img src="../materials/judgeProfilePic/<?php echo $judgeProfilePic; ?>" class="rounded" height="200" width="150" style="object-fit: cover;">
                                </div>
                                <div class="ms-3 w-100">
                                    <h3 class="mb-0 mt-0"><?php echo $judgeName; ?></h3>
                                    <div class="p-2 mt-2 bg-secondary bg-info bg-opacity-25 d-flex justify-content-between rounded text-white stats">
                                        <div class="d-flex flex-column text-dark">
                                            <span class="number1 text-secondary"><?php echo $judgeBio; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "<h2 class='text-danger'>No Result Found!</h2>";
            } ?>

        </div>
    </div>
</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>