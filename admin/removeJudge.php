<?php
    session_start();

    include 'partials/database.php';

    // Click Remove/dustbin button

    if (isset($_GET['removeIC'])) {
        $removeIC = $_GET['removeIC'];
        
        $sql = "SELECT * FROM judge WHERE judgeIC= '$removeIC'";
        $result = mysqli_query($conn, $sql);
        $judgeInfo = mysqli_fetch_assoc($result);
        $img = $judgeInfo["judgeProfilePic"];
        $imgPath = ("../judge/judgeProfile/$img");
        unlink($imgPath);

        $delete = "DELETE FROM judge WHERE judgeIC ='$removeIC'";
        $run_delete = mysqli_query($conn,$delete);
        if($run_delete === true) {
            echo "<script>alert('The user has been removed successfully!')
            location = 'viewJudge.php'</script>";

        }else {
            echo "<script>alert('Failed, Please Try Again.')
            location = 'viewJudge.php'</script>";
    }
}       
?>