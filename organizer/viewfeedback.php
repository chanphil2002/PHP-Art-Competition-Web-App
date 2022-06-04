<?php include("../organizer/partials/header.php"); ?>

<?php

if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
    $sql = "SELECT F.*, O.* FROM feedback F INNER JOIN organizer O ON F.organizerID WHERE F.compID=$compID AND O.organizerID = '$_SESSION[organizer]'";
    $sql1 = "SELECT C.* FROM  competition C INNER JOIN organizer O ON C.organizerID = O.organizerID AND 
    C.compID=$compID AND O.organizerID='$_SESSION[organizer]'";
    $res = mysqli_query($conn, $sql);
    $res2 = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);
} else {
    header("Location: ../organizer/orghome.php");
}
while ($row = mysqli_fetch_assoc($res1)) {
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
            <a class="nav-link" href="viewentries.php?compID=<?php echo $compID ?>">View Entries</a>
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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div style="margin-bottom: 3em;">
                    <h2>Feedback</h2>
                    <?php
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $feedbackID = $row['feedbackID'];
                            $feedbackType = $row['feedbackType'];
                            $description = $row['description'];
                            $entryID = $row['entryID'];
                            $userEmail = $row['userEmail'];
                            $organizerID = $row['organizerID'];
                            $status = $row['status'];

                            if ($feedbackType == 'Organizer' && $status != 'resolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body'>
                                    <h3 style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-secondary'> Feedback </span> $userEmail 
                                    <h3>$description</h3>
                                    <form action='' method='POST'>
                                    <input type='hidden' name='feedbackID' value='$feedbackID'>
                                    <button name='submit' type='submit' class='btn btn-primary'>Resolve</button>
                                    <form>
                                    </h3>
                                    </div>
                                </div>
                                ";
                            } else if ($feedbackType == 'Entry' && $status != 'resolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body'>
                                    <h3 style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-danger'> Entry Report Case ID - $entryID </span> $userEmail
                                    <h3>$description</h3>
                                    <form action='' method='POST'>
                                    <input type='hidden' name='feedbackID' value='$feedbackID'>
                                    <button name='submit' type='submit' class='btn btn-primary'>Resolve</button>
                                    </form>
                                    </h3>
                                    </div>
                                </div>
                                ";
                            }
                        }
                        while ($row1 = mysqli_fetch_assoc($res2)) {
                            $feedbackID = $row1['feedbackID'];
                            $feedbackType = $row1['feedbackType'];
                            $description = $row1['description'];
                            $entryID = $row1['entryID'];
                            $userEmail = $row1['userEmail'];
                            $organizerID = $row1['organizerID'];
                            $status = $row1['status'];

                            if ($feedbackType == 'Organizer' && $status != 'unresolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body bg-success'>
                                    <h3 class='text-white' style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-secondary'> Feedback </span> $userEmail 
                                    <h3 class='text-white'>$description </h3> 
                                    </h3>
                                    </div>
                                </div>
                                ";
                            } else if ($feedbackType == 'Entry' && $status != 'unresolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body bg-success'>
                                    <h3 class='text-white' style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-danger'> Entry Report Case ID - $entryID </span> $userEmail
                                    <h3 class='text-white'>$description </h3> 
                                    </h3>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    } else {
                        echo "<h2 class='text-primary'>Currently there are no feedbacks.</h2>";
                    }
                    ?>

                    <?php
                    if (isset($_POST['submit'])) {
                        $feedbackID = $_POST['feedbackID'];
                        $sql1 = "UPDATE feedback SET
                                status = 'resolved' WHERE feedbackID = $feedbackID";

                        $res1 = mysqli_query($conn, $sql1);

                        if ($res1 == true) {
                            header("location:" . SITEURL . "organizer/viewfeedback.php?compID=$compID");
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>