<?php include("../judge/partials/header.php"); ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT competition.compID, competition.compPic, organizer.organizerID, organizer.organizerName, organizer.organizerDesc,
            organizer.organizerProfilePic 
            FROM competition INNER JOIN organizer ON competition.compID = organizer.organizerID and compID='$compID'";
    $res = mysqli_query($conn, $sql);
    $sql2 = "SELECT compPic FROM competition WHERE compID='$compID'";
    $res2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $compPic = $row2['compPic'];
    }
} else {
    echo "mistake";
}

while ($row = mysqli_fetch_assoc($res)) {
    $compID = $row['compID'];
    $organizerID = $row['organizerID'];
    $organizerName = $row['organizerName'];
    $organizerDesc = $row['organizerDesc'];
    $organizerProfilePic = $row['organizerProfilePic'];
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
    <img src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" style="background-size:cover">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="viewcompmain.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="new-entry.php?compID=<?php echo $compID; ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomprubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewcompabout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>



</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>