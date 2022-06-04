<?php include("../organizer/partials/database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Virtual-X</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/388ecdb17f.js" crossorigin="anonymous"></script>
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Magra:wght@400;700&display=swap" rel="stylesheet">
  <!-- CSS Style -->
  <link rel="stylesheet" href="../organizer/partials/header.css">



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


</head>

<body>
  <nav class="navbar navbar-dark bg-secondary bg-gradient sticky-top px-5">

    <a class="navbar-brand ml-5" href="../organizer/orghome.php">
      <img src="../organizer/partials/logo.png" alt="Virtual" width="200">
    </a>
    <form action="../organizer/orgsearch.php" method="POST" class="d-flex">
      <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Interested in Anything?">
      <input type="submit" name="submit" value="Search" class="btn btn-outline-light my-2 my-sm-0">
    </form>
    <nav class="navbar navbar-expand-xl">
      <ul class="navbar-nav">

        <li class="nav-item me-3">
          <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle text-dark border-dark" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-comment"></i>&nbsp; Feedbacks
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="#">View Feedback from User</a></li>
              <li><a class="dropdown-item text-warning" href=""><i class="fa-solid fa-flag"></i>&nbsp; Report to Admin</a></li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle"></i>&nbsp; My Account
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="../organizer/orgprofile.php">My Profile</a></li>
              <li><a class="dropdown-item" href="../organizer/editOrgProfile.php">Edit Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../general/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp; Log Out</a></li>
            </ul>
          </div>
        </li>

      </ul>
    </nav>
  </nav>
