<?php
include("partials/header.php");
include("partials/database.php");

session_start();
if (!isset($_SESSION["user"])){
    header("Location: ../general/registeredUserLogin.php");
}
?>

<?php
if (isset($_GET['entryID']) & isset($_GET['compID'])) {
    $entryID = $_GET['entryID'];
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM entry E INNER JOIN user U ON E.userEmail = U.userEmail WHERE entryID='$entryID'";
    $res = mysqli_query($conn, $sql);
} else {
    header("Location: homepage.php");
}
while ($row = mysqli_fetch_assoc($res)) {
    $entryID = $row['entryID'];
    $entryFile = $row['entryFile'];
    $title = $row['title'];
    $userEmail = $row['userEmail'];
    $username = $row['username'];
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
    <!-- <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;"> -->
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
                    <img class="card-img-left" src="../materials/entries/<?php echo $entryFile ?>" class="img-fluid rounded-start" alt="..." style="height:auto; width:540px">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?php echo $title ?></h5>
                        <p class="card-text"><small class="text-muted">By 
                            <?php if ($userEmail == $_SESSION["user"]){ ?>
                                    <a href="myComp.php">
                            <?php } else{ 
                                    $get = "SELECT * FROM user WHERE userEmail = '$userEmail' ";
                                    $run = mysqli_query($conn, $get);
                                    while ($view = mysqli_fetch_assoc($run)){
                                        $viewUsername = $view["username"];
                                    } ?>
                                    <a href="userComp.php?username=<?php echo $viewUsername; ?>">
                            <?php }
                                echo $username; 
                            ?>
                        </a></small></p>
                        <br>

                        <?php
                        $sql3 = "SELECT * FROM competition WHERE compID = '$compID' ";
                        $res3 = mysqli_query($conn, $sql3);
                        while ($compDetails = mysqli_fetch_assoc($res3)) {
                            $status = $compDetails["status"];
                        }
                        if ($status == "On-Going") {

                            $sql2 = "SELECT * FROM votehistory WHERE userEmail = '$_SESSION[user]' AND entryID = '$entryID' ";
                            $res2 = mysqli_query($conn, $sql2);

                            if (mysqli_num_rows($res2) == 0) {
                        ?>
                                <a href="vote.php?entryID=<?php echo $entryID; ?>&compID=<?php echo $compID; ?>" style="text-decoration: none">
                                    <h3>&#128147; Vote for It </h3>
                                </a>

                            <?php   } else { ?>
                                <h3>&#128147; Voted </h3>
                        <?php }
                        }elseif ($status == "Past") {
                            if ($userEmail == $_SESSION["user"]){ ?>
                                Get My E-certificate <a href="ecert.php?compID=<?php echo $compID; ?>">Here</a>
                        <?php }
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include("partials/footer.php"); ?>