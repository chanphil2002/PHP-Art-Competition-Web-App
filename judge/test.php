<?php include("../judge/partials/header.php");
session_start();
if (!isset($_SESSION["judge"])) {
  header("Location: ../general/judgeLogin.php");
}
if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $sql1 = "SELECT * FROM competition WHERE compName LIKE '%$search%' OR category LIKE '%$search%'";
  $res1 = mysqli_query($conn, $sql1);
} else {
  $sql1 = "SELECT * FROM competition";
  $res1 = mysqli_query($conn, $sql1);
}
?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="judge.css">
</head>

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
              <select name="sort_dropdown" autocomplete="off" id="sort_dropdown" onchange="switchSort()" aria-pressed:"false">
                <option value="" selected="selected" disabled selected> Sort By: Please Select </option>
                <option value="Competition Date"> Sort By: Competition Date</option>
                <option value="Registration Dateline">Sort By: Registration Dateline</option>
                <option value="Popularity">Sort By: Popularity</option>
              </select>
        </div>
      </div>
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

        <!-- //   $compID = $row['compID'];
        //   $compName = $row['compName'];
        //   $category = $row['category'];
        //   $compPic = $row['compPic'];
        //   $status = $row['status']; -->

        <table class="table">
          <thead>
            <tr>
              <th>Sr No.</th>
              <th>Username</th>
              <th>Date</th>
              <th>Title</th>
              <th>Imaage</th>
            </tr>

          </thead>
          </tbody>

          <?php

          $query = "SELECT * FROM COMPETITION";
          $r = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($r)) {
          ?>
            <tr>
              <td><?php echo $row['compName'] ?></td>
              <td><?php echo $row['compID'] ?></td>
              <td><?php echo $row['category'] ?></td>
              <td><?php echo $row['status'] ?></td>
              <td><?php echo $row['rules'] ?></td>
            </tr>
          <?php

          } ?>
      </div>

    </div>
    </div>


    </div>

  </main>
</body>

</html>


<!-- <?php include("../judge/partials/footer.php"); ?> -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#filter_dropdown").on('change', function() {
      var value = $(this).val();
      // alert(value);

      $.ajax({
        url: "fetch.php",
        type: "POST",
        data: 'request=' + value,
        beforeSend: function() {
          $(".container").html("<span>Working...</span>");
        },
        success: function(data) {
          $(".container").html(data);
          alert(data);
        }
      });
    });
  });


  // function switchFilter() {
  //   var x = document.getElementById("filter_dropdown").value;
  //   document.getElementById("demo").innerHTML = "You selected: " + x;
  // }

  // function switchSort() {
  //   var x = document.getElementById("_dropdown").value;
  //   document.getElementById("demo").innerHTML = "You selected: " + x;
  // }
</script>