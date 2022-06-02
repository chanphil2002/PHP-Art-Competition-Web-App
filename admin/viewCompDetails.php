<?php include("../admin/partials/header.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Competition Detail</title>
	<link rel="stylesheet" href="addJudge.css" />
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
					$compPic = $compInfo['compPic'];
					$receipt = $compInfo['receipt'];
					$receiptPath = ("../materials/compReceipt/$receipt");
					$compPic = $compInfo['compPic'];
					$picPath = ("../materials/compPic/$compPic");

					$sql2 = "SELECT organizerName FROM organizer WHERE organizerID = $organizerID";
					$result2 = mysqli_query($conn, $sql2);
					$organizerInfo = mysqli_fetch_assoc($result2);
					$organizerName = $organizerInfo['organizerName'];

					if ($status == 'Upcoming') {
						$badge = "badge text-bg-success position-absolute top-0 end-0 larger-badge";
						$statusDisplay = "Upcoming";
						$update = "required";
					} else if ($status == 'Pending') {
						$badge = "badge text-bg-warning position-absolute top-0 end-0";
						$statusDisplay = "Pending";
						$update = "readonly";
					} else if ($status == 'On-Going') {
						$badge = "badge text-bg-success position-absolute top-0 end-0";
						$statusDisplay = "On-Going";
						$update = "required";
					} else if ($status == 'Pass') {
						$badge = "badge text-bg-secondary position-absolute top-0 end-0";
						$statusDisplay = "Pass";
						$update = "readonly";
					} else {
						$badge = "badge text-bg-danger position-absolute top-0 end-0";
						$statusDisplay = "Rejected";
						$update = "readonly";
					}
				?>
					<center>
						<div>
							<img src=<?php echo $picPath ?> style="width: 10rem;"><br><br><br>
						</div>
					</center>
					<div class="form-row">
						<span class="<?php echo $badge ?>"><?php echo $statusDisplay ?></span>
						<label for="name">COMPETITION ID</label>
						<input type="text" name="id" id="id" class="input-text" value="<?php echo $compID ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<label for="name">COMPETITION NAME</label>
						<input type="text" name="name" id="name" class="input-text" value="<?php echo $name ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<br><label for="organizerName">ORGANIZER NAME</label>
						<input type="text" name="organizerName" id="organizerName" class="input-text" value="<?php echo $organizerName ?>" readonly>
					</div>
					<div class="form-row">
						<br><label for="category">CATEGORY</label>
						<input type="text" name="category" id="category" class="input-text" value="<?php echo $category ?>" <?php echo $update ?>>
					</div>
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
						<input type="date" name="releaseDate" id="releaseDate" class="input-text" value="<?php echo $releaseDate ?>" <?php echo $update ?>>
					</div>
					<div class="form-row">
						<label for="regisDeadline">REGISTRATION DEADLINE</label>
						<input type="date" name="regisDeadline" id="regisDeadline" class="input-text" value="<?php echo $regisDeadline ?>" <?php echo $update ?>>
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
							<center>
								<iframe src=<?php echo $receiptPath ?> width="600" height="500">
								</iframe><br><br><br><br>
							</center>
					<?php }
					} ?>
					</div>
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
						<?php } else if ($status == "Pass") {
						?>
							<div>
								<center>
									<a href="passComp.php" class="btn btn-primary">Back</a>
								</center>
							</div>
						<?php } else {
						?>
							<div>
								<center>
									<a href="rejectedComp.php" class="btn btn-primary">Back</a>
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
	$organizer = $_POST['organizerName'];
	$newCategory = $_POST['category'];
	$newDesc = $_POST['description'];
	$newRules = $_POST['rules'];
	$newRelese = $_POST['releaseDate'];
	$newDeadline = $_POST['regisDeadline'];
	$newEvaluate = $_POST['evaluation'];
	$newJudgeScore = $_POST['judgeScore'];
	$newPublic = $_POST['vote'];
	$newPrize = $_POST['prize'];

	$sql3 = "SELECT * FROM organizer WHERE organizerName = '$organizer'";
	$result3 = mysqli_query($conn, $sql3);
	$organizerInfo = mysqli_fetch_assoc($result3);
	$newID = $organizerInfo['organizerID'];

	if ($_FILES['compPic']['name'] == "") {
		$update = "UPDATE competition SET compName = '$newCompName', organizerID = '$newID', description = '$newDesc', rules = '$newRules',
			category = '$newCategory', releaseDate = '$newRelese', registrationDeadline = '$newDeadline', evaluationDays = '$newEvaluate',
			judgeScore = '$newJudgeScore', publicVote = '$newPublic', prizePool = '$newPrize' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Competition information updated successfully!')
				location = 'approvedComp.php' </script>";
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else {
		unlink($picPath);
		$newCompPic = $_FILES['compPic']['name'];
		$tmp_name = $_FILES['compPic']['tmp_name'];

		$update = "UPDATE competition SET compName = '$newCompName', organizerID = '$newID', description = '$newDesc', rules = '$newRules',
			category = '$newCategory', releaseDate = '$newRelese', registrationDeadline = '$newDeadline', evaluationDays = '$newEvaluate',
			judgeScore = '$newJudgeScore', publicVote = '$newPublic', prizePool = '$newPrize', compPic = '$newCompPic' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if ($run_update == true) {
			echo "<script>alert('Profile updated successfully. Yeah')
				location = 'approvedComp.php' </script>";
			move_uploaded_file($tmp_name, "../materials/image/$newCompPic");
		} else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	}
}
?>
<?php include("../admin/partials/footer.php") ?>