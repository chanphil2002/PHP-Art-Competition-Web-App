<?php include ("../admin/partials/header.php");

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Judge Page</title>
    <link rel="stylesheet" href="view.css"/>
</head>
<body>
    <div>
        <strong>
            <center><h2>Judge</h2></center><br>
        </strong>
    </div>
    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>IC</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sum = 0;
                    $sql = "SELECT * FROM judge";
                    $result = mysqli_query($conn, $sql); 
                    while($row_judge = mysqli_fetch_assoc($result)){
                        $ic = $row_judge['judgeIC'];
                        $name = $row_judge['judgeName'];
                        $email = $row_judge['judgeEmail'];
                        $sum = $sum + $count;
                ?>
                <tr>
                    <td data-label="No"><?php echo $sum?></td>
                    <td data-label="IC"><?php echo $ic?></td>
                    <td data-label="Name"><?php echo $name?></td>
                    <td data-label="Email"><?php echo $email?></td>
                    <td data-label="Action">
                        <a href="viewJudgeDetails.php?selectedIC=<?php echo $ic?>"><i class="fa-solid fa-eye"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="removeJudge.php?removeIC=<?php echo $ic?>"><i class='fas fa-trash-alt' style='color:red'></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>