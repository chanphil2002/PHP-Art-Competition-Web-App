<?php
    include ("partials/header.php");
    include ("partials/database.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ../general/registeredUserLogin.php");
    }else{
        $sql = "SELECT * FROM user WHERE userEmail = '$_SESSION[user]' ";
        $res = mysqli_query($conn, $sql);
        while ($userDetails = mysqli_fetch_assoc($res)){
            $profilePic = $userDetails["userProfilePic"];
            $userEmail = $userDetails["userEmail"];
            $username = $userDetails["username"];
            $g = $userDetails["gender"];
            if ($g == "M"){
                $gender = "Male";
            }else {
                $gender = "Female";
            }
            $dob = $userDetails["DoB"];
            $phone = $userDetails["phoneNum"];
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
    <link rel="stylesheet" type="text/css" href="../admin/addjudge.css"/>
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
                <?php if ($profilePic != ""){ ?>
                <div class="form-row">
                    <center><div style="position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 2px solid #08007f;">
                        <image src="../materials/userProfilePic/<?php echo $profilePic; ?>" style="width:100% ;height:auto;" class="" alt="...">
                    </div></center>
                </div><?php } ?>
                <div class="form-row">
					<br><label for="username">USERNAME</label>
					<input type="text" name="username" id="username" class="input-text" value="<?php echo $username; ?>" readonly required>
				</div>
                <div class="form-row">
					<br><label for="userEmail">EMAIL</label>
					<input type="text" name="userEmail" id="userEmail" class="input-text" value="<?php echo $userEmail; ?>" readonly required>
				</div>
                <div class = "form-row">
                    <br><label for="gender">GENDER</label>
					<input type="text" name="gender" id="gender" class="input-text" value="<?php echo $gender; ?>" readonly required>
                </div>
                <div class="form-row" style="width: 100%">
                    <br><label for="dob">DATE OF BIRTH</label>
					<input type="text" name="dob" id="dob" class="input-text" value="<?php echo $dob; ?>" readonly required>
                </div>
                <div class="form-row">
					<br><label for="username">PHONE NUMBER</label>
					<input type="text" name="phone" id="phone" class="input-text" value="<?php echo $phone; ?>" readonly required>
				</div>
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