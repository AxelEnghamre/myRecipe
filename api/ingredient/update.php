<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['ingredientId'], $_POST['ingredient'], $_POST['amount'], $_POST['unit']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_POST['ingredientId']);
    $ingredientName = strval($_POST['ingredient']);
    $amount = $_POST['amount'];
    $unit = $_POST['unit'];

    require_once(__DIR__ . "./../../src/classes/database/ingredients.php");
    require_once(__DIR__ . "./../../src/classes/database/recipes.php");

    $ingredients = new ingredients;
    $recipes = new recipes;

    $ingredient = $ingredients->getIngredient($id);

    if (isset($ingredient['id'])) {
        $recipe = $recipes->getRecipe($ingredient['recipe_id']);

        if ($recipe['user_id'] === $app->getUserId()) {
            $ingredients->update($id, $ingredientName, $amount, $unit);
            header("Location: ../../edit?recipe_id=" . $ingredient['recipe_id']);
            exit;
        } else {
            array_push($_SESSION['errors'], "you don't own the recipe");
        }
    } else {
        array_push($_SESSION['errors'], "no ingredient found");
    }
} else {
    array_push($_SESSION['errors'], 'blocked');
}

header("Location: ../../dashboard");
