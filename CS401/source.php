<?php
	$thisPage = 'Source';
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true){
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE HTML>
<HTML>
    <HEAD profile="http://www.github.com/">
        <link rel="shortcut icon" type="image/jpg" href="placeholder_favicon.jpg"/>
    <HEAD> 
        <TITLE>Cole Gilmore - Source Code</TITLE>
        <link rel="stylesheet" type="text/css" href="text/style.css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Actor" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet" type="text/css">
    </HEAD>

    <BODY>
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
                    <a href="home.php">Home</a>
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
        <div class="content">
            <div class="repo-links">
                <ul>
                    <a href="https://github.com/cs481-ekh/s21-team-blue/tree/main/backend"> 
                        <img alt="SeniorProject" src="folder_icon.png" width="125" height="125">
                    </a>
                </ul>
            </div>
        </div>
        <form name="commentForm" action="comment_handler.php" method="POST">
            <div>
                Username: <input type="text" name="userName">
            </div>
            <div>
                Comments: <input type="text" name="comment">
            </div>
            <div>
                <input type="submit" name="commentButton" value="Submit">
            </div>
            <input type="hidden" name="form" value="comment">
          </form>
        
        <?php
            require_once "Dao.php";
            try{
                $dao = new Dao();
                $comment = $dao->getComments();
            }catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        ?>
        <table class = "commentTable">
        <?php foreach($comment as $comment){ ?>
            <tr>
                <td><?= $comment["userName"]; ?></td>
                <td><?= $comment["commentPost"]; ?></td>
            </tr>
        <?php } ?>
        </table>

        
        <div id="footer">
            <li class="first">©2021 Cole Gilmore</li>
        </div>
    </BODY>
</HTML>