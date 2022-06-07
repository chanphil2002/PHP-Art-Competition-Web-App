<?php include("../admin/partials/header.php");
if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
}


if (isset($_POST['submit2'])) {
    $search = $_POST['search'];
    $filter = $_POST['filter_dropdown'];
    $sort = $_POST['sort_dropdown'];

    if ($filter == " ") {
        $sql1 = "CREATE TEMPORARY TABLE temp AS (SELECT C.compID, C.compName, C.organizerID, C.description, C.category, C.status, C.releaseDate, C.registrationDeadline, C.compPic FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE (compName LIKE '%$search%' OR category LIKE '%$search%' OR organizerName LIKE '%$search%') AND (Status = 'Upcoming' OR Status = 'On-Going' OR Status = 'Past'))";
        $res1 = mysqli_query($conn, $sql1);
        
    } else if ($search == " ") {
        $sql1 = "CREATE TEMPORARY TABLE temp AS SELECT * FROM competition WHERE status = '$filter' ";
        $res1 = mysqli_query($conn, $sql1);
    } else {
        $sql1 = "CREATE TEMPORARY TABLE temp AS (SELECT C.compID, C.compName, C.organizerID, C.description, C.category, C.status, C.releaseDate, C.registrationDeadline, C.compPic FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE (compName LIKE '%$search%' OR category LIKE '%$search%' OR organizerName LIKE '%$search%') AND (status = '$filter'))";
        $res1 = mysqli_query($conn, $sql1);
    }

    if ($sort == "RegistrationDateline") {
        $sql2 = "SELECT * FROM temp ORDER BY registrationDeadline";
        $res2 = mysqli_query($conn, $sql2);
    } else if ($sort == "ReleaseDate") {
        $sql2 = "SELECT * FROM temp ORDER BY releaseDate";
        $res2 = mysqli_query($conn, $sql2);
    } else {
        $sql2 = "SELECT * FROM temp";
        $res2 = mysqli_query($conn, $sql2);
    }
}


// if (isset($_POST['submit'])) {
//     $search = $_POST['search'];
//     echo "<script>alert('$search');</script>";
//     $sql1 = "SELECT * FROM competition WHERE compName LIKE '%$search%' OR category LIKE '%$search%'";
//     $res1 = mysqli_query($conn, $sql1);
//     if ($res1) {
//         echo "<script>alert('success');</script>";
//     } else {
//         echo "<script>alert('wrong');</script>";
//     }
//     // echo "<script>alert('$filter');</script>";
//     // $sort = $_POST['sort_dropdown'];
// } else {
//     $sql1 = "SELECT * FROM competition";
//     $res1 = mysqli_query($conn, $sql1);
// }

?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="judge.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row" style="margin-top: 2%">
            <div class="col-12 col-competition-1">
                <h3 class="text-color-2">Search Query
                    <span class="text-color-3">
                </h3>
            </div>

            <div class="col-12 col-competition-2">
                <form action="searchComp3.php" method="POST" class="d-flex">
                    <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Search..." value="<?php echo $search ?>">
            </div>
            <div class="col-12 col-competition-3">
                <div class="overflow-auto">
                    <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
                    <label for="filter_dropdown"></label>
                    <select name="filter_dropdown" id="filter_dropdown">
                        <option <?php if ($_POST['filter_dropdown'] == ' ') { ?>selected="true" <?php }; ?> value=" ">Filter By: All Competitions </option>
                        <option <?php if ($_POST['filter_dropdown'] == 'Upcoming') { ?>selected="true" <?php }; ?>id="Upcoming" value="Upcoming">Filter By: Upcoming Competition</option>
                        <option <?php if ($_POST['filter_dropdown'] == 'On-Going') { ?>selected="true" <?php }; ?>id="On-Going" value="On-Going">Filter By: Ongoing Competition</option>
                        <option <?php if ($_POST['filter_dropdown'] == 'Past') { ?>selected="true" <?php }; ?>id="Past" value="Past">Filter By: Past Competition</option>
                    </select>

                    <span aria-label="Sort By" style="position:relative; box-sizing: border-box"></span>
                    <label for="sort_dropdown"></label>
                    <select name="sort_dropdown" id="sort_dropdown">
                        <option <?php if ($_POST['sort_dropdown'] == ' ') { ?>selected="true" <?php }; ?>value=" "> Sort By: Please Select </option>
                        <option <?php if ($_POST['sort_dropdown'] == 'ReleaseDate') { ?>selected="true" <?php }; ?>value="ReleaseDate"> Sort By: Release Date</option>
                        <option <?php if ($_POST['sort_dropdown'] == 'RegistrationDateline') { ?>selected="true" <?php }; ?>value="RegistrationDateline">Sort By: Registration Deadline</option>
                    </select>
                    <input type="submit" name="submit2" value="Search" class="btn btn-outline-dark my-2 my-sm-0" style="margin-left:20px">

                </div>
            </div>
            </form>
        </div>
    </div>
    <main>
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
                    $count = mysqli_num_rows($res2);
                    if ($count > 0) {
                        while ($row1 = mysqli_fetch_assoc($res2)) {

                            $compID = $row1['compID'];
                            $compName1 = $row1['compName'];
                            $category1 = $row1['category'];
                            $compPic1 = $row1['compPic'];
                            $status1 = $row1['status'];
                            $registrationDeadline = $row1["registrationDeadline"];
                            $release = $row1["releaseDate"];
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
                                        <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic1; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        <?php if ($sort == "ReleaseDate"){
                                            echo "Release Date: " . $release;
                                        }else{echo "Registration Deadline: " . $registrationDeadline;} ?> / <?php echo "Category: " . $category1; ?>
                                        <div class="title text-truncate"><?php echo $compName1; ?></div>
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


<?php include("../admin/partials/footer.php") ?>

<!-- <script>
    window.onload = function() {
        var selItem = sessionStorage.getItem("SelItem");
        $('#sort-item').val(selItem);
    }
    $('#sort-item').change(function() {
        var selVal = $(this).val();
        sessionStorage.setItem("SelItem", selVal);
    });
</script> -->