<?php include("../judge/partials/database.php");
// session_start();
$autorejectstatus = "UPDATE competition
    SET status = 'Rejected' WHERE CURDATE() >= releaseDate AND status = 'Pending'";
$ongoingstatus = "UPDATE competition
    SET status = 'On-Going' WHERE releaseDate <= CURDATE() AND registrationDeadline >= CURDATE() AND status = 'Upcoming'";
$paststatus = "UPDATE competition
    SET status = 'Past' WHERE CURDATE() >= registrationDeadline AND status = 'On-Going'";
$autorejectres = mysqli_query($conn, $autorejectstatus);
$ongoingres = mysqli_query($conn, $ongoingstatus);
$pastres = mysqli_query($conn, $paststatus);
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
  <link rel="stylesheet" href="../judge/partials/header.css">
</head>

<body>
  <nav class="navbar navbar-dark bg-secondary bg-gradient sticky-top px-5">

    <a class="navbar-brand ml-5" href="../judge/judgehomepage.php">
      <img src="../judge/partials/logo.png" alt="Virtual" width="200">
    </a>
    <form action="../judge/judge.php" method="POST" class="d-flex">
      <input class="form-control me-2 mr-sm-2 col-md-5 ml-5" type="search" name="search" placeholder="Interested in Anything?">
      <input type="submit" name="submit" value="Search" class="btn btn-outline-light my-2 my-sm-0">
    </form>
    <nav class="navbar navbar-expand-xl">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="btn btn-info" href="../judge/judgehomepage.php" role="button"><i class="fa-solid fa-trophy"></i>&nbsp; My Competitions</a>&nbsp;&nbsp;&nbsp;
        </li>

        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle"></i>&nbsp; My Account
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="../judge/judgeprofile.php">My Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logout">
                  <i class="fa-solid fa-right-from-bracket"></i>&nbsp; Log Out
                </button>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </nav>

  <!-- Modal for Log Out-->
  <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="exampleModalLabel">Log Out</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to <b>Log Out</b> from this judge account?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" class="btn btn-danger" href="../general/logout.php">LOG OUT</a>
        </div>
      </div>
    </div>
  </div>