<?php
$errors=false;
$nameErr=$faceErr=$mouthErr=$eyesErr="";
$name=$face=$mouth=$eyes="";
$invalidCharacters=['"',"'","!","@","#", "%","&","*", "(",
    ")", "+","=", "{","}","[", "]","—",";",":","<", ">","?","/"];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (empty($_POST["name"])){
        $nameErr="*Name is Required";
        $errors=true;
    } elseif (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._ ]+$/', $_POST["name"])){
        $nameErr = "*Invalid Characters";
        $errors=true;
    } else {
        $name=$_POST["name"];
    }

    if (empty($_POST["face"])){
        $faceErr="*Face Colour Is Required";
        $errors=true;
    } else {
        $face=$_POST["face"];
    }

    if (empty($_POST["eyes"])){
        $eyesErr="*Eye Type Is Required";
        $errors=true;
    } else {
        $eyes=$_POST["eyes"];
    }

    if (empty($_POST["mouth"])){
        $mouthErr="*Mouth Type Is Required";
        $errors=true;
    } else {
        $mouth=$_POST["mouth"];
    }

    try {
        if (!$errors) {
            setcookie("user", $name, time() + 86400, "/");
            setcookie("face", $face, time() + 86400, "/");
            setcookie("eyes", $eyes, time() + 86400, "/");
            setcookie("mouth", $mouth, time() + 86400, "/");
            setcookie("highScore", 0, time() + 86400, "/");
            setcookie("bestL1Score", 0, time() + 86400, "/");
            setcookie("bestL2Score", 0, time() + 86400, "/");
            setcookie("bestL3Score", 0, time() + 86400, "/");
            setcookie("bestL4Score", 0, time() + 86400, "/");
            setcookie("bestL5Score", 0, time() + 86400, "/");
            setcookie("bestL6Score", 0, time() + 86400, "/");
        }
    } catch (\mysql_xdevapi\Exception $exception) {}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ECM1417 Coursework | Registration</title>

        <meta content="width=device-width, initial-scale=1"/>

        <link rel="stylesheet" type="text/css" href="registrationCSS.css">
        <link rel="stylesheet" type="text/css" href="navbarCSS.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
    
    <body>
        <nav class="navbar">
            <div>
                <ul class=menu>
                    <li class="left">
                        <a class="nav-link" href="index.php">Home</a>
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

        <div class="data-entry">
            <form class="main" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="mainDiv">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Username</span>
                        <input type="text" name="name" class="form-control" placeholder="Enter name here"
                        aria-label="Username" aria-describedby="basic-addon1">
                        <span class="error"><b><?php echo $nameErr;?></b></span>
                    </div>

                    <h2>Select Face Colour:</h2>
                    <span class="error"><b><?php echo $faceErr;?></b></span>
                    <ul class="mainBody">
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="face"
                                       value="emoji assets/skin/green.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/skin/green.png" width="50%" alt="Green Face">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="face"
                                       value="emoji assets/skin/yellow.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/skin/yellow.png" width="50%" alt="Yellow Face">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="face"
                                       value="emoji assets/skin/red.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/skin/red.png" width="50%" alt="Red Face">
                                </label>
                            </div>
                        </li>
                    </ul>

                    <h2>Select Eyes:</h2>
                    <span class="error"><b><?php echo $eyesErr;?></b></span>
                    <ul class="mainBody">
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/closed.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/closed.png" width="100%" alt="Closed Eyes">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/laughing.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/laughing.png" width="100%" alt="Laughing Eyes">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/long.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/long.png" width="100%" alt="Long Eyes">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/normal.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/normal.png" width="100%" alt="Normal Eyes">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/rolling.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/rolling.png" width="100%" alt="Rolling Eyes">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eyes"
                                       value="emoji assets/eyes/winking.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/eyes/winking.png" width="100%" alt="Winking Eye">
                                </label>
                            </div>
                        </li>
                    </ul>

                    <h2>Select Mouth:</h2>
                    <span class="error"><b><?php echo $mouthErr;?></b></span>
                    <ul class="mainBody">
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/open.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/open.png" width="75%" alt="Open Mouth">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/sad.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/sad.png" width="75%" alt="Sad">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/smiling.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/smiling.png" width="75%" alt="Smiling">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/straight.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/straight.png" width="75%" alt="Straight">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/surprise.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/surprise.png" width="100%" alt="Surprise Mouth">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mouth"
                                       value="emoji assets/mouth/teeth.png" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <img src="emoji assets/mouth/teeth.png" width="75%" alt="Grin">
                                </label>
                            </div>
                        </li>
                    </ul>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>