<?php include("../organizer/partials/header.php"); ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT C.*, O.organizerName FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID AND C.compID=$compID";
    $sql1 = "SELECT COUNT(compID), SUM(vote) FROM entry WHERE compID=$compID";
    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    echo "mistake";
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
}
while ($row1 = mysqli_fetch_assoc($res1)) {
    $joinCount = $row1['COUNT(compID)'];
    $voteCount = $row1['SUM(vote)'];
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
            <a class="nav-link active" aria-current="page" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewentries.php?compID=<?php echo $compID ?>">View Entries</a>
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


    <div class="container pb-5">
        <div class="row">
            <div class="col-9">
                <div>
                    <h2 style="display: inline-block" style="margin-right: 2em;"><?php echo $compName ?></h2>
                    <span style="display: inline-block; margin-left: 1em" class="badge text-bg-success align-top even-larger-badge"><?php echo $status ?></span>
                </div>
                <h3 class="text-muted mb-4"><small class="text-muted">By <?php echo $organizerName ?>, <?php echo $category ?> Category</small></h3>

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
                                <h3 class="card-text"><?php echo $prizePool; ?></h3>
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
            </div>
            <div class="col-3">
                <h3>&#128101; <?php if ($joinCount == 0) {
                                    echo "Be The First To Join!</h3>";
                                } else {
                                    echo "$joinCount People Participated</h3>";
                                } ?>
                    <h3>&#128147; <?php if ($voteCount == NULL) {
                                        echo "Be The First To Vote!</h3>";
                                    } else {
                                        echo "$voteCount People Voted</h3>";
                                    } ?>
                        <hr>
                        <h2>Winner</h2>
                        <img src="../materials/image/download.jpg" alt="">
            </div>
        </div>
        <hr>
        <button class="btn btn-success btn-lg mx-auto px-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Make Announcement</button>
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black;" id="exampleModalLabel">Make Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Description</label>
                                <textarea class="form-control" name="announcement" id="message-text" rows="6" onclick="divide()"><?php echo $announcement ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <a href="editcomp.php?compID=<?php echo $compID; ?>"><button type="button" class="btn btn-primary btn-lg mx-auto px-5">Edit</button></a>
        <a href=""><button type="button" class="btn btn-danger btn-lg mx-auto px-5">Delete</button></a>

        <button class="btn btn-secondary btn-lg mx-auto px-5" data-bs-toggle="modal" data-bs-target="#exampleModal2">View Announcement</button>
        <div class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>


    <script src="https://kit.fontawesome.com/8deb7b58d3.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function divide() {
            var txt;
            txt = document.getElementById('a').value;
            var text = txt.split(".");
            var str = text.join('.</br>');
            document.write(str);
        }
    </script>
</body>

</html>

<?php
ob_start();
if (isset($_POST['submit'])) {
    $announcement = $_POST['announcement'];

    $sql = "UPDATE competition SET
            announcement = '$announcement' WHERE compID = $compID";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        header("location:" . SITEURL . "organizer/viewcomp_main.php?compID=$compID");
    }
}
include("../organizer/partials/footer.php");
?>