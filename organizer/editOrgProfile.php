<?php include("../organizer/partials/header.php"); 

if (!isset($_SESSION["organizer"])){
    header("Location: ../general/otherRoleLogin.php");
}else{
    $sql = "SELECT * FROM organizer WHERE organizerEmail = '$_SESSION[organizer]' ";
    $res = mysqli_query($conn, $sql);
    while ($orgDetails = mysqli_fetch_assoc($res)){
        $organizerProfilePic = $orgDetails["organizerProfilePic"];
        $img = "../materials/orgProfilePic/$organizerProfilePic";
        $organizerID = $orgDetails["organizerID"];
        $organizerEmail = $orgDetails["organizerEmail"];
        $organizerName = $orgDetails["organizerName"];
        $organizerDesc = $orgDetails["organizerDesc"];
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
				<h2>Edit Organizer's Profile</h2>
			</center>
		</strong>
	</div>

    <div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-row">
					<br><label for="username">NAME *</label>
					<input type="text" name="organizerName" id="organizerName" class="input-text" value="<?php echo $organizerName; ?>" required>
				</div>
                <div class="form-row">
					<br><label for="organizerEmail">EMAIL *</label>
					<input type="text" name="organizerEmail" id="organizerEmail" class="input-text" value="<?php echo $organizerEmail; ?>" required>
                </div><br>
                <div class = "form-row">
                    <br><label for="organizerDesc">DESCRIPTION</label>
					<textarea name="organizerDesc" id="organizerDesc" rows="5" class="form-control" required><?php echo $organizerDesc; ?></textarea>
                </div><br>
                <div class="form-row">
                    <br><label for="organizerProfilePic">ORGANIZER PROFILE PICTURE</label><br>
					<input type="file" name="organizerProfilePic" id="organizerProfilePic" accept="image/*">
					<br>
					<br>
					<br>
				</div>
                <div>
                    <center>
                        <input type="hidden" id='organizerID' name='organizerID' value= "<?php echo $organizerID;?>">
                        <a href="../organizer/orgprofile.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                    </center>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php 

if (isset($_POST["submit"])){
    $organizerName = $_POST["organizerName"];
    $organizerEmail = $_POST["organizerEmail"];
    $organizerDesc = $_POST["organizerDesc"];

    if($_FILES['organizerProfilePic']['name'] == ""){
        $update = "UPDATE organizer SET organizerName='$organizerName', organizerEmail='$organizerEmail', organizerDesc='$organizerDesc' WHERE organizerID = $organizerID";
        $run = mysqli_query($conn, $update);

        if ($run){
            echo "<script>
            alert ('Account Personal Information edited successfully!')
            location = '../organizer/orgprofile.php'
            </script>";
        }else{
            echo "<script>alert ('Oops, something went wrong! Please retry later.')</script>";
        }
    }else{
        $organizerProfilePic = $_FILES["organizerProfilePic"]["name"];
        $tmp_name = $_FILES["organizerProfilePic"]["tmp_name"];

        $update = "UPDATE organizer SET organizerName='$organizerName', organizerEmail='$organizerEmail', organizerDesc='$organizerDesc', organizerProfilePic='$organizerProfilePic' WHERE organizerID = $organizerID ";
        $run = mysqli_query($conn, $update);

        if ($run){
            echo "<script>
            alert ('Account Personal Information edited successfully!')
            location = '../organizer/orgprofile.php'
            </script>";
            unlink($img);
            move_uploaded_file($tmp_name, "../materials/orgProfilePic/$organizerProfilePic");
        }else{
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

include("../organizer/partials/footer.php"); ?>