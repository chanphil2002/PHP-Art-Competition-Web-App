<?php
    include ("partials/database.php");
    include ("partials/header.php");

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM competition WHERE compName LIKE '%$search%' OR category LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)){
          $sql1 = "SELECT * FROM competition WHERE status != 'Pending' ";
          $res1 = mysqli_query($conn, $sql1);
        }
    } else {
        $sql1 = "SELECT * FROM competition";
        $res1 = mysqli_query($conn, $sql1);
    }
?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../judge/judge.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row" style="margin-top: 10%">
      <div class="col-12 col-competition-1">
        <h3 class="text-color-2">Search Result Displayed Based on
          <span class="text-color-3">
        </h3>
      </div>

      <div class="col-12 col-competition-2">
        <form action="search2.php" method="POST" class="d-flex">
          <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" value="<?php echo $search ?>">
      </div>
      <div class="col-12 col-competition-2">
        <div class="overflow-auto">
          <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
          <label for="filter_dropdown"></label>
          <select name="filter_dropdown" id="filter_dropdown">
            <option>Filter By: All Competitions </option>
            <option value="Upcoming">Filter By: Upcoming Competition</option>
            <option value="On-Going">Filter By: Ongoing Competition</option>
            <option value="Pending">Filter By: Past Competition</option>
          </select>

          <script type="text/javascript">
            document.getElementById('filter_dropdown').value = "<?php echo $_GET['filter_dropdown']; ?>";
          </script>

          <!-- <span aria-label="Sort By" style="position:relative; box-sizing: border-box"></span>
                        <label for="sort_dropdown"></label>
                        <select name="sort_dropdown" id="sort_dropdown">
                            <option> Sort By: Please Select </option>
                            <option value="Competition Date"> Sort By: Competition Date</option>
                            <option value="Registration Dateline">Sort By: Registration Dateline</option>
                            <option value="Popularity">Sort By: Popularity</option>
                        </select> -->
          <input type="submit" name="submit2" value="Search" class="btn btn-outline-dark my-2 my-sm-0" style="margin-left:20px">


        </div>
      </div>
      </form>
    </div>
  </div>
  <main>
    <div class=" index-section-6" style="box-sizing:border-box; display: block; padding-top: 1rem!important; padding-bottom: 1rem!important">
      <div class="container">
        <div class="row" style="box-sizing:border-box">
          <div style="flex: 0 0 auto; width: 50%">
            <h3><span class="text-color-3">All</span>
              Tournament</h3>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <?php
          $count = mysqli_num_rows($res1);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res1)) {

              $compID = $row['compID'];
              $compName = $row['compName'];
              $category = $row['category'];
              $compPic = $row['compPic'];
              $status = $row['status'];
          ?>

              <div class="col-md-4 margincon1">
                <div class="card border-1 grid-list">
                  <a href="compDetails.php?compID=<?php echo $compID; ?>" class="stretched-link">
                    <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $status; ?></span>
                    <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic; ?>">
                  </a>
                  <div class="card-body description text-truncate text-color-2">
                    23 May 2022 / <?php echo $category; ?>
                    <div class="title text-truncate"><?php echo $compName; ?></div>
                  </div>
                </div>
              </div>
          <?php }
          } else {
            echo "<h2 class='text-danger'>No Result Found!</h2>";
          } ?>
        </div>

      </div>
    </div>


    </div>

  </main>
</body>

</html>


<?php include("partials/footer.php"); ?>