<?php include("../organizer/partials/header.php");


ob_start();
if (!isset($_SESSION["compID"])) {
    header("Location: ../organizer/orghome.php");
} else {
    $compID = $_SESSION['compID'];

    $getStatus = "SELECT status FROM competition WHERE compID = '$compID'";
    $res3 = mysqli_query($conn, $getStatus);
    while ($row3 = mysqli_fetch_assoc($res3)) {
        $status = $row3['status'];
    }

    $sql2 = "SELECT C.*, J.* FROM comp_judge C INNER JOIN judge J ON C.judgeIC = J.judgeIC AND C.compID = '$compID'";
    $res2 = mysqli_query($conn, $sql2);

    $sql4 = "SELECT COUNT(compID) AS 'num_of_judge' FROM comp_judge WHERE compID = '$compID'";
    $res4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($res4);
    $num_of_judge = $row4['num_of_judge'];
    
}

?>

<div class="mx-auto">
    <h2 class=" text-center"><b>Judges Allocation</b></h2>
    <div class="bg-info bg-opacity-10 border border-info border-start-5 rounded-circle">
        <h5 class="text-center text-dark">Competition ID: <?php echo $compID; ?></h5>
    </div>
    <br>
    <h5 class="ms-5 text-dark">Choose the existing judges or add a new judge for your competition (Max 5):</h5>
</div>

<div class="form-row">
    <?php
    if ($num_of_judge > 4) {
    ?>
        <div>
            <h5 class="text-danger text-center">You have reached the maximum amount of judges. </h5>
        </div>
    <?php } else {
    ?>
        <div class='d-flex'>
            <a class="btn btn-success btn-lg mx-auto px-5 mb-5" href="choosejudge.php" role="button"><i class="fa-solid fa-user-graduate me-2"></i>Choose Judges</a>
        </div>
    <?php } ?>
</div>


<div class="form-row">
    <?php
    if ($status == "Pending") {
    ?>
        <div>
            <a class="btn btn-outline-primary ms-5 mb-2" href="../organizer/newjudge.php" role="button"><i class="fa-solid fa-user-plus me-2"></i>Add New Judge</a>
        </div>
    <?php } else {
    ?>
        <div>
            <!-- <a class="btn btn-outline-primary ms-5 mb-2" href="../organizer/newjudge.php" role="button" disabled><i class="fa-solid fa-user-plus me-2"></i>Add New Judge</a> -->
        </div>
    <?php } ?>
</div>


<div class="album ">
    <div class="container mb-5 d-flex justify-content-center">

        <div class="row">



            <?php while ($row2 = mysqli_fetch_assoc($res2)) :
                $judgeIC = $row2['judgeIC'];
                $judgeName = $row2['judgeName'];
                $judgeEmail = $row2['judgeEmail'];
                $judgeBio = $row2['judgeBio'];
                $judgeProfilePic = $row2['judgeProfilePic'];
            ?>
                <div class="col-md-6 ">
                    <div class="card mb-4 shadow-sm p-3" style="min-width: 30rem;">

                        <div class="d-flex align-items-center">

                            <div class="image">
                                <img src="../materials/judgeProfilePic/<?php echo $judgeProfilePic; ?>" class="rounded" width="155">
                            </div>

                            <div class="ms-3 w-100">
                                <h3 class="mb-0 mt-0"><?php echo $judgeName; ?></h3>
                                <span class="text-secondary"> Judge IC: <?php echo $judgeIC; ?> </input></span>


                                <div class="p-2 mt-2 bg-secondary bg-info bg-opacity-25 d-flex justify-content-between rounded text-white stats">
                                    <div class="d-flex flex-column text-dark">
                                        <span class="articles">Email: </span>
                                        <span class="number1"><?php echo $judgeEmail; ?></span>

                                        <br>

                                        <span class="articles">Bio: </span>
                                        <span class="number1"><?php echo $judgeBio; ?></span>
                                    </div>
                                </div>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" id='judgeIC' name='judgeIC' value="<?php echo $judgeIC; ?>">
                                    <input type="hidden" id='compID' name='compID' value="<?php echo $compID; ?>">
                                    <div class="button mt-2 d-flex flex-row align-items-center mt-4">
                                        <button class="btn btn-sm btn-outline-danger w-100" name="remove" type="submit">Remove This Judge</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>




                </div>


            <?php

            endwhile; ?>

        </div>

    </div>

</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end me-5">
    <a class="btn btn-lg btn-outline-info ms-5 mb-3 rounded-start rounded-5 me-5 px-5 text-black py-2" href="selectedcriteria.php?compID=<?php echo $compID; ?>" role="button"><b>Continue &raquo;</b></a>
</div>



<?php
ob_start();

if (isset($_POST['remove'])) {
    $judgeIC = $_POST['judgeIC'];
    $compID = $_POST['compID'];

    $sql = "DELETE FROM comp_judge WHERE compID = $compID AND judgeIC = '$judgeIC'";

    $res = mysqli_query($conn, $sql);
    // if ($res) {
    //     echo "<script>alert('success');</script>";
    // } else {
    //     echo "<script>alert('wrong');</script>";
    // }

    if ($res == true) {
        $_SESSION['compID'] = $compID;
        echo $_SESSION['compID'];

        header("location:" . SITEURL . "organizer/selectedjudge.php");
    }
}
include("../organizer/partials/footer.php");
?>