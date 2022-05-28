<?php include("../organizer/partials/header.php"); ?>


<!-- Carousel
  <div id="testimonials" class="carousel slide" data-ride="carousel" data-interval="2000" data-pause="hover">
    <ol class="carousel-indicators">
      <li data-target="#testimonials" data-slide-to="0" class="active"></li>
      <li data-target="#testimonials" data-slide-to="1"></li>
      <li data-target="#testimonials" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="photo/carousel003.jpg" class="" style="width:640px;height:360px" alt="" >
        <div class="carousel-caption d-none d-md-block">
          <h3>Brown Rice</h3>
          <p>Providing high nutrients with low calories.</p>
          <a class="align btn btn-outline-success" href="details.php?ProID=3" role="button">View Details</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="photo/carousel008.jpg" class="" style="width:640px;height:360px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h3>Organic Baby Noodle</h3>
          <p>Containing Wheat Flour and vegetable powder.</p>
          <a class="align btn btn-outline-success" href="details.php?ProID=8" role="button">View Details</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="photo/carousel013.jpg" class="" style="width:640px;height:360px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h3>Organic Regular Rolled Oat</h3>
          <p>An absolute whole grain that boosts our morning. It's completely a natural without any preservatives, coloring whatsoever.</p>
          <a class="align btn btn-outline-success" href="details.php?ProID=13" role="button">View Details</a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#testimonials" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#testimonials" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
 -->

<?php
//Create SQL Query to Display Categories from Database
$sql = "SELECT * FROM competition";
//Execute the Query
$res = mysqli_query($conn, $sql);
?>


<div class="album py-5 bg-light">
  <div class="ms-5">
    <h1>Organizer's Competition</h1>
    <a class="btn btn-success" href="addcomp.php" role="button">Create Competition</a>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>
  </div>


  <div class="container ">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($res)) :

        $compID = $row['compID'];
        $compName = $row['compName'];
        $category = $row['category'];
        $compPic = $row['compPic'];
        $status = $row['status'];
      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm me-5">
            <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $status; ?></span>
            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><img src="../materials/image/<?php echo $compPic; ?>" alt="<?= $compID; ?>"></svg>

            <div class="card-body">
              <h3 class="text-center card-text"><?php echo $compName; ?></h3>
              <h5 class="text-center text-secondary"><?php echo $category; ?></h5>
              <div class="d-flex justify-content-center align-items-center">
                <div class="btn-group">
                  <a class="align btn btn-outline-primary" href="viewcomp_main.php?compID=<?php echo $compID; ?>" role="button">View Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>


<?php include("../organizer/partials/footer.php"); ?>