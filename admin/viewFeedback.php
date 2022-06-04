<?php include("../admin/partials/header.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="organizer.css" rel="stylesheet">
    <title>View Feedback</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div style="margin-bottom: 3em;">
                    <h2>Feedback</h2>
                    <!-- display all the unresolved feedbacks -->
                    <?php
                    $sql = "SELECT * FROM feedback WHERE feedbackType = 'Admin' AND status = 'unresolved'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $feedbackID = $row['feedbackID'];
                            $feedbackType = $row['feedbackType'];
                            $description = $row['description'];
                            $userEmail = $row['userEmail'];
                            $organizerID = $row['organizerID'];
                            $status = $row['status'];

                            if($organizerID != ""){
                                $sql2 = "SELECT * FROM organizer WHERE organizerID = '$organizerID'";
                                $res2 = mysqli_query($conn, $sql2);
                                while ($row_organizer = mysqli_fetch_assoc($res2)){
                                    $email = $row_organizer['organizerEmail'];
                                }
                            } else if ($userEmail != ""){
                                $email = $userEmail;
                            }

                            if ($status != 'resolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body'>
                                    <h3 style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-secondary'> Feedback </span> $email 
                                    <h3>$description</h3>
                                    <form action='' method='POST'>
                                    <input type='hidden' name='feedbackID' value='$feedbackID'>
                                    <button name='submit' type='submit' class='btn btn-primary'>Resolve</button>
                                    </form>
                                    </h3>
                                    </div>
                                </div>
                                ";

                        }}
                    
                    // display all the resolved feedback
                    $sql2 = "SELECT * FROM feedback WHERE feedbackType = 'Admin' AND status = 'resolved'";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    if ($count2 > 0) {
                        while ($row = mysqli_fetch_assoc($res2)) {
                            $feedbackID = $row['feedbackID'];
                            $feedbackType = $row['feedbackType'];
                            $description = $row['description'];
                            $userEmail = $row['userEmail'];
                            $organizerID = $row['organizerID'];
                            $status = $row['status'];

                            if($organizerID != ""){
                                $sql2 = "SELECT * FROM organizer WHERE organizerID = '$organizerID'";
                                $res2 = mysqli_query($conn, $sql2);
                                while ($row_organizer = mysqli_fetch_assoc($res2)){
                                    $email = $row_organizer['organizerEmail'];
                                }
                            } else if ($userEmail != ""){
                                $email = $userEmail;
                            }
                            
                            if ($status != 'unresolved') {
                                echo
                                "
                                <div class='card'>
                                    <div class='card-body bg-success'>
                                    <h3 class='text-white' style='word-wrap: break-word; font-weight: bold;'>
                                    <span class='badge bg-secondary'> Feedback </span> $email 
                                    <h3 class='text-white'>$description </h3> 
                                    </h3>
                                    </div>
                                </div>
                                ";
                            }
                        }}
                    } else {
                        echo "<h2 class='text-primary'>Currently there are no feedbacks.</h2>";
                    }
                     
                    if (isset($_POST['submit'])) {
                        $feedbackID = $_POST['feedbackID'];
                        $sql1 = "UPDATE feedback SET
                                status = 'resolved' WHERE feedbackID = $feedbackID";
                   
                        $res1 = mysqli_query($conn, $sql1);
                   
                        if ($res1 == true) {
                           echo "<script>alert('The feedback has been resolved.')
                           location = 'viewfeedback.php' </script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include("../admin/partials/footer.php") ?>