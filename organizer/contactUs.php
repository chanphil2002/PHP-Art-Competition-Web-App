<?php
include("partials/header.php");
// include ("partials/database.php");

$sql = "SELECT * FROM organizer WHERE organizerID = '$_SESSION[organizer]' ";
$run = mysqli_query($conn, $sql);
while ($res = mysqli_fetch_assoc($run)) {
    $user = $res["organizerID"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../admin/addJudge.css">

</head>

<body class="form-v7">
    <div class="page-content">
        <div class="form-v7-content">
            <form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-row">
                    <strong>
                        <h2 class="text-1" style="text-decoration: underline">Feedback</h2>
                    </strong>
                    <br><br><br><br><br><label for="email">SENDER'S EMAIL *</label>
                    <input type="email" name="email" id="email" class="input-text" value="<?php echo $user; ?>" readonly required>
                </div>

                <?php $object = "ADMINISTRATOR"; ?>

                <div class="form-row">
                    <br><label for="feedback">FEEDBACK FOR <?php echo $object; ?> *</label>
                    <textarea class="form-control" name="feedback" id="feedback" rows="5" required></textarea>
                </div><br><br><br>
                <div>
                    <center>
                        <a href="orghome.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="submit" class="btn btn-success">Submit Feedback</button>
                    </center>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
if (isset($_POST["submit"])) {

    $type = "Admin";
    $desc = $_POST["feedback"];
    $status = "unresolved";


    $sql = "INSERT INTO feedback (feedbackType, description, organizerID, status) VALUES ('$type', '$desc', '$_SESSION[organizer]', '$status') ";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<script>alert ('Feedback submitted successfully!') 
            location = 'orghome.php' </script>";
    } else {
        echo "<script>alert ('Oops, something went wrong. Please try again.') </script>";
    }
}
?>

<?php include("partials/footer.php"); ?>