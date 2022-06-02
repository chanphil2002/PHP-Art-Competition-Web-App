<?php include("../admin/partials/header.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Competition</title>

    <style>
        .search {
            padding: 12px 0;
            margin: 12px 25%;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
            color: #212121;
            background: #eaeaea;
            border-radius: 2px;
        }

        .search>input {
            flex: 1;
            width: 100%;
            padding: 0 12px;
            font-size: 14px;
            line-height: 22px;
            border: 0;
            outline: none;
            background-color: inherit;
        }
    </style>

</head>
<body>
    <div>
        <br><br>
        <form class="search" method="post">
            <input type="text" placeholder="Search..." name="search">
        </form>
        <br>
    </div>
    <div>
    <div class="col-12 col-competition-2">
    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
    </div>
    </div>
</body>
</html>
<?php include("../admin/partials/footer.php") ?>