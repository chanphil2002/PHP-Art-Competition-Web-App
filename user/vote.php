<?php
    include ("partials/database.php");
    session_start();

    $sql = "INSERT INTO votehistory (userEmail, entryID) VALUES ('$_SESSION[user]', $_GET[entryID])";
    $res = mysqli_query($conn, $sql);

    if ($res){
        $sql = "SELECT * FROM entry WHERE entryID = '$_GET[entryID]' ";
        $res = mysqli_query($conn, $sql);
        while ($entryDetails = mysqli_fetch_assoc($res)){
            $vote = $entryDetails["vote"];
        }
        $newVote = $vote + 1;
        $sql = "UPDATE entry SET vote = '$newVote' WHERE entryID = '$_GET[entryID]' ";
        $res = mysqli_query($conn, $sql);

        echo "<script>
        alert ('Vote successfully!')
        location = 'entry.php?entryID=$_GET[entryID]&compID=$_GET[compID]'
        </script>";
    }else{
        echo "<script>
        alert ('Fail to vote! Please try again.')
        location = 'entry.php?entryID=$_GET[entryID]&compID=$_GET[compID]'
        </script>";
    }
?>