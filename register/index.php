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
    <title>register</title>
</head>

<body class="bg-lemon-milk p-4">
    <?php menu() ?>

    <main class="max-w-2xl min-h-screen flex flex-col mx-auto justify-center">
        <form action="api/register.php" method="POST" class="flex flex-col gap-2 p-2 bg-cream rounded-xl w-full">
            <ul class="w-full flex flex-col items-center text-warning">
                <?php
                foreach ($app->getErrors() as $error) {
                    echo "<li>$error</li>";
                }
                ?>
            </ul>
            <input type="email" name="email" id="email" placeholder="Email" class="bg-cream placeholder:text-coffee">
            <input type="text" name="firstName" id="firstName" placeholder="First name" class="bg-cream placeholder:text-coffee">
            <input type="text" name="lastName" id="lastName" placeholder="Last name" class="bg-cream placeholder:text-coffee">
            <input type="password" name="pwd" id="pwd" placeholder="Password" class="bg-cream placeholder:text-coffee">
            <input type="password" name="pwdRep" id="pwdRep" placeholder="Repeat password" class="bg-cream placeholder:text-coffee">
            <input type="submit" value="register" class="w-full h-8 bg-coffee text-cream rounded-lg hover:cursor-pointer">
        </form>
    </main>
</body>

</html>
