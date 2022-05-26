<?php include ("../organizer/partials/header.php");

    
ob_start();
    $compID = $_SESSION['compID'];
    $sql1 = "SELECT * FROM comp_judge WHERE compID = '$compID'";
    $sql2 = "SELECT * FROM judge";
    $res2 = mysqli_query($conn, $sql2);


?>

<div class="mx-auto" >
        <h2 class="pt-5 ms-5 text-center">Existing Judges</h2>
    </div>
<div class="container my-5 d-flex justify-content-center">
    
    <?php while($row2 = mysqli_fetch_assoc($res2)):
        $judgeIC = $row2['judgeIC'];
        $judgeName = $row2['judgeName'];
        $judgeEmail = $row2['judgeEmail'];
        $judgeBio = $row2['judgeBio'];
        $judgeProfilePic = $row2['judgeProfilePic'];
        ?>

        <div class="card p-3 me-5 col-md-6">

            <div class="d-flex align-items-center">

                <div class="image">
            <img src="../materials/judgeProfilePic/<?php echo $judgeProfilePic; ?>" class="rounded" width="155" >
            </div>

            <div class="ms-3 w-100">
                
                <h3 class="mb-0 mt-0"><?php echo $judgeName; ?></h3>
                <span class="text-secondary">Judge IC: <?php echo $judgeIC; ?></span>

                <div class="p-2 mt-2 bg-secondary bg-info bg-opacity-25 d-flex justify-content-between rounded text-white stats">

                <div class="d-flex flex-column text-dark">

                        <span class="articles">Email: </span>
                        <span class="number1"><?php echo $judgeEmail; ?></span>
                        <br>

                        <span class="articles">Bio: </span>
                        <span class="number1"><?php echo $judgeBio; ?></span>
                        
                </div>

                <!-- <div class="d-flex flex-column">

                        <span class="articles">Bio: </span>
                        <span class="number1"><?php echo $judgeBio; ?></span>
                        
                    </div> -->
                    

                </div>


                <div class="button mt-2 d-flex flex-row align-items-center mt-4">

                <button class="btn btn-sm btn-outline-info w-100">Appoint This Judge</button>

                    
                </div>


            </div>

                
            </div>
            
        </div>
    <?php endwhile; ?>
        
</div>







<script type="text/javascript">
    $(function() {
        $('#datepicker, #datepicker2').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });
        
    });

</script>



<?php
    if(isset($_POST['submit']))
    {
        $organizerID = $_POST['organizerID'];
        $compName = $_POST['compName'];
        $category = $_POST['category'];
        $releaseDate = $_POST['releaseDate'];
        $registrationDeadline = $_POST['registrationDeadline'];
        $publicVote = $_POST['publicVote'];
        $judgeScore = $_POST['judgeScore'];
        $prizePool = $_POST['prizePool'];
        $description = $_POST['description'];
        $rules = $_POST['rules'];
        $evaluationDays = $_POST['evaluationDays'];

        if(isset($_FILES['compPic']['name']))
        {
            $compPic = $_FILES['compPic']['name'];
            $image = explode('.', $compPic);
            $ext = end($image);
            $compPic = rand(000,999).".".$ext;
            $source = $_FILES['compPic']['tmp_name'];
            $destination = "../materials/image/".$compPic;
            $upload = move_uploaded_file($source, $destination);
        }
        else{
            $compPic="";
        }

        $sql = "INSERT INTO competition SET
            compName = '$compName',
            organizerID = $organizerID,
            description = '$description',
            rules = '$rules',
            category = '$category',
            status = 'Pending',
            releaseDate = '$releaseDate',
            registrationDeadline = '$registrationDeadline',
            evaluationDays = $evaluationDays,
            judgeScore = $judgeScore,
            publicVote = $publicVote,
            prizePool = $prizePool,
            compPic = '$compPic'";

        $res = mysqli_query($conn,$sql);

        if($res == true)
        {   
            $details = mysqli_fetch_assoc($res);
            $_SESSION["comp"] = $details["compID"];
            header("Location:../organizer/choosejudge.php");
        }

    }
include("../organizer/partials/footer.php");
?>
