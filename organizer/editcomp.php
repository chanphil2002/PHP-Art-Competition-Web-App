<?php include ("../organizer/partials/header.php");

if(isset($_GET['compID']))
    {
        $compID = $_GET['compID'];
        $sql = "SELECT * FROM competition WHERE compID = $compID";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $organizerID = $row['organizerID'];
        $compName = $row['compName'];
        $category = $row['category'];
        $releaseDate = $row['releaseDate'];
        $registrationDeadline = $row['registrationDeadline'];
        $publicVote = $row['publicVote'];
        $judgeScore = $row['judgeScore'];
        $prizePool = $row['prizePool'];
        $description = $row['description'];
        $rules = $row['rules'];
        $currentcompPic = $row['compPic'];
        $evaluationDays = $row['evaluationDays'];
    }

?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="mx-auto" >
<a class="btn btn-outline-success ms-5 rounded-end rounded-5" href="selectedjudge.php" role="button">&laquo; Back to Judges Allocation page </a>
    <h1 class="pt-5 ms-5 text-center mb-4">Edit Competition</h1>
</div>

<div class="row" >
    <div class="col-md-4 order-md-2 mb-4 mx-auto">

        <div class="mb-3">
            <label for="stock">Organizer ID</label>
            <input type="text" name="organizerID" value="<?php echo $organizerID;?>" class="form-control" id="search" placeholder="State the Organizer ID" required>
        </div>
  
        <div class="mb-3">
            <label for="inlineFormInput">Competition Name</label>
            <div class="input-group">
                <input type="text" name="compName" value="<?php echo $compName;?>" class="form-control" id="search" placeholder="What is the Competition Name?" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="category">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category">
                <option value = "<?php echo $category;?>"></option>
                <option value = "2D">2D</option>
                <option value = "3D">3D</option>
                <option value = "Paintings">Paintings</option>
                <option value = "Photography">Photography</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date">Competition Release Date</label>
            <div class="input-group date" id="datepicker">
                <input type="text" name="releaseDate" id ="releaseDate" value="<?php echo $releaseDate;?>" class="form-control" placeholder="Competition Release Date" readonly/>
                <span class="input-group-append">
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="date">Competition Registration Deadline</label>
            <div class="input-group date" id="datepicker2">
                <input type="text" name="registrationDeadline" id ="registrationDeadline" value="<?php echo $registrationDeadline;?>" class="form-control" placeholder="When is the Deadline?" readonly/>
                <span class="input-group-append">
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="stock">Public Vote</label>
            <input type="number" name="publicVote" class="form-control" id="publicVote" value="<?php echo $publicVote;?>" placeholder="How many percentage for public vote?" required>
        </div>

        <div class="mb-3">
            <label for="stock">Judge Score</label>
            <input type="number" name="judgeScore" class="form-control" id="judgeScore" value="<?php echo $judgeScore;?>" placeholder="How many percentage for judge score?" required>
        </div>

        <div class="mb-3">
            <label for="price">Prize Pool</label>
            <input type="float" name="prizePool" class="form-control" id="prizePool" value="<?php echo $prizePool;?>" placeholder="Enter Prize Pool..." required>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1">Competition Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" 
        placeholder="Tell more about the competition..." required><?php echo $description;?>"</textarea>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1">Competition Rules and Regulations</label>
        <textarea class="form-control" name="rules" id="exampleFormControlTextarea1" rows="3" 
        placeholder="State the competition rules..." required><?php echo $rules;?>"</textarea>
        </div>

        <div class="mb-3">
            <label for="price">Competition Poster</label>
            <?php
                if($currentcompPic == "")
                {
                    echo "<div class='text-danger ml-5'>None of the competition poster added.</div>";
                }
                else
                {
                    ?>
                    <img src="../materials/image/<?php echo $currentcompPic; ?>" width="50%">
                    <?php
                }?>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="compPic" id="compPic">       
            </div>
        </div>

        <div class="mb-3">
            <label for="stock">Evaluation Days</label>
            <input type="number" name="evaluationDays" class="form-control" id="evaluationDays" value="<?php echo $evaluationDays;?>" placeholder="How many days for evaluation?" required>
        </div>


        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Continue</button>
    </div>
</div>

</form>



<script type="text/javascript">
    $(function() {
        $('#datepicker, #datepicker2').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });
        
    });

    $( function() {
    $( "#search" ).autocomplete({
    source: '../organizer/partials/search.php'  
    });
});

</script>



<?php
    ob_start();
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
            if($compPic != "")
            {
                $image = explode('.', $compPic);
                $ext = end($image);
                $compPic = rand(000,999).".".$ext;
                $source = $_FILES['compPic']['tmp_name'];
                $destination = "../materials/image/".$compPic;
                $upload = move_uploaded_file($source, $destination);
                if($currentcompPic != "")
                {
                    $deletecompPic = "../materials/image/".$currentcompPic;
                    $delete = unlink($deletecompPic);
                }
            }
            else
            {
                $compPic = $currentcompPic;
            }
        }
        else{
            $compPic= $currentcompPic;
        }

        $sql = "UPDATE competition SET
            compName = '$compName',
            organizerID = $organizerID,
            description = '$description',
            rules = '$rules',
            category = '$category',
            releaseDate = '$releaseDate',
            registrationDeadline = '$registrationDeadline',
            evaluationDays = $evaluationDays,
            judgeScore = $judgeScore,
            publicVote = $publicVote,
            prizePool = $prizePool,
            compPic = '$compPic'
            WHERE compID = $compID";

        $res = mysqli_query($conn,$sql);


        if($res == true)
        {   

            $_SESSION['compID'] = $compID;
            echo $_SESSION['compID'];
            
            header("location:" . SITEURL . "organizer/selectedjudge.php");
            
        }

    }
include("../organizer/partials/footer.php");
?>
