<?php 
require_once "Dao.php";
if(isset($_POST["commentButton"])){
    $comment = htmlspecialchars($_POST["comment"]);
    $user = htmlspecialchars($_POST["userName"]);
    try{
        $dao = new Dao();
        $dao->saveComment($user, $comment);
    }catch(Exception $e){
        var_dump($e);
        echo "<p> Comment could not be saved.</p>";
        die();
    }
}
header('Location: source.php');
?>