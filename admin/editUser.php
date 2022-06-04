<?php include("../admin/partials/header.php");
if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Profile</title>
	<link rel="stylesheet" href="addJudge.css" />
</head>

<body class="form-v7">
	<div>
		<strong>
			<center>
				<h2>User Profile</h2>
			</center>
		</strong>
	</div>
	<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
				<?php
				if (isset($_GET['editEmail'])) {
					$email = $_GET['editEmail'];

					$sql = "SELECT * FROM user WHERE userEmail = '$email'";
					$result = mysqli_query($conn, $sql);
					$row_user = mysqli_fetch_assoc($result);
					$username = $row_user['username'];
					$email = $row_user['userEmail'];
					$dob = $row_user['DoB'];
					$gender = $row_user['gender'];
					$phone = $row_user['phoneNum'];
					$img = $row_user["userProfilePic"];
					$imgPath = ("../materials/userProfilePic/$img");

				?>
					<?php
					if ($img != "") {
					?>
						<center>
							<div>
								<br><img src=<?php echo $imgPath ?> style="width: 10rem;"><br><br><br>
							</div>
						</center>
					<?php } ?>
					<div class="form-row">
						<label for="username">USERNAME *</label>
						<input type="text" name="username" id="username" class="input-text" value="<?php echo $username ?>" required>
					</div>
					<div class="form-row">
						<br><label for="email">EMAIL *</label>
						<input type="email" name="email" placeholder="abc@gmail.com" id="email" class="input-text" value="<?php echo $email ?>" required>
					</div>
					<div class="form-row">
						<br><label for="dob">DoB *</label>
						<input type="date" name="dob" id="dob" class="input-text" value="<?php echo $dob ?>" required>
					</div>
					<?php
					if ($gender == "M") {
					?>
						<div class="form-row">
							<label for="gender">GENDER *</label>
							<select class="form-row" name="gender" id="gender" style="height: 25px; margin-top: 3%;" required>
								<option value="">Choose Your Gender *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="M" selected>Male</option>
								<option value="F">Female</option>
							</select>
						</div>
					<?php } else { ?>
						<div class="form-row">
							<br><label for="gender">GENDER *</label>
							<select class="form-row" name="gender" id="gender" style="height: 25px; margin-top: 3%;" required>
								<option value="">Choose Your Gender *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="M">Male</option>
								<option value="F" selected>Female</option>
							</select>
						</div>
					<?php } ?>
					<div class="form-row">
						<br><br><label for="phone">PHONE NUMBER *</label>
						<input type="tel" name="phone" id="phone" class="input-text" value="<?php echo $phone ?>" required>
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
					<center><a href="viewUser.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" name="update" class="btn btn-success">Update</button></a>
					</center>
				</div>

			</form>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_POST["update"])) {
	$newUsername = $_POST['username'];
	$newEmail = $_POST['email'];
	$newDoB = $_POST["dob"];
	$newGender = $_POST["gender"];
	$newPhone = $_POST["phone"];

	//if no profile picture added
	if ($_FILES['profile_picture']['name'] == "") {
		$update = "UPDATE user SET userEmail= '$newEmail', username= '$newUsername', DoB='$newDoB', gender='$newGender', phoneNum= '$newPhone' WHERE userEmail = '$email'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Profile updated successfully!')
				location = 'viewUser.php' </script>";
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else {
		$newProfilePic = $_FILES['profile_picture']['name'];
		$tmp_name = $_FILES['profile_picture']['tmp_name'];

		$update = "UPDATE user SET userEmail= '$newEmail', username= '$newUsername', DoB='$newDoB', gender='$newGender', phoneNum= '$newPhone', userProfilePic= '$newProfilePic' WHERE userEmail = '$email'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Profile updated successfully.')
				location = 'viewUser.php' </script>";
			unlink($imgPath);
			move_uploaded_file($tmp_name, "../materials/userProfilePic/$newProfilePic");
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	}
}
?>
<?php include("../admin/partials/footer.php") ?>