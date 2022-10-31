<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");
require_once(__DIR__ . "./../src/components/menu.php");

$app = new app;

// if the user is signed in then redirect to dashboard
if ($app->getIsSignedIn()) {
    header("Location: ../dashboard");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <title>login</title>
</head>

<body class="bg-lemon-milk p-2 gap-10 grid place-items-center w-screen min-h-screen">
    <?php menu() ?>

    <form action="api/login.php" method="POST" class="flex flex-col gap-2 p-2 bg-cream rounded-xl">
        <ul class="w-full flex flex-col items-center text-warning">
            <?php
            foreach ($app->getErrors() as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>
        <input type="text" name="user" id="user" placeholder="Username" class="bg-cream placeholder:text-coffee">
        <input type="password" name="pwd" id="pwd" placeholder="Password" class="bg-cream placeholder:text-coffee">
        <input type="submit" value="login" class="w-full bg-coffee text-cream rounded-lg hover:cursor-pointer">
    </form>
</body>

</html>
