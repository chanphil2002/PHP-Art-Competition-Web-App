<?php include ("../organizer/partials/header.php");

    
ob_start();
    $compID = $_SESSION['compID'];
    $sql1 = "SELECT * FROM comp_judge WHERE compID = '$compID'";
    $sql2 = "SELECT * FROM judge";
    $res2 = mysqli_query($conn, $sql2);
?>

<div class="mx-auto" >
    <h2 class="pt-5 text-center"><b><u>Existing Judges</u></b></h2>
</div>

<h5 class="text-dark ms-5">Choose your desired judges:</h5>

<div class="album ">
<div class="container mb-5 d-flex justify-content-center">

<div class="row">


    
<?php while($row2 = mysqli_fetch_assoc($res2)):
    $judgeIC = $row2['judgeIC'];
    $judgeName = $row2['judgeName'];
    $judgeEmail = $row2['judgeEmail'];
    $judgeBio = $row2['judgeBio'];
    $judgeProfilePic = $row2['judgeProfilePic'];
    ?>
    <div class="col-md-6 ">
        <div class="card mb-4 shadow-sm p-3">

            <div class="d-flex align-items-center">

                <div class="image">
                    <img src="../admin/judgeProfile/<?php echo $judgeProfilePic; ?>" class="rounded" width="155" >
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
                        <input type="hidden" id='judgeIC' name='judgeIC' value= "<?php echo $judgeIC;?>">
                        <input type="hidden" id='compID' name='compID' value= "<?php echo $compID;?>">
                        <div class="button mt-2 d-flex flex-row align-items-center mt-4">
                            <a href=""></a>
                            <button class="btn btn-sm btn-outline-info w-100" name="submit" type="submit"> <b>Appoint This Judge</b> </button>  
                        </div>
                    </form>
                </div>

            </div>
            
        </div>
    
        

        
</div>
<?php
ob_start();

if(isset($_POST['submit']))
{
    $judgeIC = $_REQUEST['judgeIC'];
    $compID = $_REQUEST['compID'];

    $sql = "INSERT INTO comp_judge(compID, judgeIC) VALUES ($compID, '$judgeIC')";

    // $sql = "INSERT INTO comp_judge SET
    //     compID = $compID,
    //     judgeIC = '$judgeIC'";

    $res = mysqli_query($conn,$sql);
    // if ($res) {
    //     echo "<script>alert('success');</script>";
    // } else {
    //     echo "<script>alert('wrong');</script>";
    // }

    if($res == true)
    {   
        $_SESSION['compID'] = $compID;
        echo $_SESSION['compID'];
        
        header("location:" . SITEURL . "organizer/selectedjudge.php");
    }

}
endwhile; ?>

</div>

</div>
</div>


<?php
include("../organizer/partials/footer.php");
?>
