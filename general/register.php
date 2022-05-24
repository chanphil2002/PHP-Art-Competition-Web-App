<?php
    include ("partials/database.php");

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="login.css" />
</head>

<body>
<div class="login-box" align="center" style="margin-top: 75px; margin-bottom: 75px;">
        <img class="logo" align="center" src="partials/logo.png" alt="VirtualX_Logo">
        
        <h1>Register</h1>

        <form method="POST" action="">
            <div class="txt_field">
                <input name="userEmail" type="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input name="username" type="text" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input name="password" type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
                <input name="cfmpassword" type="password" required>
                <span></span>
                <label>Confirm Password</label>
            </div>
            <div class="select">
                <select name="user-type" required>
                    <option value="">Gender</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="submit" value="login">Sign Up</button>
            <br><br> 
        </form>

        <div class="link">
            <div><a href="registeredUserLogin.php">User Login</a></div>
            <!-- <div><a href="loginRole.php">Login as Admin/Organizer/Judge</a></div> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>