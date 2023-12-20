<?php
include_once '../config/config.php';
include_once '../config/init.php';

if($_POST['submit']) {
    global $users;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $emailReturn =  $users->emailExistance($email);
    if(!empty($emailReturn['email'])) {
        header('Location: ../html/signup.php?error=emailAlreadyExists');
    } elseif(!$users->emailValidate($email)) {
        header('Location: ../html/signup.php?error=emailNotValide');
    }  elseif(!$users->nameValidate($name)) {
        header('Location: ../html/signup.php?error=nameNotValide');
    } elseif(!$users->passwordValidate($password)) {
        header('Location: ../html/signup.php?error=passwordNotValide');
    } elseif(!$users->comparePassword($password, $confirm_password)) {
        header('Location: ../html/signup.php?error=passwordDoNotMatch');
    } else {
        $hashedPassword = hash('sha256', $password);
        $users->addUser($email, $hashedPassword, $name);
        header('Location: ../html/login.php');
    }


}



?>