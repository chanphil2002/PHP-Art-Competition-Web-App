<?php include("../judge/partials/header2.php");

session_start();
if (!isset($_SESSION["judge"])) {
    header("Location: ../general/judgeLogin.php");
}

$judgeIC = $_SESSION['judge'];
$request = "SELECT * FROM judge WHERE judgeIC = '$judgeIC'";
$result = mysqli_query($conn, $request);
$display = mysqli_fetch_assoc($result);
$judgeName = $display['judgeName'];

if (isset($_POST['submit2'])) {
    $search = addslashes($_POST['search']);
    $filter = $_POST['filter_dropdown'];
    $sort = $_POST['sort_dropdown'];

    if ($filter == " ") {
        $sql1 = "CREATE TEMPORARY TABLE temp AS (SELECT competition.*, comp_judge.judgeIC FROM competition INNER JOIN comp_judge on competition.compID = comp_judge.compID WHERE (compName LIKE '%$search%' OR category LIKE '%$search%') AND (Status = 'Upcoming' OR Status = 'On-Going' OR Status = 'Past') AND comp_judge.judgeIC = '$judgeIC')";
        $res1 = mysqli_query($conn, $sql1);
    } else if ($search == " ") {
        $sql1 = "CREATE TEMPORARY TABLE temp AS (SELECT competition.*, comp_judge.judgeIC FROM competition INNER JOIN comp_judge on competition.compID = comp_judge.compID WHERE competition.STATUS LIKE '%$filter%' AND comp_judge.judgeIC = '$judgeIC')";
        $res1 = mysqli_query($conn, $sql1);
    } else {
        $sql1 = "CREATE TEMPORARY TABLE temp AS (SELECT competition.*, comp_judge.judgeIC FROM competition INNER JOIN comp_judge on competition.compID = comp_judge.compID WHERE (compName LIKE '%$search%' OR category LIKE '%$search%') AND status LIKE '%$filter%' AND comp_judge.judgeIC = '$judgeIC')";
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
        <div class="row" style="margin-top: 3%">
            <div class="col-12 col-competition-1">
                <h3 class="text-color-2"><?php echo $judgeName ?>'s Assigned Competition(s)
                    <span class="text-color-3">
                </h3>
            </div>

            <div class="col-12 col-competition-2">
                <form action="../judge/judge2.php" method="POST" class="d-flex">
                    <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" value="<?php echo stripslashes($search) ?>">
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
                        <option <?php if ($_POST['sort_dropdown'] == 'RegistrationDateline') { ?>selected="true" <?php }; ?>value="RegistrationDateline">Sort By: Registration Dateline</option>
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
                            $registrationDeadline = $row1['registrationDeadline'];
                    ?>

                            <div class="col-md-4 margincon1">
                                <div class="card border-1 grid-list">
                                    <a href="viewcompmain.php?compID=<?php echo $compID; ?>" class="stretched-link">
                                        <?php
                                        if ($status1 == 'Pending') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-primary end-0'> $status1 </span>";
                                        } else if ($status1 == 'Upcoming') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-warning end-0'> $status1 </span>";
                                        } else if ($status1 == 'On-Going') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-success end-0'>$status1 </span>";
                                        } else if ($status1 == 'Past') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-dark end-0'> $status1 </span>";
                                        } else if ($status1 == 'Terminated') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-danger end-0'> $status1 </span>";
                                        } else if ($status1 == 'Rejected') {
                                            echo "<span style='display: inline-block; margin-left: 1em' class='badge rounded-pill position-absolute bg-secondary end-0'> $status1 </span>";
                                        }
                                        ?> <img class="card-img-top lazy" src="../materials/compPic/<?php echo $compPic1; ?>">
                                    </a>
                                    <div class="card-  description text-truncate text-color-2">
                                        <?php echo $registrationDeadline; ?> / Category: <?php echo $category1; ?>
                                        <h3 class="card-text"><?php echo $compName1; ?></h3>
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


<?php include("../judge/partials/footer.php"); ?>

<!-- <script type="text/javascript">
    document.getElementById('filer_dropdown').onchange = function() {
        localStorage.setItem('selectedtem', document.getElementById('filter_dropdown').value);
    };

    if (localStorage.getItem('selectedtem')) {
        document.getElementById(localStorage.getItem('selectedtem')).selected = true;
    }
</script> -->

<!-- <script>
    $('#filter_dropdown').change(function(event) {
        var selectedcategory = $(this).children("option:selected").val();
        sessionStorage.setItem("itemName", selectedcategory);
    });

    $('select').find('option[value=' + sessionStorage.getItem('itemName') + ']').attr('selected', 'selected');
</script> -->