<?php include ("../admin/partials/header.php");

    session_start();
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
            <center><h2>Competition Application List</h2></center><br>
        </strong>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="pendingComp.php">Pending</a>
            </li>
             <li class="nav-item">
                <a class="nav-link active" href="approvedComp.php">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rejectedComp.php">Rejected</a>
            </li>
        </ul>
    </div>
    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Competition ID</th>
                    <th>Competition Name</th>
                    <th>Organizer Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sum = 0;
                    $sql = "SELECT * FROM competition WHERE status = 'Approved'";
                    $result = mysqli_query($conn, $sql); 
                    while($row_comp = mysqli_fetch_assoc($result)){
                        $id = $row_comp['compID'];
                        $name = $row_comp['compName'];
                        $organizer = $row_comp['organizerID'];
                        $category = $row_comp['category'];
                        $status = $row_comp['status'];
                        $sum = $sum + $count;

                    $sql2 = "SELECT organizerName FROM organizer WHERE organizerID = $organizer";
                    $result2 = mysqli_query($conn, $sql2);
                    while($row_organizer = mysqli_fetch_assoc($result2)){
                        $organizerName = $row_organizer['organizerName'];
                    }
                ?>
                <tr>
                    <td data-label="No"><?php echo $sum?></td>
                    <td data-label="id"><?php echo $id?></htd>
                    <td data-label="name"><?php echo $name?></td>
                    <td data-label="organizer"><?php echo $organizerName?></td>
                    <td data-label="category"><?php echo $category?></td>
                    <td data-label="status"><?php echo $status?></td>
                    <td data-label="Action">
                        <a href="viewCompDetails.php?selectedComp=<?php echo $id?>"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>