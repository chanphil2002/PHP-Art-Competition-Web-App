<?php include("../organizer/partials/database.php"); ?>
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
  <nav class="navbar navbar-dark bg-secondary bg-gradient fixed-top px-5">
    
    <a class="navbar-brand ml-5" href="../organizer/orghome.php">
      <img src="../organizer/partials/logo.png" alt="Virtual" width="200">
    </a>
    <form action="     " method="POST" class="d-flex">
      <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Interested in Anything?">
      <input type="submit" name="submit" value="Search" class="btn btn-outline-light my-2 my-sm-0">
    </form>
    <nav class="navbar navbar-expand-xl">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="btn btn-info" href="     " role="button"><i class="fa-solid fa-trophy"></i>&nbsp; My Competition</a>&nbsp;&nbsp;&nbsp;
        </li>

        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle"></i>&nbsp; My Account
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="#">My Profile</a></li>
              <li><a class="dropdown-item" href="#">Favourite</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="#">Log Out</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
<<<<<<< Updated upstream
  </nav>
<<<<<<< Updated upstream

  <div class="mt-5 mb-5 pt-5"></div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
      </div>
      <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>


=======



<div class="mb-5"></div>

    
>>>>>>> Stashed changes





    </div>
  </div>
=======
  </nav>
>>>>>>> Stashed changes
