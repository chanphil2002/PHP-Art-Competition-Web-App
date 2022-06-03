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
            <a class="nav-link" href="viewentries.php.php?entryID=1&<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_rubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewfeedback.php?compID=<?php echo $compID; ?>">View Feedback</a>
        </li>
    </ul>


</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>