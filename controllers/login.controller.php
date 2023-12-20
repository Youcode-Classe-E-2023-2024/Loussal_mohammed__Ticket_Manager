<?php
include_once '../config/config.php';
include_once '../config/init.php';

if(isset($_POST['submit'])) {
    session_start();
    global  $users;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $users->login($email, $password);
    if(empty($user)) {
        header('Location: ../html/login.php?error=thereIsNoUser');
    } else {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userName'] = $user['name'];
        $_SESSION['userType'] = $user['user_type'];
        header('Location: ../html/tickets.php');
    }
}
