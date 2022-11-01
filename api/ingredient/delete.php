<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_GET['ingredientId']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_GET['ingredientId']);

    require_once(__DIR__ . "./../../src/classes/database/recipes.php");
    require_once(__DIR__ . "./../../src/classes/database/ingredients.php");

    $recipes = new recipes;
    $ingredients = new ingredients;

    $ingredient = $ingredients->getIngredient($id);

    if (isset($ingredient['id'])) {
        $recipe = $recipes->getRecipe($ingredient['id']);

        if (isset($recipe['id'])) {
            if ($recipe['user_id'] === $app->getUserId()) {
                $ingredients->delete($id);
            } else {
                array_push($_SESSION['errors'], "you don't own the recipe");
            }
        } else {
            array_push($_SESSION['errors'], "no recipe found");
        }
    } else {
        array_push($_SESSION['errors'], "no ingredient found");
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
