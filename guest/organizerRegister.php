<?php 

include ("partials/database.php");
include ("partials/header.php");

if (isset($_POST['submit'])) {
	$email = $_POST['orgEmail'];
	$name = addslashes($_POST['name']);
	$password = addslashes($_POST['password']);
	$confirm_pass = addslashes($_POST['confirm_pass']);
	$desc = addslashes($_POST['desc']);
	$profile_picture = $_FILES['profile_picture']['name'];
	$tmp_name = $_FILES['profile_picture']['tmp_name'];
	$verify_doc = $_FILES['verify_doc']['name'];


	// double confirm password entered
	if ($confirm_pass == $password){
		// check whether the user account already exists
		$sql = "SELECT * FROM organizer WHERE organizerEmail ='$email'";
		$result = mysqli_query($conn, $sql);

		// if user account not exixts
		if (mysqli_num_rows($result) == 0) {
			$upload = "INSERT INTO organizer (organizerEmail, organizerPassword, organizerName, organizerDesc, organizerProfilePic, organizerVerifiedDoc, organizerStatus) VALUES ('$email', '$password', '$name', '$desc', '$profile_picture', '$verify_doc', 'pending')";
			$run_upload = mysqli_query($conn, $upload);

			if ($run_upload == true) {
				echo "<script>alert('Application submitted!')
				location='../index.php'</script>";
				move_uploaded_file($tmp_name, "../materials/orgProfilePic/$profile_picture");
				$tmp_name = $_FILES['verify_doc']['tmp_name'];
				move_uploaded_file($tmp_name, "../materials/orgDocument/$verify_doc");
			} else {
				echo "<script>alert('Oops. Something Went Wrong, Please Try Again.')</script>";
			}
		} else {
			echo "<script>alert('Organizer account existed.')</script>";
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
	<title>Organizer Account Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="../admin/addJudge.css" />
	<meta name="robots" content="noindex, follow">
</head>

<body class="form-v7">
	<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
				<div class="form-row">
					<strong>
						<h2 class="text-1">Organizer Account Application</h2>
					</strong>
					<br><br><br><br><br><label for="orgEmail">EMAIL *</label>
					<input type="email" name="orgEmail" id="orgEmail" class="input-text" required>
				</div>
				<div class="form-row">
					<br><label for="name">NAME *</label>
					<input type="text" name="name" id="name" class="input-text" required>
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
					<br><label for="desc" class="form-label">ORGANIZATION DESCRIPTION *</label>
					<textarea class="form-control" name="desc" id="desc" rows="10" required></textarea>
				</div>
				<div class="form-row">
					<br><br><label for="profile_picture">PROFILE PICTURE *</label><br>
					<input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
					<br>
				</div>
				<div class="form-row">
					<br><br><label for="verify_doc">VERIFICATION DOCUMENT (.pdf) *</label><br>
					<input type="file" name="verify_doc" id="verify_doc" accept=".pdf" required>
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
<?php include ("partials/footer.php");?>