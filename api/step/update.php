<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['stepId'], $_POST['step'], $_POST['details'], $_POST['orderIndex']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_POST['stepId']);
    $stepName = $_POST['step'];
    $details = $_POST['details'];
    $orderIndex = $_POST['orderIndex'];

    require_once(__DIR__ . "./../../src/classes/database/steps.php");
    require_once(__DIR__ . "./../../src/classes/database/recipes.php");

    $steps = new steps;
    $recipes = new recipes;

    $step = $steps->getStep($id);

    if (isset($step['id'])) {
        $recipe = $recipes->getRecipe(intval($step['recipe_id']));

        if (intval($recipe['user_id']) === $app->getUserId()) {
            $steps->update($id, $stepName, $details, $orderIndex);
            header("Location: ../../edit?recipe_id=" . $step['recipe_id']);
            exit;
        } else {
            array_push($_SESSION['errors'], "you don't own the recipe");
        }
    } else {
        array_push($_SESSION['errors'], "no step found");
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
