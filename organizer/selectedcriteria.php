<?php include("../organizer/partials/header.php");

ob_start();
if (!isset($_SESSION["compID"])) {
    header("Location: ../organizer/orghome.php");
} else {
    $compID = $_SESSION['compID'];
    $sql2 = "SELECT * FROM comp_criteria WHERE compID = '$compID'";
    $res2 = mysqli_query($conn, $sql2);
}
?>

<div class="mx-auto">
    <h2 class=" text-center"><b>Criteria Distribution</b></h2>
    <div class="bg-info bg-opacity-10 border border-info border-start-5 rounded-circle">
        <h5 class="text-center text-dark">Competition ID: <?php echo $compID; ?></h5>
    </div>
    <h5 class="ms-5 text-dark pt-4">Add Criteria(s) for your competition:</h5>
</div>

<div class='d-flex'>
    <a class="btn btn-outline-success btn-lg mx-auto px-5 mb-4" href="addcriteria.php?compID=<?php echo $compID; ?>" role="button"><i class="fa-solid fa-list-check me-2"></i>Add Criteria</a>
</div>



<div class="container">
    <table class="table bg-info bg-opacity-50 table-hover table-bordered mb-5">
        <thead>
            <tr class="text-center">
                <th scope="col">Criteria</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody class=" table-info ">
            <?php while ($row2 = mysqli_fetch_assoc($res2)) :
                $criteria = $row2['criteria'];
                $description = $row2['description'];
            ?>
                <tr>
                    <th scope="row"><?php echo $criteria; ?></th>
                    <td><?php echo $description; ?></td>

                    <td>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" id='compID' name='compID' value="<?php echo $compID; ?>">
                            <input type="hidden" id='criteria' name='criteria' value="<?php echo $criteria; ?>">
                            <input type="hidden" id='description' name='description' value="<?php echo $description; ?>">

                            <button class="btn btn-sm btn-outline-danger" name="remove" type="submit">Remove Criteria</button>
                        </form>
                    </td>

                </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
</div>


<div class="d-grid gap-2 d-md-flex justify-content-md-center">
    <!-- <a class="btn btn-lg btn-info ms-5 mb-3 rounded-5 me-5 px-5 text-black py-2" 
    href="viewcomp_main.php?compID=<?php echo $compID; ?>" role="button"><b>CONFIRM</b></a> -->
    <button type="button" class="btn btn-lg btn-info ms-5 mb-3 rounded-5 me-5 px-5 text-black py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">CONFIRM</button>
</div>




<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Competition Details Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure with the competition details above? You may still edit the details until the Competition's Release Date.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary" href="viewcomp_main.php?compID=<?php echo $compID; ?>">Save changes</a>
            </div>
        </div>
    </div>
</div>



<?php
ob_start();

if (isset($_POST['remove'])) {
    $compID = $_POST['compID'];
    $criteria = $_POST['criteria'];
    $description = $_POST['description'];

    $sql = "DELETE FROM comp_criteria WHERE compID = $compID AND criteria = '$criteria'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<script>alert('success');</script>";
    } else {
        echo "<script>alert('wrong');</script>";
    }

    if ($res == true) {
        $_SESSION['compID'] = $compID;
        echo $_SESSION['compID'];

        header("location:" . SITEURL . "organizer/selectedcriteria.php");
    }
}
include("../organizer/partials/footer.php");
?>