<?php
include("partials/header.php");
include("partials/database.php");
?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT competition.compID, organizer.organizerID, organizer.organizerName, organizer.organizerDesc,
            organizer.organizerProfilePic 
            FROM competition INNER JOIN organizer ON competition.compID = organizer.organizerID and compID='$compID'";
    $res = mysqli_query($conn, $sql);
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
    <link href="organizer.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img class="img" src="../materials/image/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="compDetails.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewEntries.php?compID=<?php echo $compID; ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compRubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="compAbout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>

    <br>

</body>

</html>

<?php include("partials/footer.php"); ?>