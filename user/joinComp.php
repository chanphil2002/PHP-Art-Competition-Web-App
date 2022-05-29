<?php 

    include ("partials/database.php");
    include ("partials/header.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ../general/registeredUserLogin.php");
    }else{
        $userEmail = $_SESSION["user"];
        $sql1 = "SELECT * FROM user WHERE userEmail = '$userEmail'";
        $res1 = mysqli_query($conn, $sql1);
        $userData = mysqli_fetch_assoc($res1);       
        $username = $userData["username"];
        $phone = $userData["phoneNum"];
    }

    if (isset($_GET["competition"])){
        $comp = $_GET["competition"];
        $sql2 = "SELECT * FROM competition WHERE compID = '$comp'";
        $res2 = mysqli_query($conn, $sql2);
        $compDetails = mysqli_fetch_assoc($res2);
        $compName = $compDetails["compName"];
        $compPic = $compDetails["compPic"];
        $entryNum = $compDetails["noOfEntries"];
    }

    if (isset($_POST['submit'])){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $title = $_POST['entryName'];
        $entry = $_FILES['entry']['name'];
	    $tmp_name = $_FILES['entry']['tmp_name'];
        $date = date("Y-m-d");

        $sql3 = "INSERT INTO entry (entryFile, title, compId, userEmail, phoneNum, submitDate) VALUES ('$entry', '$title', '$comp', '$userEmail', '$phone', '$date')";
        $res3 = mysqli_query($conn, $sql3);

        if ($res3){
            move_uploaded_file($tmp_name, "../materials/image/$entry");
            echo "<script>
            alert ('Entry Submitted Successfully!')
            location = 'homepage.php' 
            </script>";
        }else{
            echo "<script>alert ('Oops, something went wrong! Please submit your entry again.')</script>";
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
            <center><image src="../materials/image/<?php echo $compPic; ?>" style="width:120px;height:auto;" class="" alt="..."></center><br>
				<div class="form-row">
					<strong><h2 class="text-1"><?php echo $compName; ?></h2></strong>
					<br><br><br><br><br>

                    <label for="Email">EMAIL *</label>
					<input type="email" name="email" id="email" class="input-text" value="<?php echo $userEmail; ?>" readonly required>
				</div>
				<div class="form-row">
					<br><label for="username">USERNAME *</label>
					<input type="text" name="username" id="username" class="input-text" value="<?php echo $username; ?>" readonly required>
				</div>
                <div class="form-row">
					<br><label for="phone">PHONE NUMBER (xxx-xxxxxxx) *</label>
					<input type="text" name="phone" id="phone" class="input-text" value="<?php echo $phone; ?>" required>
				</div>
                <div class="form-row">
					<br><label for="entryName">ENTRY'S TITLE *</label>
					<input type="text" name="entryName" id="entryName" class="input-text" required>
				</div>
				<div class="form-row">
					<br><br><label for="entry">ENTRY FILE *</label><br>
					<input type="file" name="entry" id="entry" accept="image/*" required>
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