<?php include("../organizer/partials/header.php"); 

if (!isset($_SESSION["organizer"])){
    header("Location: ../general/otherRoleLogin.php");
}else{
    $sql = "SELECT * FROM organizer WHERE organizerEmail = '$_SESSION[organizer]' ";
    $res = mysqli_query($conn, $sql);
    while ($orgDetails = mysqli_fetch_assoc($res)){
        $organizerProfilePic = $orgDetails["organizerProfilePic"];
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
				<h2>Organizer's Profile</h2>
			</center>
		</strong>
	</div>

    <div class="page-content">
		<div class="form-v7-content">
			<form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <?php if ($organizerProfilePic != ""){ ?>
                <div class="form-row">
                    <center><div style="position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 2px solid #08007f;">
                        <image src="../materials/orgProfilePic/<?php echo $organizerProfilePic; ?>" style="width:100% ;height:auto;" class="" alt="...">
                    </div></center>
                </div><?php } ?>
                <div class="form-row">
					<br><label for="organizerName">NAME</label>
					<input type="text" name="organizerName" id="organizerName" class="input-text" value="<?php echo $organizerName; ?>" readonly required>
				</div>
                <div class="form-row">
					<br><label for="organizerEmail">EMAIL</label>
					<input type="text" name="organizerEmail" id="organizerEmail" class="input-text" value="<?php echo $organizerEmail; ?>" readonly required>
				</div>
                <div class = "form-row mb-5">
                    <br><label for="organizerDesc">DESCRIPTION</label>
					<textarea name="organizerDesc" id="organizerDesc" rows="5" class="form-control" readonly required><?php echo $organizerDesc; ?></textarea>
                </div>
                    <center>
                        <a href="../organizer/orghome.php" class="btn btn-outline-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="editOrgProfile.php"><button type="button" name="edit" class="btn btn-primary">Edit Information</button></a>
                    </center>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php include("../organizer/partials/footer.php"); ?>