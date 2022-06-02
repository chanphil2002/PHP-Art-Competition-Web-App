<?php
    include ("partials/header.php");
    include ("partials/database.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ../general/registeredUserLogin.php");
    }

    if (isset($_GET["compID"])){
        $sql = "SELECT * FROM competition WHERE compID = '$_GET[compID]' ";
        $res = mysqli_query($conn, $sql);
        while ($comp = mysqli_fetch_assoc($res)){
            $cert = $comp["compCert"];
            $name = $comp["compName"];
        }
    }else{
        header("Location: myComp.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../admin/addJudge.css" />
</head>
<body>
    <br>
    <center>
        <h2 style="color:darkblue"><?php echo $name; ?></h2>
        <br>
		<iframe src="../materials/compCert/<?php echo $cert ?>" width="800" height="100%">
		</iframe><br><br>
        <a href="myComp.php"><button type="button" class="btn btn-success">Back to My Competitions</button></a>
	</center>
    <br>
</body>
</html>