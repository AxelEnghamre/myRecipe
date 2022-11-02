<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");
require_once(__DIR__ . "./../src/components/menu.php");
require_once(__DIR__ . "./../src/classes/database/recipes.php");
require_once(__DIR__ . "./../src/classes/database/ingredients.php");
require_once(__DIR__ . "./../src/classes/database/steps.php");

require_once(__DIR__ . "./../src/components/edit/updateRecipe.php");
require_once(__DIR__ . "./../src/components/edit/createIngredient.php");
require_once(__DIR__ . "./../src/components/edit/updateIngredients.php");
require_once(__DIR__ . "./../src/components/edit/createStep.php");
require_once(__DIR__ . "./../src/components/edit/updateSteps.php");


$app = new app;

// if the user is not signed in then redirect to login
if (!$app->getIsSignedIn()) {
    header("Location: ../login");
    exit;
}

// if the recipe id does not exista
if (!isset($_GET['recipe_id'])) {
    header("Location: ../dashboard");
    exit;
}

$id = intval($_GET['recipe_id']);

$recipes = new recipes;
$ingredients = new ingredients;
$steps = new steps;

// retrive the recipe
$recipe = $recipes->getRecipe($id);

if (isset($recipe['id'])) {
    // if the user does not own the recipe then redirect to dashboard
    if ($recipe['user_id'] != $app->getUserId()) {
        header("Location: ../dashboard");
        exit;
    }

    $ingredientsArray = $ingredients->getIngredientsFromRecipeId($recipe['id']);
    $stepsArray = $steps->getStepsFromRecipeId($recipe['id']);
} else {
    // recipe does not exist
    header("Location: ../dashboard");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <title>edit</title>
</head>

<body class="bg-lemon-milk p-4 pt-6">
    <a href="/dashboard/" class="fixed top-6 right-4 text-xl text-warning z-50">exit</a>

    <main class="max-w-2xl ml-auto mr-auto flex flex-col gap-10">
        <h1 class="text-3xl">Edit</h1>
        <section>
            <h2 class="text-2xl">Recipe</h2>
            <?php
            updateRecipe($recipe);
            ?>
        </section>

        <section>
            <h2 class="text-2xl">Ingredients</h2>
            <?php
            createIngredient($recipe);
            updateIngredients($ingredientsArray);
            ?>
        </section>


        <section>
            <h2 class="text-2xl">Steps</h2>
            <?php
            createStep($recipe);
            updateSteps($stepsArray);
            ?>
        </section>
    </main>

</body>

</html>
