<?php include("../admin/partials/header.php"); 
if (!isset($_SESSION["admin"])){
    header("Location: ../general/otherRoleLogin.php");
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User</title>
    <link rel="stylesheet" href="view.css" />

    <style>
        .search {
            padding: 12px 0;
            margin: 12px 25%;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
            color: #212121;
            background: #eaeaea;
            border-radius: 2px;
        }

        .search>input {
            flex: 1;
            width: 100%;
            padding: 0 12px;
            font-size: 14px;
            line-height: 22px;
            border: 0;
            outline: none;
            background-color: inherit;
        }
    </style>
</head>

<body>
    <div>
        <br>
        <center>
            <br><h2>Search User</h2>
        </center>
    </div>
    <div>
        <form class="search" method="post">
            <input type="text" placeholder="Search..." name="search" required>
        </form>
        <br>
    </div>
    <div>
        <hr><br>
        <center>
            <h3>Search Result</h3><br><br>
        </center>
    </div>
</body>

</html>
<?php
if (isset($_POST["search"])) {

    $search = $_POST['search'];
    $sql = "SELECT * FROM user WHERE username LIKE '%$search%' OR userEmail LIKE '%$search%'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) != 0){
        $role = "user";
        if($role == "user"){
            ?>
            <div class="body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>DoB</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
            <?php
        }
    }
   
    if (mysqli_num_rows($res) != 0) {
        while ($rowUser = mysqli_fetch_assoc($res)) {
            $username = $rowUser['username'];
            $email = $rowUser['userEmail'];
            $dob = $rowUser['DoB'];
            $gender = $rowUser['gender'];
            $phone = $rowUser['phoneNum'];

?>
            <!-- <div class="body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>DoB</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead> -->
                    <tr>
                        <td data-label="username"><?php echo $username ?></td>
                        <td data-label="email"><?php echo $email ?></td>
                        <td data-label="dob"><?php echo $dob ?></td>
                        <td data-label="gender"><?php echo $gender ?></td>
                        <td data-label="phone"><?php echo $phone ?></td>
                        <td data-label="Action">
                            <a href="editUser.php?editEmail=<?php echo $email ?>"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
            <?php } else {
            $sql2 = "SELECT * FROM organizer WHERE organizerName LIKE '%$search%' OR organizerID LIKE '%$search%' OR organizerEmail LIKE '%$search%'";
            $res2 = mysqli_query($conn, $sql2);
            
            if (mysqli_num_rows($res2) != 0){
                $role = "organizer";
                if ($role == "organizer"){
                    ?>
                    <div class="body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Organizer ID</th>
                                        <th>Organizer Name</th>
                                        <th>Organizer Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                    <?php
                }
            }
           
            if (mysqli_num_rows($res2) != 0) {
                while ($rowOrganizer = mysqli_fetch_assoc($res2)) {
                    $id = $rowOrganizer['organizerID'];
                    $email = $rowOrganizer['organizerEmail'];
                    $name = $rowOrganizer['organizerName'];
                    $status = $rowOrganizer['organizerStatus'];
            ?>
                    <!-- <div class="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Organizer ID</th>
                                    <th>Organizer Email</th>
                                    <th>Organizer Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> -->
                            <tbody>
                                <tr>
                                    <td data-label="id"><?php echo $id ?></td>
                                    <td data-label="name"><?php echo $name ?></td>
                                    <td data-label="email"><?php echo $email ?></td>
                                    <td data-label="status"><?php echo $status ?></td>
                                    <td data-label="Action">
                                        <a href="viewOrganizerDetails.php?selectedOrganizer= <?php echo $id ?>"><i class="fa-solid fa-eye"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="approvedOrganizer.php?removeID=<?php echo $id ?>"><i class='fas fa-trash-alt' style='color:red'></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
            } else {
                $sql3 = "SELECT * FROM judge WHERE judgeName LIKE '%$search%' OR judgeIC LIKE '%$search%' OR judgeEmail LIKE '%$search%'";
                $res3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($res3) != 0){
                    $role = "judge";
                    if ($role == "judge"){
                        ?>
                        <div class="body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>IC</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                        <?php
                    }
                }
                if (mysqli_num_rows($res3) != 0) {
                    while ($row_judge = mysqli_fetch_assoc($res3)) {
                        $ic = $row_judge['judgeIC'];
                        $name = $row_judge['judgeName'];
                        $email = $row_judge['judgeEmail'];
                    ?>
                        <!-- <div class="body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>IC</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    <tr>
                                        <td data-label="IC"><?php echo $ic ?></td>
                                        <td data-label="Name"><?php echo $name ?></td>
                                        <td data-label="Email"><?php echo $email ?></td>
                                        <td data-label="Action">
                                            <a href="viewJudgeDetails.php?selectedIC=<?php echo $ic ?>"><i class="fa-solid fa-pen"></i></a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="viewJudge.php?removeIC=<?php echo $ic ?>"><i class='fas fa-trash-alt' style='color:red'></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <center>No result found.</center>
                    </div>
    <?php
                }
            }
        }
    } ?>

<?php include("../admin/partials/footer.php") ?>