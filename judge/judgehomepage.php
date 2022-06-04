<?php include("../judge/partials/header2.php");

session_start();
if (!isset($_SESSION["judge"])) {
    header("Location: ../general/judgeLogin.php");
}
?>


<?php
$judgeIC = $_SESSION['judge'];
$request = "SELECT * FROM judge WHERE judgeIC = '$judgeIC'";
$result = mysqli_query($conn, $request);
$display = mysqli_fetch_assoc($result);
$judgeIC = $display['judgeIC'];
$judgeName = $display['judgeName'];
//Create SQL Query to Display Categories from Database
$sql = "SELECT * FROM competition INNER JOIN comp_judge ON competition.compID = comp_judge.compID WHERE comp_judge.judgeIC = '$judgeIC' AND (competition.Status = 'On-Going' OR competition.Status = 'Upcoming' OR competition.Status = 'Past')";
//Execute the Query
$res = mysqli_query($conn, $sql);

?>

<link rel="stylesheet" href="judge.css">

<body>
    <div class="container mt-5">
        <div class="row" style="margin-top: 2%">
            <div class="col-12 col-competition-1">
                <h3 class="text-color-2"><?php echo $judgeName ?>'s Assigned Competition(s)
                    <span class="text-color-3">
                </h3>
            </div>

            <div class="col-12 col-competition-2">
                <form action="../judge/judge2.php" method="POST" class="d-flex">
                    <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" value="">
            </div>
            <div class="col-12 col-competition-3">
                <div class="overflow-auto">
                    <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
                    <label for="filter_dropdown"></label>
                    <select name="filter_dropdown" id="filter_dropdown">
                        <option value=" ">Filter By: All Competitions </option>
                        <option value="Upcoming">Filter By: Upcoming Competition</option>
                        <option value="On-Going">Filter By: Ongoing Competition</option>
                        <option value="Past">Filter By: Past Competition</option>
                    </select>

                    <script type="text/javascript">
                        document.getElementById('filter_dropdown').value = "<?php echo $_GET['filter_dropdown']; ?>";
                        document.getElementById('sort_dropdown').value = "<?php echo $_GET['sort_dropdown']; ?>";
                    </script>

                    <span aria-label="Sort By" style="position:relative; box-sizing: border-box"></span>
                    <label for="sort_dropdown"></label>
                    <select name="sort_dropdown" id="sort_dropdown">
                        <option value=" "> Sort By: Please Select </option>
                        <option value="ReleaseDate"> Sort By: Release Date</option>
                        <option value="RegistrationDateline">Sort By: Registration Dateline</option>
                    </select>
                    <input type="submit" name="submit2" value="Search" class="btn btn-outline-dark my-2 my-sm-0" style="margin-left:20px">


                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="index-section-6" style="box-sizing:border-box; display: block; padding-top: 1rem!important; padding-bottom: 1rem!important">

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
                            <a href="../judge/viewcompmain.php?compID= <?php echo $compID; ?>" class="stretched-link">
                                <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $status; ?></span>
                                <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic; ?>">
                            </a>
                            <div class="card-body description text-truncate text-color-2">
                                <?php echo $registrationDeadline; ?> / Category: <?php echo $category; ?>
                                <h3 class="card-text"><?php echo $compName; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>
<?php include("../organizer/partials/footer.php"); ?>

<!-- 
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
                  <a class="align btn btn-outline-primary" href="editcomp.php?compID=<?php echo $compID; ?>" role="button">Manage Details</a>
                  <a class="align btn btn-outline-danger" href="deleteItem.php?compID=<?php echo $compID; ?>&compPic=<?php echo $compPic; ?>" role="button">Terminate Competition</a>
                </div>
              </div>
            </div>
          </div>
        </div> -->