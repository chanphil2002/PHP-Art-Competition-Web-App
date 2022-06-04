<?php
include("partials/header.php");

session_start();
if (!isset($_SESSION["judge"])) {
    header("Location: ../general/judgeLogin.php");
} else {
    $sql = "SELECT * FROM judge WHERE judgeIC = '$_SESSION[judge]' ";
    $res = mysqli_query($conn, $sql);
    while ($userDetails = mysqli_fetch_assoc($res)) {
        $profilePic = $userDetails["judgeProfilePic"];
        $userEmail = $userDetails["judgeEmail"];
        $username = $userDetails["judgeName"];
        $judgeBio = $userDetails["judgeBio"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/addjudge.css" />
</head>

<body class="form-v7">
    <div>
        <strong>
            <br>
            <center>
                <h2>My Profile</h2>
            </center>
        </strong>
    </div>

    <div class="page-content">
        <div class="form-v7-content">
            <form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <?php if ($profilePic != "") { ?>
                    <div class="form-row">
                        <center>
                            <div style="position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 2px solid #08007f;">
                                <image src="../materials/judgeProfilePic/<?php echo $profilePic; ?>" style="width:100% ;height:auto;" class="" alt="...">
                            </div>
                        </center>
                    </div><?php } ?>
                <div class="form-row">
                    <br><label for="username">JUDGE NAME</label>
                    <input type="text" name="username" id="username" class="input-text" value="<?php echo $username; ?>" readonly required>
                </div>
                <div class="form-row">
                    <br><label for="userEmail">EMAIL</label>
                    <input type="text" name="userEmail" id="userEmail" class="input-text" value="<?php echo $userEmail; ?>" readonly required>
                </div>
                <div class="form-row">
                    <br><label for="username">JUDGE BIO</label>
                    <textarea name="judgeBio" id="judgeBio" class="form-control" row="auto" readonly required><?php echo $judgeBio; ?></textarea>
                </div><br><br><br>
                <div>
                    <center>
                        <a href="homepage.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="editProfile.php"><button type="button" name="edit" class="btn btn-primary">Edit Information</button></a>
                    </center>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php include("partials/footer.php"); ?>