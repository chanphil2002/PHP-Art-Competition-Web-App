<?php 
    include("partials/header.php"); 
    include("partials/database.php");
?>

<?php
if (isset($_GET['entryID']) & isset($_GET['compID'])) {
    $entryID = $_GET['entryID'];
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM entry WHERE entryID='$entryID'";
    $res = mysqli_query($conn, $sql);
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
    <!-- <img src="../materials/image/test1.jpg" alt="Responsive image" height="300" style="background-size:cover"> -->
    <ul class="nav nav-pills nav-fill p-2">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="compDetails.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewEntries.php?compID=<?php echo $compID; ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compRubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="conpAbout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>

    <div class="container pb-5">
        <a class="btn btn-outline-success rounded-end rounded-5 mb-4" href="viewEntries.php?compID=<?php echo $compID ?>" role="button">&laquo; Back to View All Entries </a>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <img class="card-img-left" src="../materials/image/<?php echo $entryFile ?>" class="img-fluid rounded-start" alt="..." style="height:auto; width:540px">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?php echo $title ?></h5>
                        <p class="card-text"><small class="text-muted">By <?php echo $userEmail ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include("partials/footer.php"); ?>