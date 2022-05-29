<?php include ("../admin/partials/header.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judge Profile</title>
    <link rel="stylesheet" href="addJudge.css" />
</head>
<body class="form-v7">
<div>
    <strong>
        <center><h2>Judge Profile</h2></center>
    </strong>
</div>
<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <?php
                    if (isset($_GET['selectedIC'])){
                        $ic = $_GET['selectedIC'];

                        $sql = "SELECT * FROM judge WHERE judgeIC = '$ic'";
                        $result = mysqli_query($conn, $sql);
                        $judgeInfo = mysqli_fetch_assoc($result);
                        $name = $judgeInfo['judgeName'];
                        $email = $judgeInfo['judgeEmail'];
                        $password = $judgeInfo['judgePassword'];
                        $bio = $judgeInfo['judgeBio'];
						$img = $judgeInfo["judgeProfilePic"];
						$imgPath = ("../judge/judgeProfile/$img");

                ?>
                <center><div>
                    <img src="../judge/judgeProfile/<?php echo $img?>" style="width: 10rem;"><br><br><br>
                </div></center>
				<div class="form-row">
					<label for="ic">IDENTITY CARD NUMBER *</label>
					<input type="text" name="ic" placeholder="xxxxxx-xx-xxxx"  pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" id="ic" class="input-text" value= "<?php echo $ic ?>" readonly>
				</div>
                <div class="form-row">
					<br><label for="name">NAME *</label>
					<input type="text" name="name" id="name" class="input-text" value="<?php echo $name ?>" required>
				</div>
                <div class="form-row">
					<br><label for="email">EMAIL *</label>
					<input type="email" name="email" placeholder="abc@gmail.com" id="email" class="input-text" value="<?php echo $email ?>" required>
				</div>
				<div class="form-row">
					<br><label for="bio" class="form-label">BIO *</label>
					<textarea class="form-control" name="bio" id="bio" rows="20" required><?php echo $bio ?></textarea>
				</div>
				<div class="form-row">
					<br><br><label for="profile_picture">PROFILE PICTURE *</label><br>
					<input type="file" name="profile_picture" id="profile_picture" accept="image/*">
					<br>
					<br>
					<br>
				</div>
                <?php } ?>
				<div>
					<center><a href="viewJudge.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="submit" name="submit" class="btn btn-success">Update</button></a></center>
				</div>
    
			</form>
		</div>
	</div>
</body>
</html>
<?php 
	if (isset($_POST["submit"])){
		$newName = $_POST['name'];
		$newEmail = $_POST['email'];
		$newBio = $_POST["bio"];

		//if no profile picture added
		if($_FILES['profile_picture']['name'] == ""){
			$update = "UPDATE judge SET judgeName= '$newName', judgeEmail= '$newEmail', judgeBio= '$newBio' WHERE judgeIC = '$ic'";
			$run_update = mysqli_query($conn, $update);

			if($run_update == true){
				echo "<script>alert('Profile updated successfully!')
				location = 'viewJudge.php' </script>";

			}else {
				echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
			}
		}else{
        	unlink($imgPath);
			$newProfilePic = $_FILES['profile_picture']['name'];
			$tmp_name = $_FILES['profile_picture']['tmp_name'];

			$update = "UPDATE judge SET judgeName= '$newName', judgeEmail= '$newEmail', judgeBio= '$newBio', judgeProfilePic= '$newProfilePic' WHERE judgeIC = '$ic'";
			$run_update = mysqli_query($conn, $update);

			if($run_update == true){
				echo "<script>alert('Profile updated successfully.')
				location = 'viewJudge.php' </script>";
				move_uploaded_file($tmp_name, "../judge/judgeProfile/$newProfilePic");

			}else {
				echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
			}
		}
	}
?>
<?php include ("../admin/partials/footer.php")?>