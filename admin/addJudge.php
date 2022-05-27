<?php include ("../admin/partials/header.php");
// include ("partials/database.php");

session_start();

if (isset($_POST['submit'])) {
	$ic = $_POST['ic'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_pass = $_POST['confirm_pass'];
	$bio = $_POST['bio'];
	$profile_picture = $_FILES['profile_picture']['name'];
	$tmp_name = $_FILES['profile_picture']['tmp_name'];


	// double confirm password entered
	if ($confirm_pass == $password){
		// check whether the user account already exists
		$sql = "SELECT * FROM judge WHERE judgeIC ='$ic'";
		$result = mysqli_query($conn, $sql);

		// if user account not exixts
		if (mysqli_num_rows($result) == 0) {
			$upload = "INSERT INTO judge (judgeIC, judgeName, judgeEmail, judgePassword, judgeBio, judgeProfilePic) VALUES ('$ic', '$name', '$email', '$password', '$bio', '$profile_picture')";
			$run_upload = mysqli_query($conn, $upload);

			if ($run_upload == true) {
				echo "<script>alert('Account Successfully Created!')</script>";
				move_uploaded_file($tmp_name, "judgeProfile/$profile_picture");
				header("location:http://localhost/Virtual-X/organizer/selectedjudge.php");
			} else {
				echo "<script>alert('Oops. Something Went Wrong, Please Try Again.')</script>";
			}
		} else {
			echo "<script>alert('User Already Exists.')</script>";
		}
	} else {
		echo "<script>alert('Password entered not matched. Please try again.')</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Judge Registration Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="addJudge.css" />
	<meta name="robots" content="noindex, follow">
</head>

<body class="form-v7">
	<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
				<div class="form-row">
					<strong>
						<h2 class="text-1">Judge Registration Page</h2>
					</strong>
					<br><br><br><br><br><label for="ic">IDENTITY CARD NUMBER *</label>
					<input type="text" name="ic" placeholder="xxxxxx-xx-xxxx"  pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" id="ic" class="input-text" required>
				</div>
				<div class="form-row">
					<br><label for="name">NAME *</label>
					<input type="text" name="name" id="name" class="input-text" required>
				</div>
                <div class="form-row">
					<br><label for="email">EMAIL *</label>
					<input type="email" name="email" placeholder="abc@gmail.com" id="email" class="input-text" required>
				</div>
				<div class="form-row">
					<br><label for="password">PASSWORD *</label>
					<input type="password" name="password" id="password" class="input-text" required>
				</div>
				<div class="form-row">
					<br><label for="password">CONFIRM PASSWORD *</label>
					<input type="password" name="confirm_pass" id="confirm_pass" class="input-text" required>
				</div>
				<div class="form-row">
					<br><label for="bio" class="form-label">BIO *</label>
					<textarea class="form-control" name="bio" id="bio" rows="10" required></textarea>
				</div>
				<div class="form-row">
					<br><br><label for="profile_picture">PROFILE PICTURE *</label><br>
					<input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
					<br>
					<br>
					<br>
				</div>
				<div>
					<center><button type="submit" name="submit" class="btn btn-primary">Submit</button></a></center>
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>