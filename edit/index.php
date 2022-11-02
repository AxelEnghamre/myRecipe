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

<body class="bg-lemon-milk p-4 pt-16">
    <a href="/dashboard/" class="fixed top-8 right-4 text-lg">exit</a>

    <?php
    updateRecipe($recipe);
    ?>

    <section>
        <h2>Ingredients</h2>
        <?php
        createIngredient($recipe);
        updateIngredients($ingredientsArray);
        ?>
    </section>


    <section>
        <h2>Steps</h2>
        <?php
        createStep($recipe);
        updateSteps($stepsArray);
        ?>
    </section>

</body>

</html>
