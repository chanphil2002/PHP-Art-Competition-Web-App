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
<body class="form-v7">
    <br>
    <div class="page-content">
		        <div class="form-v7-content">
        <?php echo $name; ?>
    <br>
</body>
</html>