<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ECM1417 Coursework | Pairs</title>

        <meta content="width=device-width, initial-scale=width"/>

        <link rel="stylesheet" type="text/css" href="pairsGameCSS.css">
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

        <div class="wrapper">
            <div class="stats-container">
                <div id="moves-count"></div>
                <div id="time"></div>
                <div id="level-score"></div>
                <div id="overall-score"></div>
                <div id="level"></div>
            </div>

            <div class="game-container"></div>

            <button id="stop" class="hide">Stop Game</button>
        </div>

        <div class="controls-container">
            <p id="result"></p>
            <button id="start">Start Game</button>
        </div>

        <script src="pairsGameScript.js"></script>
    </body>
</html>