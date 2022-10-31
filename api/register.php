<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");

$app = new app;

if (isset($_POST['email'], $_POST['pwd'], $_POST['pwdRep'], $_POST['firstName'], $_POST['lastName'])) {
    $email      = $_POST['email'];
    $pwd        = $_POST['pwd'];
    $pwdRep     = $_POST['pwdRep'];
    $firstName = $_POST['firstName'];
    $lastName   = $_POST['lastName'];


    require_once(__DIR__ . "./../src/classes/database/users.php");

    $users = new users;

    if ($pwd === $pwdRep) {
        if ($users->getUserFromEmail($email) === []) {
            // register the user

            // hash the pwd
            $pwd = md5($pwd);

            $users->register($email, $firstName, $lastName, $pwd);
            header("Location: ../login");
            exit;
        } else {
            array_push($_SESSION['errors'], "the email is already taken");
        }
    } else {
        array_push($_SESSION['errors'], "passwords does not match");
    }
} else {
    array_push($_SESSION['errors'], "missing data");
}

header("Location: ../register");
