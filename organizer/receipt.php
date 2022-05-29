<?php include ("../organizer/partials/header.php");

if(isset($_GET['compID']))
    {
        $compID = $_GET['compID'];
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="mx-auto" >
    <h1 class="pt-5 ms-5">Payment</h1>
</div>

<div class="row" >
    <div class="col-md-4 order-md-2 mb-4 mx-auto">

    <div class="mb-3">
            <label for="price">Payment Receipt</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="receipt" id="receipt" required>       
            </div>
        </div>

        <hr class="mb-4">
        <input type="hidden" id='compID' name='compID' value= "<?php echo $compID;?>">
        <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Submit Request</button>
    </div>
</div>

</form>


<?php
    ob_start();
    if(isset($_POST['submit']))
    {
        $compID = $_POST['compID'];
        $receipt = $_POST['receipt'];

        if(isset($_FILES['receipt']['name']))
        {
            $receipt = $_FILES['receipt']['name'];
            $image = explode('.', $receipt);
            $ext = end($image);
            $receipt = rand(000,999).".".$ext;
            $source = $_FILES['receipt']['tmp_name'];
            $destination = "../organizer/receipt/".$receipt;
            $upload = move_uploaded_file($source, $destination);
        }
        else{
            $receipt="";
        }

        $sql = "UPDATE competition SET
            receipt = '$receipt'
            WHERE compID = $compID";

        $res = mysqli_query($conn,$sql);

        if($res == true)
        {   
            header("location:" . SITEURL . "organizer/orghome.php");
            
        }

    }
include("../organizer/partials/footer.php");
?>
