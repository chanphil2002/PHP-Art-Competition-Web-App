<?php include ("../admin/partials/header.php");

if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
};
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Application List</title>
    <link rel="stylesheet" href="view.css"/>
</head>
<body>
    <div>
        <strong>
            <br><center><h2>Organizer Application List</h2></center><br>
        </strong>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pendingOrganizer.php">Pending</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="approvedOrganizer.php">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rejectedOrganizer.php">Rejected</a>
            </li>
        </ul>
    </div>
    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Organizer ID</th>
                    <th>Organizer Name</th>
                    <th>Organizer Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sum = 0;
                    $sql = "SELECT * FROM organizer WHERE organizerStatus = 'pending'";
                    $result = mysqli_query($conn, $sql); 
                    if (mysqli_num_rows($result) == 0){
                        echo "<h3>Currently No Related Record.</h3>"; 
    
                    } else {
                        while($row_organizer = mysqli_fetch_assoc($result)){
                            $id = $row_organizer['organizerID'];
                            $email = $row_organizer['organizerEmail'];
                            $name = $row_organizer['organizerName'];
                            $desc = $row_organizer['organizerDesc'];
                            $profilePic = $row_organizer['organizerProfilePic'];
                            $doc = $row_organizer['organizerVerifiedDoc'];
                            $status = $row_organizer['organizerStatus'];
                            $sum = $sum + $count;
                    ?>
                    <tr>
                        <td data-label="no"><?php echo $sum?></td>
                        <td data-label="id"><?php echo $id?></htd>
                        <td data-label="name"><?php echo $name?></td>
                        <td data-label="email"><?php echo $email?></td>
                        <td data-label="status"><?php echo $status?></td>
                        <td data-label="Action">
                            <a href="viewOrganizerDetails.php?selectedOrganizer=<?php echo $id?>"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>