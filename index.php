<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ECM1417 Coursework | Home</title>

        <meta content="width=device-width, initial-scale=1"/>

        <link rel="stylesheet" type="text/css" href="indexCSS.css">
        <link rel="stylesheet" type="text/css" href="navbarCSS.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
    
    <body>
        <nav class="navbar">
            <div>
                <ul class=menu>
                    <li class="left">
                        <a class="nav-link">Home</a>
                    </li>
                    <?php
                        if (isset($_COOKIE["user"])){
                    ?>
                        <li class="right">
                            <a class="nav-link" href="leaderboard.php">Leaderboard</a>
                        </li>
                        <li class="right">
                            <a class="nav-link" href="pairsGame.php">Play Pairs</a>
                        </li>
                    <?php
                        } else {
                    ?>
                        <li class="right">
                            <a class="nav-link" href="pairsGame.php">Play Pairs</a>
                        </li>
                        <li class="right">
                            <a class="nav-link" href="registration.php">Register</a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </nav>

        <div class="background">
            <img src="arcade-unsplash.jpg" alt="">
        </div>

        <div class="mainDiv">
            <div class="secondDiv">
                <h1>Welcome to Pairs</h1>
                <?php
                    if (isset($_COOKIE["user"])){
                ?>
                    <div class="signedIn">
                        <a href="pairsGame.php">Click Here To Play</a>
                        <br/><br/>
                    </div>
                <?php
                    } else {
                ?>
                    <div class="notSignedIn">
                        You Are Not Using Registered Session?
                        <br/>
                        <a href="registration.php">Register Now</a>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>