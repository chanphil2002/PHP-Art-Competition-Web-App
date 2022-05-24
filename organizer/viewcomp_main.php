<?php include("../organizer/partials/header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="organizer.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <img src="../materials/image/test1.jpg" alt="Responsive image" height="300" style="background-size:cover">
    <ul class="nav nav-pills nav-fill p-2">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="viewcomp_main.php">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_rubric.php">Scoring Rubric</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewcomp_about.php">About</a>
        </li>
    </ul>

    <div class="container">
        <div class="row">
            <div class="col-9">
                <div>
                    <h2 style="display: inline-block">Virtual Competition Arts 2022</h2>
                    <span class="badge text-bg-success align-top even-larger-badge">Ongoing</span>
                </div>
                <h3>By Sunway, ARTS</h3>

                <div class=" row">
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Competition Date</h3>
                                <h2>September 2021</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Scoring Format</h3>
                                <h2><u>50%</u> Public Vote</h2>
                                <h2><u>50%</u> Judge</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 14rem;">
                            <div class="card-body">
                                <h3 class="card-title" style="color:black">Total Prize Pool</h3>
                                <h2>RM5000</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>
                        Description
                    </h2>
                    <ul>
                        <li>No cheating.</li>
                        <li>Only NFT Related Content.</li>
                        <li>All the best.</li>
                    </ul>
                </div>
                <div>
                    <h2>
                        Rules and Regulation
                    </h2>
                    <ul>
                        <li>No cheating.</li>
                        <li>Only NFT Related Content.</li>
                        <li>All the best.</li>
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <h3>&#128101; Join this competition</h3>
                <h3>&#128147; Vote for this</h3>
                <hr>
                <h2><u>Winner</u></h2>
                <img src="../materials/image/download.jpg" alt="">
            </div>
        </div>
    </div>
    <hr>
    <div class="justify-content-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Announcement</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Title</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Description</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-info">View Entries</button>
        <button type="button" class="btn btn-info">View Feedback</button>
    </div>

    <script src="https://kit.fontawesome.com/8deb7b58d3.js" crossorigin="anonymous"></script>
</body>

</html>

<?php include("../organizer/partials/footer.php"); ?>