<?php
    session_start();

    include 'partials/database.php';

    // Click Remove/dustbin button

    if (isset($_GET['removeEmail'])) {
        $removeEmail = $_GET['removeEmail'];
        
        // $sql = "SELECT * FROM user WHERE userEmail = '$removeEmail'";
        // $result = mysqli_query($conn, $sql);
        // $userInfo = mysqli_fetch_assoc($result);
        // $img = $userInfo["judgeProfilePic"];
        // $imgPath = ("judgeProfile/$img");
        // unlink($imgPath);

        $delete = "DELETE FROM user WHERE userEmail ='$removeEmail'";
        $run_delete = mysqli_query($conn,$delete);
        if($run_delete == true) {
            echo "<script>alert('The user has been removed successfully!')
            location = 'viewUser.php'</script>";

        }else {
            echo "<script>alert('Failed, Please Try Again.')
            location = 'viewUser.php'</script>";
    }
}       
?>