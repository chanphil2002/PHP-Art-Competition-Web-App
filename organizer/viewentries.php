<?php include("../organizer/partials/header.php");

if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT C.*, O.* FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID AND C.compID=$compID AND O.organizerID='$_SESSION[organizer]'";
    $sql1 = "SELECT E.entryID, E.entryFile, E.title, E.compID, E.userEmail, E.submitDate, E.vote, 
                    E.score, C.publicVote, C.judgeScore, 
                    ((E.vote / (SELECT SUM(vote) FROM entry WHERE compID = $compID)) * C.publicVote) AS 
                    votePercentage, (E.score * (C.judgeScore/100)) AS judgePercentage FROM entry E 
                    INNER JOIN competition C ON E.compID = C.compID WHERE C.compID = $compID";
    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    header("Location: ../organizer/orghome.php");
}

while ($row = mysqli_fetch_assoc($res)) {
    $compName = $row['compName'];
    $compPic = $row['compPic'];
    $status = $row['status'];
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="organizer.css">
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
            <a class="nav-link active" href="viewentries.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_rubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php?compID=<?php echo $compID; ?>">About Organizer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewfeedback.php?compID=<?php echo $compID; ?>">View Feedback</a>
        </li>
    </ul>
    <main>
        <div class="index-section-6" style="box-sizing:border-box; display: block; padding-bottom: 1rem!important">
            <div class="container">
                <div class="row" style="box-sizing:border-box">
                    <div style="flex: 0 0 auto; width: 80%">
                        <h2><span class="text-color-3"><?php echo $compName ?>'s</span>
                            Entries</h2>
                    </div>
                </div>
            </div>

            <div class="container pb-5">
                <div class="row">
                    <?php
                    $count = mysqli_num_rows($res1);
                    if ($count > 0) {
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            $entryID = $row1['entryID'];
                            $entryFile = $row1['entryFile'];
                            $title = $row1['title'];
                            $compID = $row1['compID'];
                            $userEmail = $row1['userEmail'];
                            $submitDate = $row1['submitDate'];
                            $vote = $row1['vote'];
                            $score = $row1['score'];
                            $publicVote = $row1['publicVote'];
                            $judgeScore = $row1['judgeScore'];
                            $votePercentage = $row1['votePercentage'];
                            $judgePercentage = $row1['judgePercentage'];

                    ?>

                            <div class="col-md-4 margincon1" style="margin-top: 2%">
                                <div class=" card border-1 grid-list">
                                    <a href="../organizer/viewspecific_entry.php?entryID=<?php echo $entryID; ?>&compID=<?php echo $compID; ?>" class="stretched-link">
                                        <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $entryID; ?></span>
                                        <img class="card-img-top lazy" src="../materials/entries/<?php echo $entryFile; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        <?php echo $submitDate ?> / <?php echo $userEmail; ?>
                                        <div class="title text-truncate">
                                            <h3><?php echo $title; ?> </h3>
                                            <?php if ($status == "On-Going" || $status == "Past") { ?>
                                                <div class="text-success">
                                                    Vote: <?php echo number_format((float)$votePercentage, 2, '.', ''); ?>/ <?php echo number_format((float)$publicVote, 2, '.', ''); ?><br>
                                                    Judge's score: <?php echo number_format((float)$judgePercentage, 2, '.', ''); ?>/ <?php echo number_format((float)$judgeScore, 2, '.', ''); ?>
                                                </div>
                                                <div class="text-danger">
                                                    Total Score:
                                                    <?php
                                                    echo number_format((float)$judgePercentage, 2, '.', '') + number_format((float)$votePercentage, 2, '.', '');
                                                    $sql2 = "UPDATE entry SET totalScore = $votePercentage + 
                                                    $judgePercentage WHERE entryID = $entryID";
                                                    $res2 = mysqli_query($conn, $sql2);


                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo "<h2 class='text-primary'>No Result Found.</h2>";
                    } ?>
                </div>

            </div>
        </div>


        </div>

    </main>


</body>

<?php include("../organizer/partials/footer.php"); ?>