<?php 
    include ("partials/header.php");
    include ("partials/database.php");

    if (isset($_GET["username"])){
        $sql = "SELECT * FROM user WHERE username = '$_GET[username]' ";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)){
            $userEmail = $row["userEmail"];
            $gender = $row["gender"];
            $profilePic = $row["userProfilePic"];
        }

        $sql = "SELECT * FROM ((competition C INNER JOIN organizer O ON C.organizerID = O.organizerID) INNER JOIN entry E ON E.compID = C.compID) WHERE userEmail = '$userEmail' ";
        $res = mysqli_query($conn, $sql);
    }else{
        header("Location: allComp.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Competitions</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../judge/judge.css">
</head>
<body>
    <br>
    <center><div style="position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 2px solid #08007f;">
        <image src="../materials/userProfilePic/<?php echo $profilePic; ?>" style="width:100% ;height:auto;" class="" alt="...">
    </div></center>
    <h2 style="text-align: center; color: darkblue"><?php echo $_GET["username"]; ?></h2>    

    <br>

    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
                if (($num = mysqli_num_rows($res)) == 0){
                    echo "<h3 class='text-primary' style='margin-left:20px'><br>No record found.</h3>";
                }else{
                    while ($compDetails = mysqli_fetch_assoc($res)){
                        $comp = $compDetails["compID"];
                        $pic = $compDetails["compPic"];
                        $name = $compDetails["compName"];
                        $org = $compDetails["organizerName"];
                        $status = $compDetails["status"];
                        $category = $compDetails["category"];
                        $entry = $compDetails["entryID"];
            ?>

            <div class="col-md-4 margincon1">
                <div class="card border-1 grid-list">
                    <!-- <a href="compDetails.php?compID=<?php echo $comp; ?>" class="stretched-link"> -->
                        <?php if ($status == "Upcoming"){ ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                        <?php } elseif ($status == "Past"){ ?>
                            <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                        <?php } ?>
                        <img class="card-img-top lazy" src="../materials/compPic/<?php echo $pic; ?>">
                    <!-- </a> -->
                    <div class="card-body description text-truncate text-color-2" style="display:inline-block">
                        <?php echo $org; ?>
                        <?php
                            if (!isset($_GET["category"])){
                                echo " / ";
                                echo $category;
                            }
                        ?>
                        <div class="title text-truncate">
                            <?php echo $name; ?>
                        </div>
                        <div style="text-align:right">
                            <br>
                            <a href="entry.php?entryID=<?php echo $entry; ?>&compID=<?php echo $comp; ?>">
                                <button type="button" class="btn btn-outline-success">
                                    View 
                                    <?php if ($gender == "M"){
                                        echo "His ";
                                    }else{
                                        echo "Her ";
                                    } ?>
                                    Entry
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php }} ?>
        </div>
    </div>

    <br>
</body>
</html>

<?php include ("partials/footer.php"); ?>