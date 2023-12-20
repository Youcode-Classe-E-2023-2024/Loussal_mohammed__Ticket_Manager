<?php
include_once '../config/config.php';
include_once '../config/init.php';

if($_POST['submit']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $emailReturn =  $users->emailExistance($email);
    if(!empty($emailReturn['email'])) {
        header('Location: ../html/signup.php?error=emailAlreadyExists');
    } elseif(!$users->emailValidate($email)) {
        header('Location: ../html/signup.php?error=emailNotValide');
    }  elseif(!$users->nameValidate($name)) {
        header('Location: ../html/signup.php?error=nameNotValide');
    } elseif(!$users->passwordValidate($password)) {
        header('Location: ../html/signup.php?error=passwordNotValide');
    }
    else {
        $users->addUser($email, $password, $name);
    }

}



?>