<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");
require_once(__DIR__ . "./../src/components/menu.php");
require_once(__DIR__ . "./../src/classes/database/recipes.php");
require_once(__DIR__ . "./../src/classes/database/ingredients.php");
require_once(__DIR__ . "./../src/classes/database/steps.php");


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

    <section>
        <h2>Recipe</h2>
        <form action="/api/recipe/update.php" method="post" class="w-full flex flex-col gap-4">
            <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= $recipe['name'] ?>">

            <label for="shortDescription">Short description</label>
            <textarea type="textarea" name="shortDescription" id="short_description"><?= $recipe['short_description'] ?></textarea>

            <label for="description">Description</label>
            <textarea type="textarea" name="description" id="description"><?= $recipe['description'] ?></textarea>

            <input type="submit" value="save" class=" w-14 h-8 bg-white rounded-xl grid place-items-center hover:cursor-pointer">
        </form>
    </section>

    <section>
        <h2>Ingredients</h2>
        <form action="/api/ingredient/create.php" method="post">
            <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>

            <label for="ingredient">ingredient</label>
            <input type="text" name="ingredient" placeholder="Ingredient name">

            <label for="amount">amount</label>
            <input type="number" name="amount" placeholder="Amount">

            <label for="unit">unit</label>
            <input type="text" name="unit" placeholder="Unit">

            <input type="submit" value="add ingredient">
        </form>

        <ul>
            <?php
            foreach ($ingredientsArray as $ingredient) {
            ?>
                <li>
                    <form action="/api/ingredient/update.php" method="post">
                        <input type="hidden" name="ingredientId" value=<?= $ingredient['id'] ?>>

                        <label for="ingredient">ingredient</label>
                        <input type="text" name="ingredient" value="<?= $ingredient['ingredient'] ?>">

                        <label for="amount">amount</label>
                        <input type="number" name="amount" value="<?= $ingredient['amount'] ?>">

                        <label for="unit">unit</label>
                        <input type="text" name="unit" value="<?= $ingredient['unit'] ?>">

                        <input type="submit" value="save">

                        <a href="/api/ingredient/delete.php?ingredientId=<?= $ingredient['id'] ?>">delete</a>
                    </form>
                </li>
            <?php
            }
            ?>
        </ul>

    </section>


    <section>
        <h2>Steps</h2>
        <form action="/api/step/create.php" method="post">
            <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>

            <label for="ingredient">ingredient</label>
            <input type="text" name="ingredient" placeholder="Ingredient name">

            <label for="amount">amount</label>
            <input type="number" name="amount" placeholder="Amount">

            <label for="unit">unit</label>
            <input type="text" name="unit" placeholder="Unit">

            <input type="submit" value="add ingredient">
        </form>

        <ul>
            <?php
            foreach ($stepsArray as $step) {
            ?>
                <li>
                    <form action="/api/step/update.php" method="post">
                        <input type="hidden" name="ingredientId" value=<?= $step['id'] ?>>

                        <label for="step">step</label>
                        <input type="text" name="step" value="<?= $step['step'] ?>">

                        <label for="details">details</label>
                        <input type="text" name="details" value="<?= $step['details'] ?>">

                        <label for="orderIndex">order</label>
                        <input type="number" name="orderIndex" value="<?= $step['order_index'] ?>">

                        <input type="submit" value="save">

                        <a href="/api/step/delete.php?stepId=<?= $step['id'] ?>">delete</a>
                    </form>
                </li>
            <?php
            }
            ?>
        </ul>

    </section>

</body>

</html>
