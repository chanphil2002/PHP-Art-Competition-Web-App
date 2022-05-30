<?php include("../judge/partials/header2.php");

if (isset($_POST['submit2'])) {
    $search = $_POST['search'];
    $filter = $_POST['filter_dropdown'];

    if ($filter == " ") {
        $sql1 = "SELECT * FROM competition WHERE (compName LIKE '%$search%' OR category LIKE '%$search%')";
        $res1 = mysqli_query($conn, $sql1);
    } else if ($search == " ") {
        $sql1 = "SELECT * FROM competition WHERE STATUS LIKE '%filter%'";
        $res1 = mysqli_query($conn, $sql1);
    } else {
        $sql1 = "SELECT * FROM competition WHERE (compName LIKE '%$search%' OR category LIKE '%$search%') AND status LIKE '%$filter%'";
        $res1 = mysqli_query($conn, $sql1);
        // echo "<script>alert('$filter');</script>";
        // echo "<script>alert('$search');</script>";
        // $sort = $_POST['sort_dropdown'];
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
                <h3 class="text-color-2">Search Result Displayed Based on
                    <span class="text-color-3">
                </h3>
            </div>

            <div class="col-12 col-competition-2">
                <form action="../judge/judge2.php" method="POST" class="d-flex">
                    <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" value="<?php echo $search ?>">
            </div>
            <div class="col-12 col-competition-2">
                <div class="overflow-auto">
                    <span aria-label="Filter By" style="position:relative; box-sizing: border-box; "></span>
                    <label for="filter_dropdown"></label>
                    <select name="filter_dropdown" id="filter_dropdown">
                        <option <?php if ($_POST['filter_dropdown'] == ' ') { ?>selected="true" <?php }; ?> value=" ">Filter By: All Competitions </option>
                        <option value="Upcoming">Filter By: Upcoming Competition</option>
                        <option value="On-Going">Filter By: Ongoing Competition</option>
                        <option value="Pending">Filter By: Past Competition</option>
                    </select>

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
                    $count = mysqli_num_rows($res1);
                    if ($count > 0) {
                        while ($row1 = mysqli_fetch_assoc($res1)) {

                            $compID = $row1['compID'];
                            $compName1 = $row1['compName'];
                            $category1 = $row1['category'];
                            $compPic1 = $row1['compPic'];
                            $status1 = $row1['status'];
                    ?>

                            <div class="col-md-4 margincon1">
                                <div class="card border-1 grid-list">
                                    <a href="viewcompmain.php?compID=<?php echo $compID; ?>" class="stretched-link">
                                        <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $status1; ?></span>
                                        <img class="card-img-top lazy" src="../materials/image/<?php echo $compPic1; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        23 May 2022 / <?php echo $category1; ?>
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


<?php include("../judge/partials/footer.php"); ?>

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