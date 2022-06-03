<?php include("../admin/partials/database.php"); ?>

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
    <link rel="stylesheet" href="../user/partials/header.css">

</head>
<body>
    <nav class="navbar navbar-dark bg-secondary bg-gradient sticky-top px-5">
        <a class="navbar-brand ml-5" href="pendingComp.php">
            <img src="../user/partials/logo.png" alt="Virtual" width="200">
        </a>

        <nav class="navbar navbar-expand-xl">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-info" href="pendingComp.php" role="button"><i class="fa-solid fa-trophy"></i>&nbsp; Manage Competitions</a>&nbsp;&nbsp;&nbsp;
                </li>

                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>&nbsp;Manage Users
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="pendingOrganizer.php">Organizer</a></li>
                            <li><a class="dropdown-item" href="viewJudge.php">Judge</a></li>
                            <li><a class="dropdown-item" href="viewUser.php">User</a></li>
                        </ul>
                    </div>
                </li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item"> 
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="pendingOrganizer.php">Competition</a></li>
                            <li><a class="dropdown-item" href="searchUser.php">User</a></li>
                        </ul>
                    </div>
                </li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a class="btn btn-danger" href="../general/logout.php" role="button"><i class="fa-solid fa-right-from-bracket"></i>&nbsp; Sign Out</a>
                </li>
            </ul>
        </nav>
    </nav>
