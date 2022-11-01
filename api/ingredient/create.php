<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['ingredient'], $_POST['amount'], $_POST['unit'], $_POST['recipeId']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $ingredient = $_POST['ingredient'];
    $amount = $_POST['amount'];
    $unit = $_POST['unit'];
    $recipeId = intval($_POST['recipeId']);

    if ($ingredient != "" ||  $amount != "" || $unit != "") {
        require_once(__DIR__ . "./../../src/classes/database/ingredients.php");

        $ingredients = new ingredients;

        $ingredients->create($ingredient, $amount, $unit, $recipeId);
        header("Location: ../../edit?recipe_id=" . $recipeId);
        exit;
    } else {
        array_push($_SESSION['errors'], 'missing data');
        header("Location: ../../edit?recipe_id=" . $recipeId);
        exit;
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
