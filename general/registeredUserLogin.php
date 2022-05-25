<?php
    include ("partials/database.php");

    session_start();

    if (isset($_POST["submit"])){
        // Get email and password entered: 
        $id = $_POST["userEmail"];
        $pw = $_POST["password"];

        $sql = "SELECT * FROM user WHERE userEmail = '$id' AND userPassword = '$pw' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1){
            // Account found, email and password matched: 
            $accDetails = mysqli_fetch_assoc($result);
            $_SESSION["user"] = $accDetails["userEmail"];
            unset($_SESSION["admin"]);
            unset($_SESSION["organizer"]);
            unset($_SESSION["judge"]);
            header("Location:../user/homepage.php?id=$id");
            
        }else{
            // email and password not matched:
            echo '<script>alert("Wrong Email or Password entered, please try again.")</script>';
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="login.css" />
</head>

<body>

    <div class="login-box" align="center">
        <img class="logo" align="center" src="partials/logo.png" alt="VirtualX_Logo">
        
        <h1>User</h1>

        <form method="POST" action="">
            <div class="txt_field">
                <input name="userEmail" type="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input name="password" type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <button class="btn btn-primary" type="submit" name="submit" value="login">Log In</button>
            <br><br> 
        </form>

        <div class="link">
            <div><a href="../guest/homepage.php">Continue as Guest</a></div>
            <div><a href="loginRole.php">Login as Admin/Organizer/Judge</a></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>