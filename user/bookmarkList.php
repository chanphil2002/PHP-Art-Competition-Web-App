<?php
    include ("partials/database.php");
    include ("partials/header.php");

    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ../general/registeredUserLogin.php");
    }

    $sql1 = "SELECT * FROM bookmark_comp WHERE userEmail = '$_SESSION[user]' ";
    $res1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../judge/judge.css">
</head>
<body>
    <br>

    <h2 style="margin-left: 20px; color: darkblue; text-decoration: underline; text-align: center">Bookmarked Competitions</h2>

    <div class="container" style="max-width: 1320px">
        <div class="row">
            <?php
                if (($num = mysqli_num_rows($res1)) == 0){
                    echo "<h3 class='text-success' style='margin-left:20px'><br>Currently No Related Competition.</h3>";
                }else{
                    while ($bookmarkRecord = mysqli_fetch_assoc($res1)){
                        $compID = $bookmarkRecord["compID"];
                        $sql2 = "SELECT * FROM competition C INNER JOIN organizer O ON C.organizerID = O.organizerID WHERE compID = '$compID' ";
                        $res2 = mysqli_query($conn, $sql2);
                    
                        while ($compDetails = mysqli_fetch_assoc($res2)){
                            $comp = $compDetails["compID"];
                            $pic = $compDetails["compPic"];
                            $name = $compDetails["compName"];
                            $org = $compDetails["organizerName"];
                            $status = $compDetails["status"];
                            $category = $compDetails["category"];
            ?>

            <div class="col-md-4 margincon1">
                <div class="card border-1 grid-list">
                    <a href="compDetails.php?compID=<?php echo $comp; ?>" class="stretched-link">
                        <?php if ($status == "Upcoming"){ ?>
                                <span class="badge rounded-pill position-absolute bg-danger end-0" style="height:20px">Upcoming</span>
                        <?php } elseif ($status == "Past"){ ?>
                            <span class="badge rounded-pill position-absolute bg-dark end-0" style="height:20px">Past</span>
                        <?php } ?>
                        <img class="card-img-top lazy" src="../materials/compPic/<?php echo $pic; ?>">
                    </a>
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
                    </div>
                </div>
            </div>

            <?php }}} ?>
        </div>
    </div>

    <br>
</body>
</html>

<?php include ("partials/footer.php"); ?>