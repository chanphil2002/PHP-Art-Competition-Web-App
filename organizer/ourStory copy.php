<?php include ("../admin/partials/header.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story</title>

    <style>
    /* Container holding the image and the text */
    .container {
    position: relative;
    /* text-align: center; */
    color: white;
    }

    /* Top left text */
    .top-left {
    position: absolute;
    top: 40px;
    left: 60px;
    }

    /* Bottom right text */
    .bottom-right {
    position: absolute;
    top: 55%;
    left: 55%;
    transform: translate(-15%, -5%);
    text-align: justify;
    color: whitesmoke;
    }

    /* Centered text */
    .centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-86%, -100%);
    color: whitesmoke;
    text-align: left;
    }
    .flex-row {
    align-items: flex-start;
    display: flex;
    height: 500px;
    margin-right: 200px;
    margin-top: 1px;
    min-width: 1197px;
    text-align: justify;
    }
    </style>
</head>
<body>
    <div class="container">
        <img class="img" src="../admin/partials/ourStory.png" alt="Responsive image" height="500" width="100%" style="object-fit: cover;">
        <h1 class="top-left">About Us</h1>
        <h3 class="centered">
            Our mission of “Show your creation to the whole world.” is to gather art lovers from all over the world, 
            provide the best platform to make it easy to hold and join art competitions, and show their creativity to the world.
        </h3>
        <h3 class="bottom-right">Our vision is to become a leading and competitive virtual competition platform, 
            and achieve higher shareholder value by becoming the preferred virtual competition platform for conducting virtual art competition.
        </h3>
    </div>
    <div>
        <br>
        <br>
        <h2 style="margin-left:6% ;">Our Story</h2><br>
                <div class="flex-row">
                    <img style="width:30%;margin-left:5%" src="../admin/partials/logo.png">
                    <div>
                        <h3 style="margin-right: 3%;">Virtual-X was founded in June 2022, and it is the largest virtual competition platform for art in Malaysia. 
                        We support all kinds of art competitions and hold nearly one hundred online art competitions in cooperation with many famous organizations
                        such as Coca-cola, The One Academy and Adidas Malaysia. 
                        </h3>
                    </div>
                </div>
    </div>
</body>
</html>
<?php include ("../admin/partials/footer.php")?>