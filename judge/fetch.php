<?php include("../judge/partials/database.php");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

if (isset($POST['res1'])) {
    $res1 = $_POST['res1'];
    echo $res1;
}

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $query = "SELECT * FROM competition WHERE status = '$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
}
?>

<body>
    <div class="container mt-5">
        <div class="row" style="margin-top: 10%">
            <div class="col-12 col-competition-1">
                <h3 class="text-color-2">Search Result Displayed Based on
                    <span class="text-color-3"><?php echo $search; ?>
                </h3>
            </div>
            <div class="col-12 col-competition-1 text-md-end">
                <div class="overflow-auto">
                    <span aria-label="Filter By" style="position:relative; box-sizing: border-box; ">
                        <label for="filter_dropdown"></label>
                        <select name="filter_dropdown" id="filter_dropdown">
                            <option>Filter By: All Competitions </option>
                            <option value="Upcoming">Filter By: Upcoming Competition</option>
                            <option value="On-Going">Filter By: Ongoing Competition</option>
                            <option value="Pending">Filter By: Past Competition</option>
                        </select>

                        <span aria-label="Sort By" style="position:relative; box-sizing: border-box">
                            <label for="sort_dropdown"></label>
                            <select name="sort_dropdown" id="sort_dropdown">
                                <option value="" selected="selected" disabled selected> Sort By: Please Select </option>
                                <option value="Competition Date"> Sort By: Competition Date</option>
                                <option value="Registration Dateline">Sort By: Registration Dateline</option>
                                <option value="Popularity">Sort By: Popularity</option>
                            </select>
                </div>
            </div>
        </div>
        <main>
            <div class="index-section-6" style="box-sizing:border-box; display: block; padding-top: 1rem!important; padding-bottom: 1rem!important">
                <div class="container">
                    <div class="row">
                        <?php
                        if ($count) {
                        } else {
                            echo "No Result Found";
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="col-md-4 margincon1">
                                <div class="card border-1 grid-list">
                                    <a href="../admin/test.php" class="stretched-link">
                                        <span class="badge rounded-pill text-bg-success position-absolute top-0 end-0"><?php echo $row['status']; ?></span>
                                        <img class="card-img-top lazy" src="../materials/image/<?php echo $row['compPic']; ?>">
                                    </a>
                                    <div class="card-body description text-truncate text-color-2">
                                        23 May 2022 / <?php echo $row['category']; ?>
                                        <div class="title text-truncate"><?php echo $row['category']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
        </main>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $("#filter_dropdown").on('change', function() {
            var value = $(this).val();
            var search = <?php echo json_encode($search); ?>;
            // alert(value);
            // alert(search);

            $.ajax({
                url: "fetch.php",
                type: "POST",
                data: 'request=' + value + '&search=' + search,
                beforeSend: function() {
                    $(".container").html("<span>Working...</span>");
                },
                success: function(data) {
                    $(".container").html(data);
                }
            });
        });
    });
</script>