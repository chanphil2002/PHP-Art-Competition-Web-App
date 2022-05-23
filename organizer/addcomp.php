<?php include ("../organizer/partials/header.php");?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="mx-auto" >
    <h1 class="pt-5 ms-5">Create Competition</h1>
</div>

<div class="row" >
    <div class="col-md-4 order-md-2 mb-4 mx-auto">
  
        <div class="mb-3">
        <label for="inlineFormInput">Competition Name</label>
        <div class="input-group">
            <input type="text" name="compName" class="form-control" id="inlineFormInput" placeholder="What is the Competition Name?" required>
        </div>
        </div>

        <div class="mb-3">
            <label for="stock">Organizer ID</label>
            <input type="number" name="organizerID" class="form-control" id="organizerID" placeholder="State the Organizer ID" required>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1">Competition Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" 
        placeholder="Tell more about the competition..." required></textarea>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1">Competition Rules</label>
        <textarea class="form-control" name="rules" id="exampleFormControlTextarea1" rows="3" 
        placeholder="State the competition rules..." required></textarea>
        </div>

        <div class="mb-3">
            <label for="category">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category">
                <option value = "2D">2D</option>
                <option value = "3D">3D</option>
                <option value = "Paintings">Paintings</option>
                <option value = "Photography">Photography</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date">Competition Release Date</label>
            <div class="input-group date" id="datepicker">
                <input type="text" name="releaseDate" id ="releaseDate" class="form-control" placeholder="Competition Release Date" readonly/>
                <span class="input-group-append">
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="date">Competition Registration Deadline</label>
            <div class="input-group date" id="datepicker2">
                <input type="text" name="registrationDeadline" id ="registrationDeadline" class="form-control" placeholder="When is the Deadline?" readonly/>
                <span class="input-group-append">
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="stock">Evaluation Days</label>
            <input type="number" name="evaluationDays" class="form-control" id="evaluationDays" placeholder="How many days for evaluation?" required>
        </div>

        <div class="mb-3">
            <label for="price">Competition Poster</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="compPic" id="compPic" required>       
            </div>
        </div>

        


        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Submit Request</button>
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

</script>



<?php
    if(isset($_POST['submit']))
    {
        $compName = $_POST['compName'];
        $organizerID = $_POST['organizerID'];
        $description = $_POST['description'];
        $rules = $_POST['rules'];
        $category = $_POST['category'];
        $releaseDate = $_POST['releaseDate'];
        $registrationDeadline = $_POST['registrationDeadline'];
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
            compPic = '$compPic'";

        $res = mysqli_query($conn,$sql);

        if($res == true)
        {   echo "<script>window.location.href = 'orghome.php';</script>";
            $_SESSION['add'] = "<div class='text-success ms-5'>Competition Requested Successfully.</div>";
        }

    }
include("../organizer/partials/footer.php");
?>
