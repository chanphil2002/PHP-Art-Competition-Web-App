<?php 
// include("partials/database.php"); 
include("partials/header.php");

    // 1. User type (Users, judge, organizer)
    if (isset($_GET["user"])){
        $sql = "SELECT COUNT(*) FROM user";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_array($run)){
            $numU = $res["COUNT(*)"];
        }

        $sql = "SELECT COUNT(*) FROM judge WHERE (status != 'Pending' AND status != 'Terminated') ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_array($run)){
            $numJ = $res["COUNT(*)"];
        }

        $sql = "SELECT COUNT(*) FROM organizer WHERE organizerStatus != 'pending' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_array($run)){
            $numOrg = $res["COUNT(*)"];
        }

        $sql = "CREATE TEMPORARY TABLE temp (Title varchar(30) NOT NULL, Amount int NOT NULL)";
        $run = mysqli_query($conn, $sql);

        $sql = "INSERT INTO temp (Title, Amount) VALUES ('User', '$numU'), ('Judge', '$numJ'), ('Organizer', '$numOrg')";
        $run = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM temp";
        $run = mysqli_query($conn, $sql);
    }
    
	// 2. Competition type (2D, 3D, painting, photography)
    if (isset($_GET["competition"])){
        $sql = "SELECT COUNT(*) FROM competition WHERE category = '2D' AND (status != 'Pending' AND status != 'Terminated') ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $num2D = $res["COUNT(*)"];
        }
        
        $sql = "SELECT COUNT(*) FROM competition WHERE category = '3D' AND (status != 'Pending' AND status != 'Terminated') ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $num3D = $res["COUNT(*)"];
        }

        $sql = "SELECT COUNT(*) FROM competition WHERE category = 'Paintings' AND (status != 'Pending' AND status != 'Terminated') ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $numPaint = $res["COUNT(*)"];
        }

        $sql = "SELECT COUNT(*) FROM competition WHERE category = 'Photography' AND (status != 'Pending' AND status != 'Terminated') ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $numPhoto = $res["COUNT(*)"];
        }

        $sql = "CREATE TEMPORARY TABLE temp (Title varchar(30) NOT NULL, Amount int NOT NULL)";
        $run = mysqli_query($conn, $sql);

        $sql = "INSERT INTO temp (Title, Amount) VALUES ('2D', '$num2D'), ('3D', '$num3D'), ('Paintings', '$numPaint'), ('Photography', '$numPhoto')";
        $run = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM temp";
        $run = mysqli_query($conn, $sql);
    }
    
	// 3. Number of participants in each category
    if (isset($_GET["participant"])){
        $sql = "SELECT COUNT(entryID) FROM competition C INNER JOIN entry E ON C.compID = E.compID WHERE category = '2D' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $num2D = $res["COUNT(entryID)"];
        }

        $sql = "SELECT COUNT(entryID) FROM competition C INNER JOIN entry E ON C.compID = E.compID WHERE category = '3D' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $num3D = $res["COUNT(entryID)"];
        }

        $sql = "SELECT COUNT(entryID) FROM competition C INNER JOIN entry E ON C.compID = E.compID WHERE category = 'Paintings' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $numPaintings = $res["COUNT(entryID)"];
        }

        $sql = "SELECT COUNT(entryID) FROM competition C INNER JOIN entry E ON C.compID = E.compID WHERE category = 'Photography' ";
        $run = mysqli_query($conn, $sql);
        while ($res = mysqli_fetch_assoc($run)){
            $numPhotography = $res["COUNT(entryID)"];
        }
        
        $sql = "CREATE TEMPORARY TABLE temp (Title varchar(30) NOT NULL, Amount int NOT NULL)";
        $run = mysqli_query($conn, $sql);

        $sql = "INSERT INTO temp (Title, Amount) VALUES ('2D', '$num2D'), ('3D', '$num3D'), ('Paintings', '$numPaintings'), ('Photography', '$numPhotography')";
        $run = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM temp";
        $run = mysqli_query($conn, $sql);
    }

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
          ['Title', 'Amount'],

          <?php
            while ($data = mysqli_fetch_assoc($run)){
                echo "['".$data['Title']."', ".$data['Amount']."], ";
            }
          ?>

        ]);

        var options = {
            <?php if (isset($_GET["user"])){ ?>
                title: 'Users of Virtual X Competition System',
            <?php }elseif (isset($_GET["competition"])) { ?>
                title: 'Competitions Held in Virtual X Competition System',
            <?php }elseif (isset($_GET["participant"])){ ?>
                title: 'Participants of Each Category',
            <?php } ?>
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

    </script>

</head>
<body>

    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-header">
                    <center><h3>
                        <?php if (isset($_GET["user"])){
                            echo "Users of Virtual X Competition";
                        }elseif (isset($_GET["competition"])){
                            echo "Competitions Held in Virtual X Competition System";
                        }elseif (isset($_GET["participant"])){
                            echo "Participants of Each Category";
                        } ?>
                    </h3></center>
                </div>
                <div class="card-body">
                    <div id="piechart_3d" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <br><br>

</body>
</html>

<?php include("partials/footer.php"); ?>