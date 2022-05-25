<?php include ("../admin/partials/header.php");
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
		<center><h2>Competition Detail</h2></center>
	</strong>
</div>
<div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <?php
                    if (isset($_GET['selectedComp'])){
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

                        $sql2 = "SELECT organizerName FROM organizer WHERE organizerID = $organizerID";
                        $result2 = mysqli_query($conn, $sql2);
                        $organizerInfo = mysqli_fetch_assoc($result2);
                        $organizerName = $organizerInfo['organizerName'];

						if ($status == 'Approved'){
							$badge = "badge text-bg-success position-absolute top-0 end-0 larger-badge";
							$statusDisplay = "Approved";
						}else if($status == 'Pending') {
							$badge = "badge text-bg-warning position-absolute top-0 end-0";
							$statusDisplay = "Pending";
						}else {
							$badge = "badge text-bg-danger position-absolute top-0 end-0";
							$statusDisplay = "Rejected";
						}
                ?>
				<div class="form-row">
					<span class="<?php echo $badge?>"><?php echo $statusDisplay?></span>
					<label for="name">COMPETITION NAME</label>
					<input type="text" name="name" id="name" class="input-text" value= "<?php echo $name ?>" readonly>
				</div>
                <div class="form-row">
					<br><label for="organizerName">ORGANIZER NAME</label>
					<input type="text" name="organizerName" id="organizerName" class="input-text" value="<?php echo $organizerName ?>" readonly>
				</div>
                <div class="form-row">
					<br><label for="category">CATEGORY</label>
					<input type="text" name="category" id="category" class="input-text" value="<?php echo $category ?>" readonly>
				</div>
				<div class="form-row">
					<br><label for="description" class="form-label">DESCRIPTION</label>
					<textarea class="form-control" name="description" id="description" rows="30" readonly><?php echo $description ?></textarea>
				</div>
                <div class="form-row">
					<br><label for="rules" class="form-label">RULES</label>
					<textarea class="form-control" name="rules" id="rules" rows="30" readonly><?php echo $rules ?></textarea>
				</div>
                <div class="form-row">
					<br><label for="releaseDate">RELEASE DATE</label>
					<input type="date" name="releaseDate" id="releaseDate" class="input-text" value= "<?php echo $releaseDate ?>" readonly>
				</div>
                <div class="form-row">
					<label for="regisDeadline">REGISTRATION DEADLINE</label>
					<input type="date" name="regisDeadline" id="regisDeadline" class="input-text" value= "<?php echo $regisDeadline ?>" readonly>
				</div>
				<!-- <div class="form-row">
					<br><br><label for="profile_picture">PROFILE PICTURE *</label><br>
					<input type="file" name="profile_picture" id="profile_picture" accept="image/*">
					<br>
					<br>
					<br>
				</div> -->
                <?php } ?>
				<?php
					if($status == "Pending"){
				?>
				<div>
					<center>
						<a href="pendingComp.php" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" name="reject" class="btn btn-danger">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" name="approve" class="btn btn-success">Approve</button>
					</center>
				</div>
				<?php }else if($status == "Approved"){
				?>
				<div>
					<center>
						<a href="approvedComp.php" class="btn btn-primary">Back</a>
					</center>
				</div>
				<?php }else {
				?>
				<div>
					<center>
						<a href="rejectedComp.php" class="btn btn-primary">Back</a>
					</center>
				</div>
				<?php } ?>
			</form>
		</div>
	</div>
</body>
</html>
<?php 
	if (isset($_POST["approve"])){

		$update = "UPDATE competition SET status= 'Approved' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if($run_update == true){
			echo "<script>alert('The competition has been approved.')
			location = 'approvedComp.php' </script>";

		}else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	} else if (isset($_POST["reject"])){
		$update = "UPDATE competition SET status= 'Rejected' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

		if($run_update == true){
			echo "<script>alert('The competition has been rejected.')
			location = 'rejectedComp.php' </script>";

		}else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
	}
?>
<?php include ("../admin/partials/footer.php")?>