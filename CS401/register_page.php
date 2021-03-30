<?php
session_start();
require_once "Dao.php";
$name = trim($_POST['aname']);
$email = trim($_POST['uname']);
$password = $_POST['psw'];
$password_match = $_POST['psw2'];
$errors = array();


if(!valid_length($name, 1, 50)){
    $errors['name'] = "Please provide a name.";
}else if(preg_match('@[0-9]@', $name)){
    $errors['name'] = "Name should only include letters.";
}



if(!valid_length($password, 10, 128)){
    $errors['password'] = "Your password must be at least 10 characters long.";
}else if($password != $password_match){
    $errors['password_match'] = "The passwords do not match.";
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
        if($dao->userExists($email)){
            $_SESSION['errors']['userExists'] = "User already exists";
            header('Location: new.php');
            die;
        }else{
            if($dao->addUser($email, $password, $name)){
                header('Location: login.php');
                die;
            }else{
                $_SESSION['errors']['unexpectedError'] = "Something unexpected happened";
                header('Location: new.php');
                die;
            };
        }
    }
    catch (Exception $e){
        $_SESSION['errors']['unexpectedError'] = "Something unexpected happened";
        header('Location: new.php');
        die;
    }
}else{
    $_SESSION['errors'] = $errors;
    $_SESSION['presets'] = array('name' => htmlspecialchars($name),
                                'email' => htmlspecialchars($email));
    header('Location: new.php');
    die;
}

?>

<p> Name: <?= htmlspecialchars($name) ?></p>
<?php if(isset($nameError)){ ?>
    <span id="nameError" class="error"><?= $nameError ?></span>
<?php } ?>

<p> Email: <?= htmlspecialchars($email) ?></p>
<?php if(isset($emailError)){ ?>
    <span id="emailError" class="error"><?= $emailError ?></span>
<?php } ?>

<p> Password: <?= htmlspecialchars($password) ?></p>
<?php if(isset($passwordError)){ ?>
    <span id="passwordError" class="error"><?= $passwordError ?></span>
<?php } ?>

<p> Password match: <?= htmlspecialchars($password_match) ?></p>
<?php if(isset($passwordMatchError)){ ?>
    <span id="passwordMatchError" class="error"><?= $passwordMatchError ?></span>
<?php } ?>