<?php include ("../admin/partials/database.php");?>
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
  <link rel="stylesheet" href="../guest/partials/header.css">

</head>
<body>
  <nav class="navbar navbar-dark bg-secondary bg-gradient fixed-top px-5">
    
    <a class="navbar-brand ml-5" href="    ">
      <img src="../guest/partials/logo.png" alt="Virtual" width="200">
    </a>
    <form action="     " method="POST" class="d-flex">
      <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Interested in Anything?">
      <input type="submit" name="submit" value="Search" class="btn btn-outline-light my-2 my-sm-0">
    </form>
    <nav class="navbar navbar-expand-xl">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="btn btn-success px-4" href="../general/registeredUserLogin.php" role="button"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Log In</a>&nbsp;&nbsp;&nbsp;
        </li>

        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-plus"></i>&nbsp; Sign Up As
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="../general/register.php">User</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="organizerRegister.php">Organizer</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </nav>
  
<div class= "mt-5 mb-5 pt-5" ></div>
