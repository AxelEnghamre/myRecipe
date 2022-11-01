<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../src/classes/app.php");

$app = new app;

if (isset($_POST['recipeId'], $_POST['name'], $_POST['shortDescription'], $_POST['description']) && $app->getIsSignedIn()) {
    // this needs to be validated
    $id = intval($_POST['recipeId']);
    $name = $_POST['name'];
    $shortDescription = $_POST['shortDescription'];
    $description = $_POST['description'];

    require_once(__DIR__ . "./../../src/classes/database/recipes.php");

    $recipes = new recipes;

    $recipe = $recipes->getRecipe($id);

    if (isset($recipe['id'])) {
        if ($recipe['user_id'] === $app->getUserId()) {
            $recipes->update($id, $name, $shortDescription, $description);
            header("Location: ../../edit?recipe_id=$id");
            exit;
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
