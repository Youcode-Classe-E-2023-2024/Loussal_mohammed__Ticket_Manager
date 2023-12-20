<?php
include_once '../config/config.php';
include_once '../config/init.php';

if($_POST['submit']) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = $_POST['confirm_password'];
    $hashedPassword = hash('sha256', $password);
    $users->login($email, $password);


}