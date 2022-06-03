<?php
    include ("partials/header.php");
    include ("partials/database.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header ("Location: ../general/registeredUserLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../admin/addJudge.css">

</head>
<body class="form-v7">
    <div class="page-content">
        <div class="form-v7-content">
            <form class="form-detail" action="#" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-row">
					<strong>
						<h2 class="text-1">Feedback</h2>
					</strong>
					<br><br><br><br><br><label for="ic">IDENTITY CARD NUMBER *</label>
					<input type="text" name="ic" placeholder="xxxxxx-xx-xxxx" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" id="ic" class="input-text" required>
				</div>
    
</body>
</html>

<?php include ("partials/footer.php"); ?>