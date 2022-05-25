<?php
    include ("partials/database.php");

    session_start();

    if (isset($_POST["submit"])){
        $email = $_POST["userEmail"];
        $username = $_POST["username"];
        $pw = $_POST["password"];
        $cpw = $_POST["cfmpassword"];
        $phone = $_POST["phoneNum"];
        $dob = $_POST["dob"];
        $gender = $_POST["gender"];
        
        // Check if both password entered is the same:
        if ($pw == $cpw){

            // Check whether email is registered before:
            $sql = "SELECT * FROM user WHERE userEmail = '$email' LIMIT 1";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0){

                // Email not yet registered:
                $sql = "INSERT INTO user (userEmail, username, userPassword, gender, DoB, phoneNum) VALUES ('$email', '$username', '$pw', '$gender', '$dob', '$phone')";
                $result = mysqli_query($conn, $sql);

                if ($result){

                    // Success: 
                    echo "<script>
                    alert ('Account is registered successfully!')
                    location = 'registeredUserLogin.php'
                    </script>";
                    
                }else {

                    // Fail:
                    echo "<script>
                    alert ('Oops! Something went wrong, please try again.')
                    location = 'register.php'
                    </script>";
                }

            }else {

                // Email registered:
                echo "<script>
                alert ('Email entered is registered. Please proceed to login page.')
                </script>";
            }

        }else {

            // Both password not same:
            echo "<script>
            alert ('Please insert same password in \"Password\" and \"Confirm Password\" field.')
            </script>";
        }
    }

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
    <link rel="stylesheet" type="text/css" href="register.css"/>
</head>

<body>
<div class="login-box" align="center" style="margin-top: 75px; margin-bottom: 75px;">
        <img class="logo" align="center" src="partials/logo.png" alt="VirtualX_Logo">
        
        <h1>User Registration</h1>

        <form method="POST" action="">
            <div class="txt_field">
                <input name="userEmail" type="email" required>
                <span></span>
                <label>Email *</label>
            </div>
            <div class="txt_field">
                <input name="username" type="text" required>
                <span></span>
                <label>Username *</label>
            </div>
            <div class="txt_field">
                <input name="password" type="password" required>
                <span></span>
                <label>Password *</label>
            </div>
            <div class="txt_field">
                <input name="cfmpassword" type="password" required>
                <span></span>
                <label>Confirm Password *</label>
            </div>
            <div class="txt_field">
                <input name="phoneNum" type="text" pattern="[0-9]{3}-[0-9]{7}" required>
                <span></span>
                <label>Phone Number (xxx-xxxxxxx) *</label>
            </div>
            <div class="date">
                <input name="dob" type="date" required>
                <span></span>
                <label>Date of Birth *</label>
            </div>
            <div class="select">
                <select name="gender" required>
                    <option value="">Gender *</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>
            <br>            
            <button class="btn btn-primary" type="submit" name="submit" value="login" style="width:120px">Sign Up</button>
            <br><br>
        </form>

        <div class="link">
            <div><a href="registeredUserLogin.php">User Login</a></div>
            <div><a href="../guest/homepage.php">Continue as Guest</a></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>