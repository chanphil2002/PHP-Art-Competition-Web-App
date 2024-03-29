<?php include ("../admin/partials/header.php");

if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
}
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
            <br><center><h2>Judge</h2></center><br>
        </strong>
    </div>
    <div>
        <a href="addJudge.php" class="btn btn-success" style="float: right; margin-right:2%; margin-bottom: 1%;"><i class="fa-solid fa-plus"></i>  Add New Judge</a>
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
                    $sql = "SELECT * FROM judge WHERE status != 'Terminated' AND status != 'Pending'";
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
                        <a href="viewJudgeDetails.php?selectedIC=<?php echo $ic?>"><i class="fa-solid fa-pen"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="viewJudge.php?removeIC=<?php echo $ic?>"><i class='fas fa-trash-alt' style='color:red'></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    if (isset($_GET['removeIC'])) {
        $removeIC = $_GET['removeIC'];

        $update = "UPDATE judge SET status = 'Terminated' WHERE judgeIC ='$removeIC'";
        $run_update = mysqli_query($conn, $update);
        if($run_update == true) {
            echo "<script>alert('The judge has been removed successfully!')
            location = 'viewJudge.php'</script>";

        }else {
            echo "<script>alert('Failed, Please Try Again.')
            location = 'viewJudge.php'</script>";
    }
}       
?>
<?php include("partials/footer.php"); ?>