<?php
require_once(__DIR__ . "/src/classes/app.php");
require_once(__DIR__ . "/src/components/menu.php");
require_once(__DIR__ . "/src/components/search.php");

$app = new app;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <title>myRecipe</title>
</head>

<body class="p-4 pt-6 bg-lemon-milk">
    <?php menu($app->getIsSignedIn()) ?>
    <header class="w-full h-28">
        <h1 class="text-4xl w-fit ml-auto mr-auto">
            MyRecipe
        </h1>
    </header>
    <main class="max-w-2xl ml-auto mr-auto">
        <?php search() ?>
    </main>
</body>

</html>
