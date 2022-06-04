<?php include("../organizer/partials/header.php");

if (isset($_GET['compID'])) {
    $compID = $_GET['compID'];
} else {
    header("Location: ../organizer/orghome.php");
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="mx-auto">
        <h1 class="pt-5 ms-5">Competition Certificate</h1>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4 mx-auto">

            <div class="mb-3">
                <label for="price">Upload Certificate for participants (in PDF):</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="compCert" accept=".pdf" id="compCert" required>
                </div>
            </div>

            <hr class="mb-4">
            <input type="hidden" id='compID' name='compID' value="<?php echo $compID; ?>">
            <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Submit Certificate</button>
        </div>
    </div>

</form>


<?php
ob_start();
if (isset($_POST['submit'])) {
    $compID = $_POST['compID'];

    if (isset($_FILES['compCert']['name'])) {
        $compCert = $_FILES['compCert']['name'];
        $image = explode('.', $compCert);
        $ext = end($image);
        $compCert = rand(000, 999) . "." . $ext;
        $source = $_FILES['compCert']['tmp_name'];
        $destination = "../materials/compCert/" . $compCert;
        $upload = move_uploaded_file($source, $destination);
    } else {
        $compCert = "";
    }

    $sql = "UPDATE competition SET
            compCert = '$compCert'
            WHERE compID = $compID";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['compID'] = $compID;
        header("location:" . SITEURL . "organizer/viewcomp_main.php?compID=" . $compID);
        // echo '<script>alert("Certificate Submitted!")</script>';

    }
}
include("../organizer/partials/footer.php");
?>