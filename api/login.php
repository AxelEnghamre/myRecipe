<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");

$app = new app;

if (isset($_POST['email'], $_POST['pwd'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];


    require_once(__DIR__ . "./../src/classes/database/users.php");

    $users = new users;

    // retrive the user
    $status = $users->getUserFromEmailAndPwd($email, $pwd);

    // check if the user exists
    if (isset($status['id'])) {
        $_SESSION['isSignedIn'] = true;
        $_SESSION['userId'] = intval($status['id']);
        $_SESSION['userFirstName'] = strval($status['first_name']);
        $_SESSION['userLastName'] = strval($status['last_name']);
    } else {
        array_push($_SESSION['errors'], "sorry, invalid username or password");
    }
} else {
    array_push($_SESSION['errors'], "missing data");
}

header("Location: ../login");
