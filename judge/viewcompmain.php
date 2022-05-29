<?php include("../judge/partials/header.php"); ?>

<?php
if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT C.*, O.organizerName FROM competition C INNER JOIN organizer O ON C.compID=$compID";
    $res = mysqli_query($conn, $sql);
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
    <img src="../materials/image/test1.jpg" alt="Responsive image" height="300" style="background-size:cover">
    <ul class="nav nav-pills nav-fill p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="viewcompmain.php?compID=<?php echo $compID; ?>">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="new-entry.php?compID=<?php echo $compID ?>">View Entries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomprubric.php?compID=<?php echo $compID; ?>">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcompabout.php?compID=<?php echo $compID; ?>">About</a>
        </li>
    </ul>


    <div class="container">
        <div class="row">
            <div class="col-9">
                <div>
                    <h2 style="display: inline-block"><?php echo $compName ?></h2>
                    <span class="badge text-bg-success align-top even-larger-badge">Ongoing</span>
                </div>
                <h3>By <?php echo $organizerName ?>, <?php echo $category ?> Category</h3>

                <div class=" row">
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Competition Date</h3>
                                <h2><?php echo $releaseDate; ?> - <?php echo $registrationDeadline; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Scoring Format</h3>
                                <h2><u><?php echo $publicVote; ?> </u> Public Vote</h2>
                                <h2><u><?php echo $judgeScore; ?></u> Judge</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Total Prize Pool</h3>
                                <h2><?php echo $prizePool; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>
                        Description
                    </h2>
                    <h3>
                        <?php echo $description; ?>
                    </h3>
                </div>
                <div>
                    <h2>
                        Rules and Regulation
                    </h2>
                    <h3>
                        <?php echo $rules; ?>
                    </h3>
                </div>
            </div>
            <div class="col-3">
                <h3>&#128101; Join this competition</h3>
                <h3>&#128147; Vote for this</h3>
                <hr>
                <h2><u>Winner</u></h2>
                <img src="../materials/image/download.jpg" alt="">
            </div>
        </div>
    </div>
    <hr>
    <div class="justify-content-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Announcement</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Title</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Description</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <a href=""><button type="button" class="btn btn-primary">Edit</button></a>
        <a href=""><button type="button" class="btn btn-primary">Delete</button></a>
        <a href=""><button type="button" class="btn btn-primary">View Feedback</button></a>
    </div>

    <script src="https://kit.fontawesome.com/8deb7b58d3.js" crossorigin="anonymous"></script>
</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>