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
	<title>Competition Detail</title>
	<link rel="stylesheet" href="addJudge.css" />

	<style>
		.container {
		position: relative;
		width: 100%;
		overflow: hidden;
		padding-top: 62.5%; /* 8:5 Aspect Ratio */
		}
		.responsive-iframe {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		width: 100%;
		height: 100%;
		border: none;
		}
	</style>
</head>

<body class="form-v7">
	<div>
		<strong>
			<br>
			<center>
				<h2>Competition Detail</h2>
			</center>
		</strong>
	</div>
	<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
				<?php
				if (isset($_GET['selectedComp'])) {
					$compID = $_GET['selectedComp'];

					$sql = "SELECT * FROM competition WHERE compID = '$compID'";
					$result = mysqli_query($conn, $sql);
					$compInfo = mysqli_fetch_assoc($result);
					$name = $compInfo['compName'];
					$organizerID = $compInfo['organizerID'];
					$status = $compInfo['status'];
					$description = $compInfo['description'];
					$rules = $compInfo['rules'];
					$category = $compInfo["category"];
					$releaseDate = $compInfo['releaseDate'];
					$regisDeadline = $compInfo['registrationDeadline'];
					$evaluation = $compInfo['evaluationDays'];
					$judgeScore = $compInfo['judgeScore'];
					$publicVote = $compInfo['publicVote'];
					$prizePool = $compInfo['prizePool'];
					$receipt = $compInfo['receipt'];
					$receiptPath = ("../materials/compReceipt/$receipt");
					$compPic = $compInfo['compPic'];
					$reason = $compInfo['rejectedComment'];

					$sql2 = "SELECT organizerName FROM organizer WHERE organizerID = $organizerID";
					$result2 = mysqli_query($conn, $sql2);
					$organizerInfo = mysqli_fetch_assoc($result2);
					$organizerName = $organizerInfo['organizerName'];

					if ($status == 'Upcoming') {
						$badge = "badge text-bg-success position-absolute top-0 end-0 larger-badge";
						$statusDisplay = "Upcoming";
						$update = "required";
						$date = "required";
					} else if ($status == 'Pending') {
						$badge = "badge text-bg-warning position-absolute top-0 end-0";
						$statusDisplay = "Pending";
						$update = "readonly";
						$date = "readonly";
					} else if ($status == 'On-Going') {
						$badge = "badge text-bg-success position-absolute top-0 end-0";
						$statusDisplay = "On-Going";
						$update = "required";
						$date = "readonly";
					} else if ($status == 'Past') {
						$badge = "badge text-bg-dark position-absolute top-0 end-0";
						$statusDisplay = "Past";
						$update = "readonly";
						$date = "readonly";
					} else if ($status == 'Terminated') {
						$badge = "badge text-bg-secondary position-absolute top-0 end-0";
						$statusDisplay = "Terminated";
						$update = "readonly";
						$date = "readonly";
					} else {
						$badge = "badge text-bg-danger position-absolute top-0 end-0";
						$statusDisplay = "Rejected";
						$update = "readonly";
						$date = "readonly";
					}
				?>
					<center>
						<div>
							<img style="width:90%" src="../materials/compPic/<?php echo $compPic; ?>"><br><br><br>
						</div>
					</center>
					<div class="form-row">
						<span class="<?php echo $badge ?>"><?php echo $statusDisplay ?></span>
						<label for="name">COMPETITION ID</label>
						<input type="text" name="id" id="id" class="input-text" value="<?php echo $compID ?>" readonly>
					</div>
					<div class="form-row">
						<label for="name">COMPETITION NAME</label>
						<input type="text" name="name" id="name" class="input-text" value="<?php echo $name ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<br><label for="organizerName">ORGANIZER NAME</label>
						<input type="text" name="organizerName" id="organizerName" class="input-text" value="<?php echo $organizerName ?>" readonly>
					</div>
					<!-- <div class="form-row">
						<br><label for="category">CATEGORY</label>
						<input type="text" name="category" id="category" class="input-text" value="<?php echo $category ?>" <?php echo $update ?>>
					</div> -->
					<?php
					if ($category == "Photography") {
					?>
						<div class="form-row">
							<label for="category">Category *</label>
							<select class="form-row" name="category" id="category" style="height: 25px; margin-top: 3%;" <?php echo $update ?>>
								<option value="">Choose a category *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="Photography" selected>Photography</option>
								<option value="Paintings">Paintings</option>
								<option value="2D">2D</option>
								<option value="3D">3D</option>
							</select>
						</div>
					<?php } else if ($category == 'Paintings') { ?>
						<div class="form-row">
							<label for="category">Category *</label>
							<select class="form-row" name="category" id="category" style="height: 25px; margin-top: 3%;" <?php echo $update ?>>
								<option value="">Choose a category *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="Photography">Photography</option>
								<option value="Paintings" selected>Paintings</option>
								<option value="2D">2D</option>
								<option value="3D">3D</option>
							</select>
						</div>
					<?php } else if ($category == '2D') { ?>
						<div class="form-row">
							<label for="category">Category *</label>
							<select class="form-row" name="category" id="category" style="height: 25px; margin-top: 3%;" <?php echo $update ?>>
								<option value="">Choose a category *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="Photography">Photography</option>
								<option value="Paintings">Paintings</option>
								<option value="2D" selected>2D</option>
								<option value="3D">3D</option>
							</select>
						</div>
					<?php } else if ($category == '3D') { ?>
						<div class="form-row">
							<label for="category">Category *</label>
							<select class="form-row" name="category" id="category" style="height: 25px; margin-top: 3%;" <?php echo $update ?>>
								<option value="">Choose a category *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option value="Photography">Photography</option>
								<option value="Paintings">Paintings</option>
								<option value="2D">2D</option>
								<option value="3D" selected>3D</option>
							</select>
						</div>
					<?php } ?>
					<div class="form-row">
						<br><label for="description" class="form-label">DESCRIPTION</label>
						<textarea class="form-control" name="description" id="description" rows="30" <?php echo $update ?>><?php echo $description ?></textarea>
					</div>
					<div class="form-row">
						<br><label for="rules" class="form-label">RULES</label>
						<textarea class="form-control" name="rules" id="rules" rows="30" <?php echo $update ?>><?php echo $rules ?></textarea>
					</div>
					<div class="form-row">
						<br><label for="releaseDate">RELEASE DATE</label>
						<input type="date" name="releaseDate" id="releaseDate" class="input-text" value="<?php echo $releaseDate ?>" <?php echo $date ?>>
					</div>
					<div class="form-row">
						<label for="regisDeadline">REGISTRATION DEADLINE</label>
						<input type="date" name="regisDeadline" id="regisDeadline" class="input-text" value="<?php echo $regisDeadline ?>" <?php echo $date ?>>
					</div>
					<div class="form-row">
						<label for="evaluation">EVALUATION DAY</label>
						<input type="number" name="evaluation" id="evaluation" class="input-text" value="<?php echo $evaluation ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<label for="judgeScore">JUDGE SCORE (%)</label>
						<input type="number" name="judgeScore" id="judgeScore" class="input-text" value="<?php echo $judgeScore ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<label for="vote">PUBLIC VOTE (%)</label>
						<input type="number" name="vote" id="vote" class="input-text" value="<?php echo $publicVote ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<br><label for="prize" class="form-label">PRIZE POOL</label>
						<input type="text" name="prize" id="prize" class="input-text" value="<?php echo $prizePool ?>" <?php echo $update ?>>
					</div>
					<P>JUDGE ASSIGNED</p>
					<div class="row row-cols-1 row-cols-md-2 g-4">
						<?php
						$sql4 = "SELECT judgeIC FROM comp_judge WHERE compID = '$compID'";
						$result4 = mysqli_query($conn, $sql4);
						if (mysqli_num_rows($result4) == 0) {
							echo "<p>No judge has been assigned to this competition yet.</p><br><br>";
						} else {
							while ($judgeAssigned = mysqli_fetch_assoc($result4)) {
								$judgeIC = $judgeAssigned['judgeIC'];

								$sql5 = "SELECT * FROM judge WHERE judgeIC = '$judgeIC'";
								$result5 = mysqli_query($conn, $sql5);
								while ($info = mysqli_fetch_assoc($result5)) {
									$judgeName = $info['judgeName'];
									$judgeEmail = $info['judgeEmail'];
									$judgePic = $info['judgeProfilePic'];
									$judgeBio = $info['judgeBio'];
									$path = ("../materials/judgeProfilePic/$judgePic");

									if (isset($_POST["approve"])) {
										$createJudge = "UPDATE judge SET status='Approved' WHERE judgeIC = '$judgeIC'";
										$run_create = mysqli_query($conn, $createJudge);
									}
						?>
									<div class="col">
										<div class="card">
											<img src=<?php echo $path ?> class="card-img-top">
											<div class="card-body">
												<h5 class="card-title" style="color: black;"><?php echo $judgeName ?></h5>
												<p class="card-text">IC: <?php echo $judgeIC ?> </p>
												<p class="card-text">Email: <?php echo $judgeEmail ?> </p>
												<p class="card-text">Bio: <?php echo $judgeBio ?> </p>
											</div>
										</div>
									</div>
						<?php }
							}
						} ?>
					</div>
					<div class="form-row">
						<br><br>
						<p>PAYMENT RECEIPT</p>
						<?php
						if ($receipt == "") {
							echo "<p>No Payment Received Yet.</p><br><br>";
						} else {
						?>
						<div class="container"> 
							<center>
								<iframe class="responsive-iframe" src=<?php echo $receiptPath ?> width="600" height="500">
								</iframe>
							</center>
						</div><br><br><br><br>
					<?php }
					} ?>
					</div>
					<!-- display button according to competition status -->
					<div class="form-row">
						<?php
						if ($status == "Pending") {
						?>
							<div>
								<center>
									<a href="pendingComp.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="rejectCompReason.php?selectedComp=<?php echo $compID ?>" class="btn btn-danger">Reject</a>&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="submit" name="approve" class="btn btn-success">Approve</button>
								</center>
							</div>
						<?php } else if ($status == "Upcoming") {
						?>
							<div>
								<div class="form-row">
									<label for="compPic">NEW COMPETITION PICTURE *</label><br>
									<input type="file" name="compPic" id="compPic" accept="image/*"><br><br>
								</div>
								<center>
									<a href="approvedComp.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="submit" name="update" class="btn btn-success">Update</button></a>
								</center>
							</div>
						<?php } else if ($status == "On-Going") {
						?>
							<div>
								<div class="form-row">
									<label for="compPic">NEW COMPETITION PICTURE *</label><br>
									<input type="file" name="compPic" id="compPic" accept="image/*"><br><br>
								</div>
								<center>
									<a href="onGoingComp.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="submit" name="update" class="btn btn-success">Update</button></a>
								</center>
							</div>
						<?php } else if ($status == "Past") {
						?>
							<div>
								<center>
									<a href="pastComp.php" class="btn btn-primary">Back</a>
								</center>
							</div>
						<?php } else if ($status == "Rejected") {
						?>
							<div class="form-row">
								<br><label for="reason" class="form-label">REASON OF REJECTION</label>
								<textarea class="form-control" name="reason" id="reason" rows="10" readonly ><?php echo $reason ?></textarea>
							</div><br><br>
							<div>
								<center>
									<a href="rejectedComp.php" class="btn btn-primary">Back</a>
								</center>
							</div>
						<?php } else {
						?>
							<div>
								<center>
									<a href="terminatedComp.php" class="btn btn-primary">Back</a>
								</center>
							</div>
						<?php } ?>
					</div>
			</form>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_POST["approve"])) {

	$update = "UPDATE competition SET status= 'Upcoming' WHERE compID = '$compID'";
	$run_update = mysqli_query($conn, $update);

	if ($run_update == true && $run_create == true) {
		echo "<script>alert('The competition has been approved.')
			location = 'approvedComp.php' </script>";
	} else {
		echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
	}
} else if (isset($_POST["reject"])) {
	$update = "UPDATE competition SET status= 'Rejected' WHERE compID = '$compID'";
	$run_update = mysqli_query($conn, $update);

	if ($run_update == true && $deleteJudge == true) {
		echo "<script>alert('The competition has been rejected.')
			location = 'rejectCompReason.php?selectedComp=<?php echo $compID?>' </script>";
	} else {
		echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
	}
} else if (isset($_POST['update'])) {
	$newCompName = $_POST['name'];
	$newCategory = $_POST['category'];
	$newDesc = $_POST['description'];
	$newRules = $_POST['rules'];
	$newRelese = $_POST['releaseDate'];
	$newDeadline = $_POST['regisDeadline'];
	$newEvaluate = $_POST['evaluation'];
	$newJudgeScore = $_POST['judgeScore'];
	$newPublic = $_POST['vote'];
	$newPrize = $_POST['prize'];

	$sql = "SELECT * FROM competition WHERE compID = '$compID'";
	$compPic = $compInfo['compPic'];
	$picPath = "../materials/compPic/$compPic";

	if ($_FILES['compPic']['name'] == "") {
		$update = "UPDATE competition SET compName = '$newCompName', description = '$newDesc', rules = '$newRules',
			category = '$newCategory', releaseDate = '$newRelese', registrationDeadline = '$newDeadline', evaluationDays = '$newEvaluate',
			judgeScore = '$newJudgeScore', publicVote = '$newPublic', prizePool = '$newPrize' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Competition information updated successfully!')
				location = 'viewCompDetails.php?selectedComp=$compID' </script>";
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else {
		$compPic = $_FILES['compPic']['name'];
		$tmp_name = $_FILES['compPic']['tmp_name'];

		$update = "UPDATE competition SET compName = '$newCompName', description = '$newDesc', rules = '$newRules',
			category = '$newCategory', releaseDate = '$newRelese', registrationDeadline = '$newDeadline', evaluationDays = '$newEvaluate',
			judgeScore = '$newJudgeScore', publicVote = '$newPublic', prizePool = '$newPrize', compPic = '$compPic' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			unlink($picPath);
			move_uploaded_file($tmp_name, "../materials/compPic/$compPic");
			echo "<script>alert('Profile updated successfully.')
				location = 'viewCompDetails.php?selectedComp=$compID' </script>";

		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	}
}
?>
<?php include("../admin/partials/footer.php") ?>