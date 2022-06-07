<?php
    include("partials/database.php");
    session_start();

    $sql = "SELECT * FROM bookmark_comp WHERE compID = '$_GET[compID]' AND userEmail = '$_SESSION[user]' ";
    $run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($run) != 0){
        echo "<script>
            alert ('Competition is added into Favourite!')
            location = 'bookmarkList.php'
            </script>";
    }else{
        $sql = "INSERT INTO bookmark_comp (compID, userEmail) VALUES ('$_GET[compID]', '$_SESSION[user]')";
        $run = mysqli_query($conn, $sql);
    
        if ($run){
            echo "<script>
            alert ('Competition is added into Favourite!')
            location = 'bookmarkList.php'
            </script>";
        }else{
            echo "<script>
            alert ('Oops, something wrong, please try again.')
            location = 'compDetails.php?compID=$_GET[compID]'
            </script>";
        }
    }
?>

