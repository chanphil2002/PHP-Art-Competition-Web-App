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
            <br><center><h2>Users</h2></center><br>
        </strong>
    </div>
    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>DoB</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sum = 0;
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($conn, $sql); 
                    while($row_user = mysqli_fetch_assoc($result)){
                        $username = $row_user['username'];
                        $email = $row_user['userEmail'];
                        $dob = $row_user['DoB'];
                        $gender = $row_user['gender'];
                        $phone = $row_user['phoneNum'];
                        $sum = $sum + $count;
                ?>
                <tr>
                    <td data-label="No"><?php echo $sum?></td>
                    <td data-label="username"><?php echo $username?></td>
                    <td data-label="email"><?php echo $email?></td>
                    <td data-label="dob"><?php echo $dob?></td>
                    <td data-label="gender"><?php echo $gender?></td>
                    <td data-label="phone"><?php echo $phone?></td>
                    <td data-label="Action">
                        <a href="editUser.php?editEmail=<?php echo $email?>"><i class="fa-solid fa-pen"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="viewUser.php?removeEmail=<?php echo $email?>"><i class='fas fa-trash-alt' style='color:red'></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>
<?php 
if (isset($_GET['removeEmail'])) {
    $removeEmail = $_GET['removeEmail'];
    
    $sql = "SELECT * FROM user WHERE userEmail = '$removeEmail'";
    $result = mysqli_query($conn, $sql);
    $userInfo = mysqli_fetch_assoc($result);
    $img = $userInfo["userProfilePic"];
    $imgPath = ("../materials/userPic/$img");

    $delete = "DELETE FROM user WHERE userEmail ='$removeEmail'";
    $run_delete = mysqli_query($conn,$delete);
    if($run_delete == true) {
        echo "<script>alert('The user has been removed successfully!')
        location = 'viewUser.php'</script>";
        unlink($imgPath);

    }else {
        echo "<script>alert('Failed, Please Try Again.')
        location = 'viewUser.php'</script>";
}
}       
?>