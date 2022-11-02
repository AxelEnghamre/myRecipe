<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['step'], $_POST['details'], $_POST['orderIndex'], $_POST['recipeId']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $stepName = $_POST['step'];
    $details = $_POST['details'];
    $orderIndex = intval($_POST['orderIndex']);
    $recipeId = intval($_POST['recipeId']);

    if ($stepName != "") {
        require_once(__DIR__ . "./../../src/classes/database/steps.php");

        $steps = new steps;

        $steps->create($stepName, $details, $orderIndex, $recipeId);
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
