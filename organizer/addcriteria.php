<?php include ("../organizer/partials/header.php");

if(isset($_GET['compID']))
    {
        $compID = $_GET['compID'];
    }else {
        header("Location: ../organizer/orghome.php");
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="mx-auto" >
    <h1 class="pt-5 ms-5">Create Criteria</h1>
</div>

<div class="row" >
    <div class="col-md-4 order-md-2 mb-4 mx-auto">

        <div class="mb-3">
            <label for="inlineFormInput">Criteria Name</label>
            <div class="input-group">
                <input type="text" name="criteria" class="form-control" id="search" placeholder="What is the Criteria Name?" required>
            </div>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1">Criteria Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" 
        placeholder="Tell more about the criteria..." required></textarea>
        </div>

        <hr class="mb-4">
        <input type="hidden" id='compID' name='compID' value= "<?php echo $compID;?>">
        <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Continue</button>
    </div>
</div>

</form>


<?php
    ob_start();
    if(isset($_POST['submit']))
    {
        $compID = $_POST['compID'];
        $criteria = addslashes($_POST['criteria']);
        $description = addslashes($_POST['description']);

        $sql = "INSERT INTO comp_criteria SET
            compID = $compID,
            criteria = '$criteria',
            description = '$description'";

        $res = mysqli_query($conn,$sql);

        if($res == true)
        {   
            $_SESSION['compID'] = $compID;
            // echo '<script>alert("Criteria Added Successfully!")</script>';
            header("location:" . SITEURL . "organizer/selectedcriteria.php");
            
            
        }

    }
include("../organizer/partials/footer.php");
?>
