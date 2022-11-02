<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_GET['recipe_id']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_GET['recipe_id']);

    require_once(__DIR__ . "./../../src/classes/database/recipes.php");
    require_once(__DIR__ . "./../../src/classes/database/ingredients.php");
    require_once(__DIR__ . "./../../src/classes/database/steps.php");

    $recipes = new recipes;
    $ingredients = new ingredients;
    $steps = new steps;

    $recipe = $recipes->getRecipe($id);

    if (isset($recipe['id'])) {
        if (intval($recipe['user_id']) === $app->getUserId()) {
            // delete recipe
            $steps->deleteStepsFromRecipeId($id);
            $ingredients->deleteIngredientsFromRecipeId($id);
            $recipes->delete($id);
        } else {
            array_push($_SESSION['errors'], "you don't own the recipe");
        }
    } else {
        array_push($_SESSION['errors'], "no recipe found");
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
