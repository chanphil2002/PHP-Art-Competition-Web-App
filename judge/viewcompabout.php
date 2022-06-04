<?php include("../judge/partials/header.php");
session_start();
if (!isset($_SESSION["judge"])) {
    header("Location: ../general/judgeLogin.php");
} ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT C.compID, C.compPic, O.organizerID, O.organizerName, O.organizerDesc,
            O.organizerProfilePic 
            FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID and compID=$compID";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $compID = $row['compID'];
        $organizerID = $row['organizerID'];
        $organizerName = $row['organizerName'];
        $organizerDesc = $row['organizerDesc'];
        $organizerProfilePic = $row['organizerProfilePic'];
    }
    $sql2 = "SELECT compPic FROM competition WHERE compID='$compID'";
    $res2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $compPic = $row2['compPic'];
    }
} else {
    echo "mistake";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../organizer/organizer.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
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
            <a class="nav-link active" href="viewcompabout.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
    </ul>


    <div class="container pt-4 pb-5">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="card-img-left" src="../materials/orgProfilePic/<?php echo $organizerProfilePic; ?>" alt="..." class="img-fluid rounded-start" style="object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title" style="color:black"><?php echo $organizerName; ?></h2>
                        <h3 class="card-text" style="font-size: 1.2em;"><?php echo $organizerDesc; ?></h3>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include("../judge/partials/footer.php"); ?>