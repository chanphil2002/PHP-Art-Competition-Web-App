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
        $img = "../materials/judgeProfilePic/$profilePic";
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
                <h2>Edit Profile</h2>
            </center>
        </strong>
    </div>

    <div class="page-content">
        <div class="form-v7-content">
            <form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-row">
                    <center>
                        <div style="position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 2px solid #08007f;">
                            <image src="../materials/userProfilePic/<?php echo $profilePic; ?>" style="width:100% ;height:auto;" class="" alt="...">
                        </div>
                    </center>
                </div>
                <div class="form-row">
                    <br><label for="username">JUDGE NAME *</label>
                    <input type="text" name="username" id="username" class="input-text" value="<?php echo $username; ?>" readonly required>
                </div>
                <div class="form-row">
                    <br><label for="userEmail">JUDGE EMAIL *</label>
                    <input type="text" name="userEmail" id="userEmail" class="input-text" value="<?php echo $userEmail; ?>" readonly required>
                </div>
                <div class="form-row">
                    <br><label for="username">JUDGE BIO *</label>
                    <textarea name="judgeBio" id="judgeBio" class="form-control" required><?php echo $judgeBio; ?></textarea>
                </div>
                <div class="form-row">
                    <br><label for="profilePic">PROFILE PICTURE</label><br>
                    <input type="file" name="profilePic" id="profilePic" accept="image/*">
                    <br>
                    <br>
                    <br>
                </div>
                <div>
                    <center>
                        <a href="judgeprofile.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                    </center>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $gender = $_POST["userEmail"];
    $dob = $_POST["judgeBio"];
    $phone = $_POST["phone"];

    if ($_FILES['profilePic']['name'] == "") {
        $update = "UPDATE judge SET judgeName='$username', judgeEmail='$gender', judgeBio='$dob' WHERE judgeIC = '$_SESSION[judge]' ";
        $run = mysqli_query($conn, $update);

        if ($run) {
            echo "<script>
            alert ('Account Personal Information edited successfully!')
            location = 'judgeprofile.php'
            </script>";
        } else {
            echo "<script>alert ('Oops, something went wrong! Please retry later.')</script>";
        }
    } else {
        $profilePic = $_FILES["profilePic"]["name"];
        $tmp_name = $_FILES["profilePic"]["tmp_name"];

        $update = "UPDATE judge SET judgeName='$username', judgeEmail='$gender', judgeBio='$dob', judgeProfilePic='$profilePic' WHERE judgeIC = '$_SESSION[judge]' ";
        $run = mysqli_query($conn, $update);

        if ($run) {
            echo "<script>
            alert ('Account Personal Information edited successfully!')
            location = 'judgeprofile.php'
            </script>";
            unlink($img);
            move_uploaded_file($tmp_name, "../materials/judgeProfilePic/$profilePic");
        } else {
            echo "<script>alert ('Oops, something went wrong! Please retry later.')</script>";
        }
    }

    // $sql1 = "UPDATE user SET username='$username', gender='$gender', DoB='$dob', phoneNum='$phone', userProfilePic='$profilePic' WHERE userEmail = '$_SESSION[user]' ";
    // $res1 = mysqli_query($conn, $sql1);

    // if ($res1){
    //     move_uploaded_file($tmp_name, "../materials/userProfilePic/$profilePic");
    //     echo "<script>
    //     alert ('Account Personal Information edited successfully!')
    //     location = 'myProfile.php'
    //     </script>";
    // }else{
    //     echo "<script>alert ('Oops, something went wrong! Please retry later.')</script>";
    // }
}

include("partials/footer.php"); ?>