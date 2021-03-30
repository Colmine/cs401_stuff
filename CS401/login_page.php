<?php
session_start();
require_once "Dao.php";
$email = trim($_POST['uname']);
$password = $_POST['psw'];
$errors = array();


if(!valid_length($password, 10, 128)){
    $errors['password'] = "Your password must be at least 10 characters long.";
}else if(!preg_match('@[A-Z]@', $password)){
    $errors['password'] = "Your password must contain at least 1 upper case letter";
}else if(!preg_match('@[a-z]@', $password)){
    $errors['password'] = "Your password must contain at least 1 lower case letter";
}else if(!preg_match('@[0-9]@', $password)){
    $errors['password'] = "Your password must contain at least 1 number";
}else if(!preg_match('@[^\w]@', $password)){
    $errors['password'] = "Your password must contain at least 1 special character";
}


function valid_length($field, $min, $max){
    $trimmed = trim($field);
    return (strlen($trimmed) >= $min && strlen($trimmed) <= $max);
}


if(empty($errors)){
    try{
        $dao = new Dao();
        $dao->getConnectionStatus();
        //if the user is found by the email, then they are logged in and redirected to the home page
        if($dao->validateUser($email, $password)){
            $_SESSION['logged_in'] = $email;
            $_SESSION['logged_in'] == true;
            header('Location: home.php');
            die;
        //if the user does not exist by email, then redirect to registration page
        }else {
            $_SESSION['errors']['userDoesNotExist'] = "User does not exist";
            header('Location: new.php');
            die;
        }
    }
    //catch an unexpected error
    catch (Exception $e){
        $_SESSION['errors']['unexpectedError'] = "Something unexpected happened";
        header('Location: login.php');
        die;
    }
}else{
    $_SESSION['errors'] = $errors;
    $_SESSION['presets'] = array('email' => htmlspecialchars($email));
    header('Location: new.php');
    die;
}
?>

<p> Email: <?= htmlspecialchars($email)?> </p>
<?php if(isset($emailError)){ ?>
    <span id="emailError" class="error"><?= $emailError ?></span>
<?php } ?>

<p> Password: <?= htmlspecialchars($password)?> </p>
<?php if(isset($passwordError)){ ?>
    <span id="passwordError" class="error"><?= $passwordError ?></span>
<?php } ?>