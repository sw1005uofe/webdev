<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ECM1417 Coursework | Leaderboard</title>

        <meta content="width=device-width, initial-scale=1"/>

        <link rel="stylesheet" type="text/css" href="leaderboardCSS.css">
        <link rel="stylesheet" type="text/css" href="navbarCSS.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
    
    <body>
        <nav class="navbar">
            <div>
                <ul class=menu>
                    <li class="left">
                        <a class="nav-link" href="indexPHP.php">Home</a>
                    </li>
                    <?php
                    if (isset($_COOKIE["user"])){
                        ?>
                        <li class="right">
                            <a class="nav-link" href="leaderboardPHP.php">Leaderboard</a>
                        </li>
                        <li class="right">
                            <a class="nav-link" href="pairsGamePHP.php">Play Pairs</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="right">
                            <a class="nav-link" href="pairsGamePHP.php">Play Pairs</a>
                        </li>
                        <li class="right">
                            <a class="nav-link" href="registrationPHP.php">Register</a>
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

        <div class="mainBody">
            <select class="form-select">
                <option>High Score</option>
                <option>Level 1 High Scores</option>
                <option>Level 2 High Scores</option>
                <option>Level 3 High Scores</option>
                <option>Level 4 High Scores</option>
                <option>Level 5 High Scores</option>
                <option>Level 6 High Scores</option>
            </select>
        </div>
    </body>
</html>