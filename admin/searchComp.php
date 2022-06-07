<?php include("../admin/partials/header.php");
if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Competition</title>

    <link rel="stylesheet" href="judge.css">

</head>
<body>
    <div class="container mt-5">
        <div class="row" style="margin-top: 2%">
        <div class="col-12 col-competition-1">
            <h3 class="text-color-2">Search Query
                <span class="text-color-3"></h3>
        </div>
        <div class="col-12 col-competition-2">
            <form action="../admin/searchComp3.php" method="POST" class="d-flex">
                <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Search...">
      </div>
      <div class="col-12 col-competition-3">
          <div class="overflow-auto">
              <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
              <label for="filter_dropdown"></label>
              <select name="filter_dropdown" id="filter_dropdown">
                  <option value=" ">Filter By: All Competitions </option>
                <option value="Upcoming">Filter By: Upcoming Competition</option>
                <option value="On-Going">Filter By: Ongoing Competition</option>
                <option value="Pending">Filter By: Past Competition</option>
            </select>
            
            <script type="text/javascript">
            document.getElementById('filter_dropdown').value = "<?php echo $_GET['filter_dropdown']; ?>";
            </script>
            
            <span aria-label="Sort By" style="position:relative; box-sizing: border-box"></span>
            <label for="sort_dropdown"></label>
            <select name="sort_dropdown" id="sort_dropdown">
                <option value=" "> Sort By: Please Select </option>
                <option value="Release Date"> Sort By: Release Date</option>
                <option value="Registration Dateline">Sort By: Registration Deadline</option>
                <option value="Popularity">Sort By: Popularity</option>
            </select>
            
            <input type="submit" name="submit2" value="Search" class="btn btn-outline-dark my-2 my-sm-0" style="margin-left:20px">
        </div>
      </div>
      </form>
        </div>
  </div>
  <main>
      <hr>
        <div class="index-section-6" style="box-sizing:border-box; display: block; padding-top: 1rem!important; padding-bottom: 1rem!important">
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
                    $sql1 = "SELECT * FROM competition WHERE status != 'Pending' AND status != 'Rejected' AND status != 'Terminated'";
                    $res1 = mysqli_query($conn, $sql1);
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $compID = $row1['compID'];
                        $compName1 = $row1['compName'];
                        $category1 = $row1['category'];
                        $compPic1 = $row1['compPic'];
                        $status1 = $row1['status'];
                        if ($status1 == 'Upcoming') {
                            $badge = "badge rounded-pill text-bg-success position-absolute top-0 end-0 larger-badge";
                            $statusDisplay = "Upcoming";
                        } else if ($status1 == 'Pending') {
                            $badge = "badge rounded-pill text-bg-warning position-absolute top-0 end-0";
                            $statusDisplay = "Pending";
                        } else if ($status1 == 'On-Going') {
                            $badge = "badge rounded-pill text-bg-success position-absolute top-0 end-0";
                            $statusDisplay = "On-Going";
                        } else if ($status1 == 'Past') {
                            $badge = "badge rounded-pill text-bg-dark position-absolute top-0 end-0";
                            $statusDisplay = "Past";
                        } else if ($status1 == 'Terminated') {
                            $badge = "badge rounded-pill text-bg-secondary position-absolute top-0 end-0";
                            $statusDisplay = "Terminated";
                        } else {
                            $badge = "badge rounded-pill text-bg-danger position-absolute top-0 end-0";
                            $statusDisplay = "Rejected";
                        }
                    ?>
                    <div class="col-md-4 margincon1">
                        <div class="card border-1 grid-list">
                            <a href="viewCompDetails.php?selectedComp=<?php echo $compID; ?>" class="stretched-link">
                            <span class="<?php echo $badge ?>"><?php echo $status1; ?></span>
                            <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic1; ?>"></a>
                            <div class="card-  description text-truncate text-color-2">
                                23 May 2022 / <?php echo $category1; ?>
                                <div class="title text-truncate"><?php echo $compName1; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
<?php include("../admin/partials/footer.php") ?>