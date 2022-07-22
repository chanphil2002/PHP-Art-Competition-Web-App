<?php 
include("../admin/partials/header.php");

$check = "SELECT * FROM feedback WHERE feedbackType = 'Admin' ";
$run = mysqli_query($conn, $check);
?>

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
                <div style="margin-bottom: 3em; margin-top: 25px">
                    <h2>Feedback</h2><br>
                    <!-- No Admin Feedback -->
                    <?php if (mysqli_num_rows($run) == 0){
                        echo "<h2 class='text-primary'>Currently there are no feedbacks.</h2>";

                    }else{
                        // Unresolved Admin Feedback
                        $sql = "SELECT * FROM feedback WHERE feedbackType = 'Admin' AND status = 'unresolved' ";
                        $run = mysqli_query($conn, $sql);

                        while ($records = mysqli_fetch_assoc($run)){

                            $org = $records["organizerID"];
                            // $query = "SELECT * FROM organizer WHERE organizerID = '$org' ";
                            // $res = mysqli_query($conn, $query);
                            // $data = mysqli_fetch_assoc($res);
                            // $orgEmail = $data["organizerEmail"];

                            $user = $records["userEmail"];
                            $desc = $records["description"];
                            $feedbackID = $records["feedbackID"];

                            if ($user == NULL){
                                $t = "OrganizerID: ";
                            }elseif ($org == NULL){
                                $t = "User Email: ";
                            }

                            // print
                            echo "
                            <div class = 'card'>
                                <div class='card-body'>
                                    <h3 style='word-wrap: break-word; font-weight: bold;'>
                                        <span class='badge bg-secondary'> Feedback </span> 
                                        $t $user $org 
                                    </h3>

                                    <h3>$desc</h3>
                                        
                                    <form action='' method='POST'>
                                        <input type='hidden' name='feedbackID' value='$feedbackID'>
                                        <button name='submit' type='submit' class='btn btn-primary'>Resolve</button>
                                    </form>
                                </div>
                            </div>
                            ";
                        }

                        // Resolved Admin Feedback
                        $sql = "SELECT * FROM feedback WHERE feedbackType = 'Admin' AND status = 'resolved' ";
                        $run = mysqli_query($conn, $sql);

                        while ($records = mysqli_fetch_assoc($run)){

                            $org = $records["organizerID"];
                            // $query = "SELECT * FROM organizer WHERE organizerID = '$org' ";
                            // $res = mysqli_query($conn, $query);
                            // $data = mysqli_fetch_assoc($res);
                            // $orgEmail = $data["organizerEmail"];

                            $user = $records["userEmail"];
                            $desc = $records["description"];
                            $feedbackID = $records["feedbackID"];

                            if ($user == NULL){
                                $t = "OrganizerID: ";
                            }elseif ($org == NULL){
                                $t = "User Email: ";
                            }

                            // print
                            echo "
                            <div class = 'card'>
                                <div class='card-body bg-success'>
                                    <h3 class='text-white' style='word-wrap: break-word; font-weight: bold;'>
                                        <span class='badge bg-secondary'> Feedback </span> 
                                        $t $user $org
                                    </h3>

                                    <h3>$desc</h3>
                                </div>
                            </div>
                            ";
                        }
                    } ?>                            
                    
                    <?php                     
                    if (isset($_POST['submit'])) {
                        $feedbackID = $_POST['feedbackID'];
                        $sql1 = "UPDATE feedback SET
                                status = 'resolved' WHERE feedbackID = $feedbackID";
                   
                        $res1 = mysqli_query($conn, $sql1);
                   
                        if ($res1 == true) {
                           echo "<script>alert('The feedback has been resolved.')
                           location = 'viewfeedback2.php' </script>";
                        }}
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include("../admin/partials/footer.php") ?>