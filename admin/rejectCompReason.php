<?php include ("../admin/partials/header.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reason of Rejection</title>
    <link rel="stylesheet" href="addJudge.css" />
</head>
<body class="form-v7">
	<div>
    <strong>
        <br><center><h2>Reason of Rejection</h2></center>
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
                        $row_comp = mysqli_fetch_assoc($result);
                        $status = $row_comp['status'];
                        $reason = $row_comp['rejectedComment'];
                ?>
                <div class="form-row">
					<br><label for="reason" class="form-label">Reason of Rejection</label>
					<textarea class="form-control" name="reason" id="reason" rows="30" required></textarea>
				</div>
                <div>
					<center>
                    <br><br><a href="viewCompDetails.php?selectedComp=<?php echo $compID?>" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" name="submit" class="btn btn-success">Submit</button></a>
					</center>
				</div>
            </form>
        </div>
        <?php }?>
<?php include ("../admin/partials/footer.php")?>
<?php 
    if (isset($_POST["submit"])){
        $reason = $_POST['reason'];
		$update = "UPDATE competition SET status= 'Rejected', rejectedComment = '$reason' WHERE compID = '$compID'";
		$run_update = mysqli_query($conn, $update);

        $select = "SELECT judgeIC FROM comp_judge WHERE compID = '$compID'";
        $result = mysqli_query($conn, $select);
        $judgeAssigned = mysqli_fetch_assoc($result);
        $judgeIC = $judgeAssigned['judgeIC'];

		if($run_update == true && $run_delete == true){
			echo "<script>alert('The competition has been rejected.')
			location = 'rejectedComp.php' </script>";

		}else {
			echo "<script>alert('Oops! Something went wrong, please try again.')</script>";
		}
    }
?>