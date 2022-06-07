<?php
include("partials/header.php");
include("partials/database.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../general/registeredUserLogin.php");
}
?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE compID = '$compID' ";
    $sql1 = "SELECT COUNT(compID), SUM(vote) FROM entry WHERE compID=$compID";
    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    header("Location: homepage.php");
}
while ($row = mysqli_fetch_assoc($res)) {
    $compID = $row['compID'];
    $compName = $row['compName'];
    $organizerID = $row['organizerID'];
    $organizerName = $row['organizerName'];
    $description = $row['description'];
    $rules = $row['rules'];
    $category = $row['category'];
    $status = $row['status'];
    $releaseDate = $row['releaseDate'];
    $registrationDeadline = $row['registrationDeadline'];
    $evaluationDays = $row['evaluationDays'];
    $judgeScore = $row['judgeScore'];
    $publicVote = $row['publicVote'];
    $prizePool = $row['prizePool'];
    $compPic = $row['compPic'];
    $announcement = $row['announcement'];
    $rejectedComment = $row['rejectedComment'];
}
while ($row1 = mysqli_fetch_assoc($res1)) {
    $joinCount = $row1["COUNT(compID)"];
    $voteCount = $row1["SUM(vote)"];
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

    <img class="img" src="../materials/compPic/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="compDetails.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewEntries.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compRubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compAbout.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
    </ul>

    <div class="container pb-5">
        <div class="row">
            <div class="col-9">
                <div>
                    <h2 style="display: inline-block" style="margin-right: 2em;"><?php echo $compName ?></h2>
                    <?php
                    if ($status == 'Pending') {
                        echo "<span style='margin-left: 1em' class='badge rounded-pill bg-primary align-top end-0'> $status </span>";
                    } else if ($status == 'Upcoming') {
                        echo "<span style='margin-left: 1em' class='badge rounded-pill bg-warning align-top end-0'> $status </span>";
                    } else if ($status == 'On-Going') {
                        echo "<span style='margin-left: 1em' class='badge rounded-pill bg-success align-top end-0'>$status </span>";
                    } else if ($status == 'Past') {
                        echo "<span style='margin-left: 1em' class='badge rounded-pill bg-dark align-top end-0'> $status </span>";
                    } else if ($status == 'Terminated') {
                        echo "<span style='margin-left: 1em' class='badge rounded-pill bg-danger align-top end-0'> $status </span>";
                    }
                    ?>
                </div>
                <h3 class="text-muted mb-4"><small class="text-muted">By <?php echo $organizerName ?>, <?php echo $category ?> Category</small></h3>
                <h6 class="text-muted mb-4"><?php echo $joinCount; ?> People Participated<?php if ($voteCount != 0) {
                                                                                                echo ", " . $voteCount;  ?> Votes Collected <?php } ?></h6>

                <div class="row mb-5">
                    <div class="col-sm-4">
                        <div class="card text-bg-light border-dark" style="max-width: 20rem; height: 14rem;">
                            <div class="card-header text-bg-dark" style="font-size: 1.5em;">Competition Date</div>
                            <div class="card-body">
                                <h3 class="card-text" style="font-weight: bold;"><?php echo $releaseDate; ?></h3>
                                <h3 class="card-text">until</h3>
                                <h3 class="card-text" style="font-weight: bold;"><?php echo $registrationDeadline; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-bg-light border-dark" style="max-width: 20rem; height: 14rem;">
                            <div class="card-header text-bg-dark" style="font-size: 1.5em;">Scoring Format</div>
                            <div class="card-body">
                                <h3 class="card-text"><u style="font-weight: bold;"><?php echo $publicVote; ?></u>% Public Vote</h3>
                                <h3 class="card-text"><u style="font-weight: bold;"><?php echo $judgeScore; ?></u>% Judge</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-bg-light border-dark" style="max-width: 20rem; height: 14rem;">
                            <div class="card-header text-bg-dark" style="font-size: 1.5em;">Total Prize Pool</div>
                            <div class="card-body">
                                <h3 class="card-text"><?php echo "RM " . $prizePool; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-4">
                    <h2>
                        Description
                    </h2>
                    <h3>
                        <?php echo $description; ?>
                    </h3>
                </div>
                <div class="pb-4">
                    <h2>
                        Rules and Regulation
                    </h2>
                    <h3>
                        <?php echo $rules; ?>
                    </h3>
                </div>

                <?php if ($announcement != NULL) { ?>
                    <button class="btn btn-primary btn-lg mx-auto px-5" data-bs-toggle="modal" data-bs-target="#viewModal">View Announcement</button>
                    <!-- View Announcement Modal -->

                    <div class="modal fade bd-example-modal-lg" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" style="color: black; font-weight: bold;" id="exampleModalLabel">New Announcement</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h3 style="white-space: pre-wrap;"><?php echo $announcement ?></h3>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="col-3">
                <?php
                $sql3 = "SELECT * FROM entry WHERE compID = '$compID' AND userEmail = '$_SESSION[user]' ";
                $res3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($res3) != 0) {
                    while ($entryDetails = mysqli_fetch_assoc($res3)) {
                        $myEntry = $entryDetails["entryID"];
                    }
                ?>
                    <a href="entry.php?entryID=<?php echo $myEntry; ?>&compID=<?php echo $compID; ?>" style="text-decoration: none">
                        <h3>&#128101; My Entry</h3>
                    </a>
                    <?php } else {
                    if ($status == "On-Going") {
                    ?>
                        <a href="joinComp.php?competition=<?php echo $compID; ?>" style="text-decoration: none">
                            <h3>&#128101; Join</h3>
                        </a>
                <?php }
                } ?>

                <a href="bookmark.php?compID=<?php echo $compID; ?>" style="text-decoration: none">
                    <h3>🔖 Bookmark</h3>
                </a>
                <a href="feedback.php?org&compID=<?php echo $compID; ?>" style="text-decoration: none">
                    <h3>📩 Feedback</h3>
                </a>

                <?php
                if ($status == 'Past') {
                ?>
                    <hr>
                    <h2><u>Winner</u></h2>
                    <?php
                    $sql2 = "SELECT entry_winner FROM competition WHERE compID = '$compID'";
                    $run2 = mysqli_query($conn, $sql2);
                    while ($win = mysqli_fetch_assoc($run2)) {
                        $entry_winner = $win["entry_winner"];
                    }
                    $sql3 = "SELECT * FROM entry WHERE entryID = '$entry_winner'";
                    $run3 = mysqli_query($conn, $sql3);
                    while ($win = mysqli_fetch_assoc($run3)) {
                        $entryID = $win["entryID"];
                        $entryFile = $win["entryFile"];
                        $title = $win["title"];
                    }
                    ?>
                    <a href="../user/entry.php?entryID=<?php echo $entryID; ?>&compID=<?php echo $compID; ?>"><img src="../materials/entries/<?php echo $entryFile; ?>" alt="<?php echo $title; ?>" style="width: 300px; height: auto"></a>
                <?php } ?>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/8deb7b58d3.js" crossorigin="anonymous"></script>
</body>

</html>
<?php include("partials/footer.php"); ?>