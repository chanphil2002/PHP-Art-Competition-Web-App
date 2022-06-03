<?php include("../admin/partials/header.php");
if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Organizer Detail</title>
	<link rel="stylesheet" href="addJudge.css" />
</head>

<body class="form-v7">
	<div>
		<strong>
			<br>
			<center>
				<h2>Organizer Detail</h2>
			</center>
		</strong>
	</div>
	<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
				<?php
				if (isset($_GET['selectedOrganizer'])) {
					$organizerID = $_GET['selectedOrganizer'];

					$sql = "SELECT * FROM organizer WHERE organizerID = '$organizerID'";
					$result = mysqli_query($conn, $sql);
					$organizerInfo = mysqli_fetch_assoc($result);
					$organizerID = $organizerInfo['organizerID'];
					$name = $organizerInfo['organizerName'];
					$email = $organizerInfo['organizerEmail'];
					$desc = $organizerInfo['organizerDesc'];
					$profilePic = $organizerInfo['organizerProfilePic'];
					$picPath = ("../materials/orgProfilePic/$profilePic");
					$doc = $organizerInfo['organizerVerifiedDoc'];
					$docPath = ("../materials/orgDocument/$doc");
					$status = $organizerInfo['organizerStatus'];

					if ($status == 'approved') {
						$badge = "badge text-bg-success position-absolute top-0 end-0 larger-badge";
						$statusDisplay = "Approved";
						$edit = "required";
					} else if ($status == 'pending') {
						$badge = "badge text-bg-warning position-absolute top-0 end-0";
						$statusDisplay = "Pending";
						$edit = "readonly";
					} else {
						$badge = "badge text-bg-danger position-absolute top-0 end-0";
						$statusDisplay = "Rejected";
						$edit = "readonly";
					}
				?>
					<center>
						<div>
							<img src=<?php echo $picPath ?> style="width: 10rem;"><br><br><br>
						</div>
					</center>
					<div class="form-row">
						<span class="<?php echo $badge ?>"><?php echo $statusDisplay ?></span>
						<label for="id">ORGANIZER ID</label>
						<input type="text" name="id" id="id" class="input-text" value="<?php echo $organizerID ?>" readonly>
					</div>
					<div class="form-row">
						<label for="name">ORGANIZER NAME</label>
						<input type="text" name="name" id="name" class="input-text" value="<?php echo $name ?>" <?php echo $edit ?>>
					</div>
					<div class="form-row">
						<br><label for="organizerName">ORGANIZER EMAIL</label>
						<input type="email" name="organizerEmail" id="organizerEmail" class="input-text" value="<?php echo $email ?>" <?php echo $edit ?>>
					</div>
					<div class="form-row">
						<br><label for="description" class="form-label">DESCRIPTION</label>
						<textarea class="form-control" name="description" id="description" rows="30" <?php echo $edit ?>><?php echo $desc ?></textarea>
					</div>
					<br>
					<p>ORGANIZER VERIFIED DOCUMENT</p>
					<center>
						<iframe src=<?php echo $docPath ?> width="600" height="500" id="target">
						</iframe><br><br><br><br>
					</center>
				<?php } ?>
				<?php
				if ($status == "pending") {
				?>
					<div>
						<center>
							<a href="pendingOrganizer.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="submit" name="reject" class="btn btn-danger">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="submit" name="approve" class="btn btn-success">Approve</button>
						</center>
					</div>
				<?php } else if ($status == "approved") {
				?>
					<div class="form-row">
						<br><br><label for="profile_picture">NEW PROFILE PICTURE *</label><br>
						<input type="file" name="profile_picture" id="profile_picture" accept="image/*">
					</div>
					<div class="form-row">
						<br><br><label for="verifiedDoc">NEW VERIFIED DOCUMENT *</label><br>
						<input type="file" name="verifiedDoc" id="verifiedDoc" accept="application/pdf, image/*">
						<br>
					</div>
					<div>
						<center>
							<a href="approvedOrganizer.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="submit" name="update" class="btn btn-success">Update</button></a>
						</center>
					</div>
				<?php } else {
				?>
					<div>
						<center>
							<a href="rejectedOrganizer.php" class="btn btn-primary">Back</a>
						</center>
					</div>
				<?php } ?>
			</form>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_POST["approve"])) {

	$update = "UPDATE organizer SET organizerStatus = 'approved' WHERE organizerID = '$organizerID'";
	$run_update = mysqli_query($conn, $update);

	if ($run_update == true) {
		echo "<script>alert('The organizer account has been created.')
			location = 'approvedOrganizer.php' </script>";
	} else {
		echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
	}
} else if (isset($_POST["reject"])) {
	$update = "UPDATE organizer SET organizerStatus = 'rejected' WHERE organizerID = '$organizerID'";
	$run_update = mysqli_query($conn, $update);

	if ($run_update == true) {
		echo "<script>alert('The application has been rejected.')
			location = 'rejectedOrganizer.php' </script>";
	} else {
		echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
	}
} else if (isset($_POST["update"])) {
	$newEmail = $_POST['organizerEmail'];
	$newName = $_POST['name'];
	$newDesc = $_POST['description'];
	if ($_FILES['profile_picture']['name'] == "" && $_FILES['verifiedDoc']['name'] == "") {
		$update = "UPDATE organizer SET organizerEmail = '$newEmail', organizerName = '$newName', organizerDesc = '$newDesc' WHERE organizerID = '$organizerID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Organizer profile updated successfully!')
				location = 'approvedOrganizer.php' </script>";
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else if ($_FILES['verifiedDoc']['name'] == "") {
		unlink($picPath);
		$newProfilePic = $_FILES['profile_picture']['name'];
		$tmp_name = $_FILES['profile_picture']['tmp_name'];

		$update = "UPDATE organizer SET organizerEmail = '$newEmail', organizerName = '$newName', organizerDesc = '$newDesc', organizerProfilePic = '$newProfilePic' WHERE organizerID = '$organizerID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Profile updated successfully.')
				location = 'approvedOrganizer.php' </script>";
			move_uploaded_file($tmp_name, "../materials/organizerPic/$newProfilePic");
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else if ($_FILES['profile_picture']['name'] == "") {
		unlink($docPath);
		$newDoc = $_FILES['verifiedDoc']['name'];
		$tmp_name = $_FILES['verifiedDoc']['tmp_name'];

		$update = "UPDATE organizer SET organizerEmail = '$newEmail', organizerName = '$newName', organizerDesc = '$newDesc', organizerVerifiedDoc = '$newDoc' WHERE organizerID = '$organizerID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Profile updated successfully.')
				location = 'approvedOrganizer.php' </script>";
			move_uploaded_file($tmp_name, "../materials/organizerDoc/$newDoc");
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else {
		$newProfilePic = $_FILES['profile_picture']['name'];
		$tmp_name = $_FILES['profile_picture']['tmp_name'];

		$update = "UPDATE organizer SET organizerEmail = '$newEmail', organizerName = '$newName', organizerDesc = '$newDesc', organizerProfilePic = '$newProfilePic' WHERE organizerID = '$organizerID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			unlink($picPath);
			move_uploaded_file($tmp_name, "../materials/organizerPic/$newProfilePic");
		}

		if ($_FILES['profile_picture']['name'] != "") {
			$newDoc = $_FILES['verifiedDoc']['name'];
			$tmp_name = $_FILES['verifiedDoc']['tmp_name'];

			$update2 = "UPDATE organizer SET organizerVerifiedDoc = '$newDoc' WHERE organizerID = '$organizerID'";
			$run_update2 = mysqli_query($conn, $update2);

			if ($run_update == true) {
				unlink($docPath);
				move_uploaded_file($tmp_name, "../materials/organizerDoc/$newDoc");
				echo "<script>alert('Profile updated successfully.')
					location = 'approvedOrganizer.php'
					</script>";
			} else {
				echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
			}
		}
	}
}
?>
<?php include("../admin/partials/footer.php") ?>