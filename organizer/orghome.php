<?php include("../organizer/partials/header.php");


if (!isset($_SESSION["organizer"])) {
  header("Location: ../general/otherRoleLogin.php");
}
?>


<?php
$organizerID = $_SESSION['organizer'];
$request = "SELECT * FROM organizer WHERE organizerID = '$organizerID'";
$result = mysqli_query($conn, $request);
$display = mysqli_fetch_assoc($result);
$organizerID = $display['organizerID'];
$organizerName = $display['organizerName'];
//Create SQL Query to Display Categories from Database
$sql = "SELECT * FROM competition WHERE organizerID = $organizerID";
//Execute the Query
$res = mysqli_query($conn, $sql);
?>


<div class="album py-5">
  <div class="ms-5">
    <h1><?php echo $organizerName; ?>'s Competition</h1>
    <a class="btn btn-success" href="addcomp.php?organizerID=<?php echo $organizerID ?>" role="button">Create Competition</a>
  </div>


  <div class="container ">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($res)) :

        $compID = $row['compID'];
        $compName = $row['compName'];
        $category = $row['category'];
        $compPic = $row['compPic'];
        $status = $row['status'];
        $registrationDeadline = $row['registrationDeadline'];
      ?>
        <div class="col-md-4 margincon1 mb-4">
          <div class="card border-1 grid-list ">
            <a href="../organizer/viewcomp_main.php?compID= <?php echo $compID; ?>" class="stretched-link">
              <?php
              if ($status == 'Pending') {
                echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-primary end-0'> $status </span>";
              } else if ($status == 'Upcoming') {
                echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-warning end-0'> $status </span>";
              } else if ($status == 'On-Going') {
                echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-success end-0'>$status </span>";
              } else if ($status == 'Past') {
                echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-dark end-0'> $status </span>";
              } else if ($status == 'Terminated') {
                echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-danger end-0'> $status </span>";
              }
              ?>
              <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic; ?>">
            </a>
            <div class="card-body description text-truncate text-color-2">
              <?php echo $registrationDeadline; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category: <?php echo $category; ?>
              <h3 class="card-text"><?php echo $compName; ?></h3>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>


<?php include("../organizer/partials/footer.php"); ?>
