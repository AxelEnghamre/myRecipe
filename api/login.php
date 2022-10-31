<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");

$app = new app;

if (isset($_POST['user'], $_POST['pwd'])) {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    // FOR NOW
    if ($user === 'Axel' && $pwd === '123') {
        $_SESSION['isSignedIn'] = true;
        $_SESSION['userId'] = 1;
        $_SESSION['userName'] = "axel";
    } else {
        array_push($_SESSION['errors'], "sorry, invalid username or password");
    }
} else {
    array_push($_SESSION['errors'], "missing data");
}

header("Location: ../login");
