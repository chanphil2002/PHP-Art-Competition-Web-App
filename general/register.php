<?php
    include ("partials/database.php");

    session_start();

    if (isset($_POST["submit"])){
        $email = $_POST["userEmail"];
        $username = addslashes($_POST["username"]);
        $pw = addslashes($_POST["password"]);
        $cpw = addslashes($_POST["cfmpassword"]);
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
    <!-- <link rel="stylesheet" type="text/css" href="register.css"/> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');

* {
  font-family: "Roboto", sans-serif;
  font-weight: 500;
  box-sizing: border-box;
  /* margin: 100px; */
  /* padding: 0; */
  text-decoration: none;
  /* background-color: #BDE6F1; */
}

html {
  overflow-y : scroll;
  background-color: #BDE6F1;
  }

body {
  background-color: #BDE6F1;
}

  .login-box li, button {
    font-size: 16px;
    color: #ffffff;
    text-decoration: none;
}

.login-box a{
  color: #666;
  font-weight: 600;
  font-size: 13px;
  margin-bottom: 3px;
  font-family: 'Open Sans', sans-serif;
}

.login-box{
    padding: 2em;
    position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    border-radius: 10px;
    box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
    margin-top: 3px;
  }
  .login-box h1{
    font-size: 2em;
    text-align: center;
    padding: 20px 0;
    border-bottom: 1px solid silver;
  }
  .login-box form{
    padding: 0 40px;
    box-sizing: border-box;
  }
  form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
  }
  .txt_field input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
  }
  .txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
  }
  .txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #08007f;
    transition: .5s;
  }

  .txt_field input:focus ~ label,
  .txt_field input:valid ~ label{
    top: -5px;
    color: #08007f;
  }

  .txt_field input:focus ~ span::before,
  .txt_field input:valid ~ span::before{
    width: 100%;
  }

  form .date{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
  }
  .date input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
  }
  .date label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-160%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
  }
  .date span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #08007f;
    transition: .5s;
  }

  .date input:focus ~ label,
  .date input:valid ~ label{
    /* top: -5px; */
    color: #08007f;
  }

  .date input:focus ~ span::before,
  .date input:valid ~ span::before{
    width: 100%;
  }

  .login-box select {
    /* Reset Select */
    appearance: none;
    outline: 0;
    border: 0;
    box-shadow: none;
    /* Personalize */
    flex: 1;
    padding: 0 1em;
    /* color: #08007f; */
    background-color: #cacaca;
    /* border-color: #004cef; */
    cursor: pointer;
  }
  /* Remove IE arrow */
  .login-box select::-ms-expand {
    display: none;
  }
  /* Custom Select wrapper */
  .login-box .select {
    position: relative;
    display: flex;
    width: 16em;
    height: 2em;
    margin-bottom: 0.1em;
    border-radius: .25em;
    overflow: hidden;
  }
  /* Arrow */
  .login-box .select::after {
    content: '\25BC';
    color: #fff;
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.4em;
    background-color: #adadad;
    transition: .25s all ease;
    pointer-events: none;
    /* height: 2em; */
  }
  /* Transition */
  .login-box .select:hover::after {
    /* color: #a38599; */
    color: #000000;
  }

.collapse {
    font-size: 2em;
    margin-right: 5em;
}

.nav-item {
    padding-left: 2em;
    z-index: 999;
}

.logout {
    margin-left: 3em;
}

/* Logo */
.logo {
    width: 250px;
}

/* Login CSS */
/* .login_page {
    background-color: rgba(189, 74, 118, 30%);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
} */


button {
    padding: 9px 25px;
    /* background-color: #E63E6D; */
    margin: 5px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
    width: 200px;
}

button:not(.close):hover {
    border-color: #15027e;
    background-color: #160287;
  }

.custom-container {
    max-width: 700px;
    width: 100%;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 5px;

}

.inactiveLink {
  pointer-events: none;
  cursor: default;
}

.link {
    text-align: right;
    padding-right: 40px;
}
    </style>
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
                <input name="dob" type="date" max="<?php echo date("Y-m-d"); ?>" required>
                <span></span>
                <label>Date of Birth *</label>
            </div>
            <div class="select">
                <select name="gender" required>
                    <option value="">Gender *</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <br>            
            <button class="btn btn-primary" type="submit" name="submit" value="login" style="width:120px">Sign Up</button>
            <br><br>
        </form>

        <div class="link">
            <div><a href="registeredUserLogin.php">User Login</a></div>
            <div><a href="../index.php">Continue as Guest</a></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>