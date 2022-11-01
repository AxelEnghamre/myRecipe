<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['name'], $_POST['shortDescription'], $_POST['description']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $name = $_POST['name'];
    $shortDescription = $_POST['shortDescription'];
    $description = $_POST['description'];


    require_once(__DIR__ . "./../../src/classes/database/recipes.php");

    $recipes = new recipes;

    $recipes->create($name, $shortDescription, $description, $app->getUserId());
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
