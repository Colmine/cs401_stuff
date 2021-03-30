<?php 
$thisPage = 'Register';
session_start();
?>

<!DOCTYPE HTML>
<HTML>
    <HEAD profile="http://www.github.com/">
        <link rel="shortcut icon" type="image/jpg" href="placeholder_favicon.jpg"/>
    <HEAD> 
        <TITLE>Cole Gilmore - New User Page</TITLE>
        <link rel="stylesheet" type="text/css" href="text/style.css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Actor" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet" type="text/css">
    </HEAD>

    <BODY STYLE>
        <div class="banner">
            <div class="logo">
                <img src="s-300.jpg">
                <h3>Place Holder Logo</h3>
            </div>
            <div class="name">
                <h1>Cole Gilmore</h1>
                <h3>Computer Science Undergraduate</h3>
                <h3>Computational Science and Engineering Minor</h3>
            </div>
            </div>
        </div>
        <div class="nav-bar">
            <ul>
                <li class="nav">
                    <a href="home.php">Home Page</a>
                </li>
                <li class="nav">
                    <a href="source.php">Source Code</a>
                </li>
                <li class="nav">
                    <a href="resume.php">Resume</a>
                </li>
                <li class="nav">
                    <a href="run.php">Run Code</a>
                </li>
                <li class="nav">
                    <a href="test.php">Security Tests</a>
                </li>
                <li class="nav">
                    <a href="login.php">Login Page</a>
                </li>
            </ul>
        </div>
        <form action="register_page.php" method="POST">
            <div class="imgcontainer">
              <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>
          
            <div class="container">
              <label for="uname"><b>New Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required maxlength="50" 
                value=<?php if(isset($_SESSION['presets']['name'])) echo $_SESSION['presets']['name']?>>
                <?php if(isset($_SESSION['errors']['name'])){ ?>
                <span id="nameError" class="error"><?= $_SESSION['errors']['name'] ?></span>
                <?php } ?>

              <label for="aname"><b>Your Name</b></label>
              <input type="text" placeholder="Enter Your Name" name="aname" required>
          
              <label for="psw"><b>New Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>

              <label for="psw2"><b>Re-enter Password</b></label>
              <input type="password" placeholder="Re-enter Password" name="psw2" required>
                  
              <button type="submit">Create</button>
              <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
              </label>
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" class="cancelbtn">Cancel</button>
            </div>
        </form>
        <div id="footer">
            <li class="first">©2021 Cole Gilmore</li>
        </div>
    </BODY>
</HTML>