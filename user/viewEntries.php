<?php
include("partials/header.php");
include("partials/database.php");

if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM entry WHERE compID=$compID";
    $sql1 = "SELECT * FROM competition WHERE compID=$compID";
    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    echo "mistake";
}

while ($row1 = mysqli_fetch_assoc($res1)) {
    $compName = $row1['compName'];
    $status = $row1['status'];
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="organizer.css">
</head>

<body>
    <img class="img" src="../materials/image/<?php echo $compPic; ?>" alt="Responsive image" height="300" width="100%" style="object-fit: cover;">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="compDetails.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="viewentries.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compRubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compAbout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>
    <main>
        <div class="index-section-6" style="box-sizing:border-box; display: block; padding-bottom: 1rem!important">
            <div class="container">
                <div class="row" style="box-sizing:border-box">
                    <div style="flex: 0 0 auto; width: 80%">
                        <h3><span class="text-color-3"><?php echo $compName ?>'s</span>
                            Entries</h3>
                    </div>
                </div>
            </div>

            <div class="container pb-5">
                <div class="row">
                    <?php
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $entryID = $row['entryID'];
                            $entryFile = $row['entryFile'];
                            $title = $row['title'];
                            $compID = $row['compID'];
                            $userEmail = $row['userEmail'];
                            $submitDate = $row['submitDate'];
                            $vote = $row['vote'];
                            $score = $row['score'];
                            $totalScore = $row['totalScore'];

                    ?>

                            <div class="col-md-4 margincon1" style="margin-top: 2%">
                                <div class=" card border-1 grid-list">
                                    <a href="entry.php?entryID=<?php echo $entryID; ?>&compID=<?php echo $compID; ?>" class="stretched-link">
                                        <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $entryID; ?></span>
                                        <img class="card-img-top lazy" src="../materials/entries/<?php echo $entryFile; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        <?php echo $submitDate ?> / <?php echo $userEmail; ?>
                                        <div class="title text-truncate">
                                            <h3><?php echo $title; ?> </h3>
                                            <?php if ($status == "On-Going"){ ?>
                                                    <div class="text-success">Current Vote: <?php echo $vote; ?></div>
                                            <?php }elseif ($status == "Past"){ ?>
                                                    <div class="text-success">
                                                        Vote: <?php echo $vote; ?><br>
                                                        Judge's score: <?php echo $score; ?>/100
                                                    </div>
                                                    <div class="text-danger">
                                                        Total Score: <?php echo $totalScore; ?>
                                                    </div>
                                            <?php } ?>
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
        </div>


        </div>

    </main>


</body>

<?php include("partials/footer.php"); ?>