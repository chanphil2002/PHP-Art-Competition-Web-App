<?php 
include("partials/database.php"); 

    // 1. User type (Users, judge, organizer)
    $sql = "SELECT COUNT(*) FROM user WHERE status != 'Terminated' ";
    $run = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_array($run)){
        $numU = $res["COUNT(*)"];
    }

    $sql = "SELECT COUNT(*) FROM judge WHERE (status != 'Pending' AND status != 'Terminated') ";
    $run = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_array($run)){
        $numJ = $res["COUNT(*)"];
    }

    $sql = "SELECT *, COUNT(*) FROM organizer WHERE organizerStatus != 'pending' ";
    $run = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_array($run)){
        $numOrg = $res["COUNT(*)"];
    }

    $sql = "CREATE TEMPORARY TABLE temp (ID int NOT NULL AUTO_INCREMENT, UserType varchar(30) NOT NULL, Amount int NOT NULL, PRIMARY KEY(ID))";
    $run = mysqli_query($conn, $sql);

    $sql = "INSERT INTO temp (UserType, Amount) VALUES ('User', '$numU'), ('Judge', '$numJ'), ('Organizer', '$numOrg')";
    $run = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM temp";
    $run = mysqli_query($conn, $sql);


	// 2. Competition type (2D, 3D, painting, photography)
	// 3. Number of participants in each category

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],

          <?php
            while ($data = mysqli_fetch_assoc($run)){
                echo "['".$data['UserType']."', ".$data['Amount']."], ";
            }
          ?>

        ]);

        var options = {
          title: 'Type of Virtual X Competition System Users',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

</head>
<body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
</body>
</html>