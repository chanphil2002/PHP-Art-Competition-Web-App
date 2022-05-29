<?php include("../judge/partials/header.php");

if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT * FROM entry WHERE compID=$compID";
    $sql1 = "SELECT compName FROM competition WHERE compID=$compID";
    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    echo "mistake";
}

while ($row1 = mysqli_fetch_assoc($res1)) {
    $compName = $row1['compName'];
}

if (isset($_POST['submit2'])) {
    $filter = $_POST['filter_dropdown'];

    if ($filter == "Scored") {
        $sql2 = "SELECT * FROM entry WHERE Score IS NOT NULL";
        $res2 = mysqli_query($conn, $sql2);
    } else if ($filter == "Unscored") {
        $sql2 = "SELECT * FROM entry WHERE Score IS NULL";
        $res2 = mysqli_query($conn, $sql2);
    } else {
        $sql2 = "SELECT * FROM entry";
        $res2 = mysqli_query($conn, $sql2);
    }
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="new-entry.css">
</head>

<body>
    <main>
        <div class=" index-section-6" style="box-sizing:border-box; margin-top: 6%; display: block; padding-top: 1rem!important; padding-bottom: 1rem!important">
            <div class="container">
                <div class="row" style="box-sizing:border-box">
                    <div style="flex: 0 0 auto; width: 70%">
                        <h3 class="center"><span class="text-color-3"><?php echo $compName ?>'s</span>
                            Entries</h3>
                    </div>

                    <div style="flex: 0 0 auto; width: 30%">
                        <form action="../judge/new-entry2.php?compID=<?php echo $compID ?>" method="POST" class="d-flex">
                            <div class=" overflow-auto">
                                <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
                                <label for="filter_dropdown"></label>
                                <select name="filter_dropdown" id="filter_dropdown">
                                    <option value=" ">Filter By: All Entries </option>
                                    <option value="Scored">Filter By: Scored Entries</option>
                                    <option value="Unscored">Filter By: Unscored Entries</option>
                                </select>
                                <input type="submit" name="submit2" value="Search" class="btn btn-outline-dark my-2 my-sm-0" style="margin-left:20px">
                            </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <?php
                    $count = mysqli_num_rows($res2);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res2)) {
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
                                    <a href="../organizer/viewspecific_entry.php?compID=<?php echo $compID; ?>" class="stretched-link">
                                        <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $entryID; ?></span>
                                        <img class="card-img-top lazy" src="../materials/image/<?php echo $entryFile; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        <?php echo $submitDate ?> / <?php echo $userEmail; ?>
                                        <div class="title text-truncate"><?php echo $title; ?></div>
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

<?php include("../judge/partials/footer.php"); ?>