<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_GET['stepId']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_GET['stepId']);

    require_once(__DIR__ . "./../../src/classes/database/recipes.php");
    require_once(__DIR__ . "./../../src/classes/database/steps.php");

    $recipes = new recipes;
    $steps = new steps;

    $step = $steps->getStep($id);

    if (isset($step['id'])) {
        $recipe = $recipes->getRecipe(intval($step['recipe_id']));

        if (isset($recipe['id'])) {
            if (intval($recipe['user_id']) === $app->getUserId()) {
                $steps->delete($id);
                header("Location: ../../edit?recipe_id=" . $recipe['id']);
                exit;
            } else {
                array_push($_SESSION['errors'], "you don't own the recipe");
            }
        } else {
            array_push($_SESSION['errors'], "no recipe found");
        }
    } else {
        array_push($_SESSION['errors'], "no step found");
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
