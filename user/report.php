<?php
    include ("partials/header.php");
    include ("partials/database.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header ("Location: ../general/registeredUserLogin.php");
    }

    if (isset($_GET["entryID"])){
        $sql = "SELECT * FROM entry E INNER JOIN competition C ON E.compID = C.compID WHERE entryID = '$_GET[entryID]' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $id = $res["entryID"];
            $title = $res["title"];
            $author = $res["userEmail"];
            $pic = $res["entryFile"];
            $path = "../materials/entries/$pic";
            $compID = $res["compID"];
            $orgID = $res["organizerID"];
        }
    }else {
        header("Location: allComp.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../admin/addJudge.css">

</head>
<body class="form-v7">
    <div class="page-content">
        <div class="form-v7-content">
            <form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-row">
					<strong>
						<h2 class="text-1" style="text-decoration: underline">Report Plagiarism</h2>
					</strong>
                    <br><br><br><br>
                    <center>
                    <image src="<?php echo $path; ?>" style="width:250px;height:auto;" class="" alt="...">
                    <br><br>
                    <p name="title"><?php echo $title; ?></label>
                    </center><br>
                    <label for = "id">ENTRY ID: <?php echo $id; ?></label><br>
                </div>
                <div class="form-row">                
                    <label for="email">SUBMITTED BY: <?php echo $author; ?></label>
                </div>
                <div class="form-row">
					<br><label for="report">REPORT REASON & PLAGIARISM EVIDENCE *</label>
					<textarea class="form-control" name="report" id="report" rows="5" required></textarea>
				</div><br><br><br>
                <div>
                    <center>
                        <a href="entry.php?entryID=<?php echo $id; ?>&compID=<?php echo $compID; ?>" class="btn btn-primary">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="submit" class="btn btn-success">Submit Report</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>

<?php
    if (isset($_POST["submit"])){
        $type = "Entry";
        $desc = $_POST["report"];
        $status = "unresolved";
        $user = $_SESSION["user"];

        $sql = "INSERT INTO feedback (feedbackType, description, entryID, compID, userEmail, organizerID, status) VALUES ('$type', '$desc', '$id', '$compID', '$user', '$orgID', '$status') ";
        $res = mysqli_query($conn, $sql);    

        if ($res){
            echo "<script>alert ('Report submitted successfully!') 
            location = 'homepage.php' </script>";
        }else {
            echo "<script>alert ('Oops, something went wrong. Please try again.') </script>";
        }
    }
?>

<?php include ("partials/footer.php"); ?>