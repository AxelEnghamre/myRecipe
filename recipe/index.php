<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");
require_once(__DIR__ . "./../src/components/menu.php");
$app = new app;

if (isset($_GET['recipe_id'])) {
    require_once(__DIR__ . "./../src/classes/database/recipes.php");
    require_once(__DIR__ . "./../src/classes/database/steps.php");
    require_once(__DIR__ . "./../src/classes/database/ingredients.php");
    require_once(__DIR__ . "./../src/classes/database/users.php");

    $urlId = intval($_GET['recipe_id']);

    // Recipes DB connection
    $recipes = new recipes;
    $ingredients = new ingredients;
    $steps = new steps;
    $users = new users;


    // Get recipe
    $recipe = $recipes->getRecipe($urlId);

    if (isset($recipe['id'])) {
        // Define vars to use from the recipe
        $recipeId = intval($recipe['id']);
        $title = $recipe['name'];
        $short_description = $recipe['short_description'];
        $description = $recipe['description'];
        $ownerId = intval($recipe['user_id']);

        // Get all recipe steps
        $stepsArray = $steps->getStepsFromRecipeId($recipeId);

        // get all recipe ingredients
        $ingredientsArray = $ingredients->getIngredientsFromRecipeId($recipeId);

        // Get owners name
        $owner = $users->getUser($ownerId);
        $firstName = $owner['first_name'];
        $lastName = $owner['last_name'];
    } else {
        //TODO direct to 505
        // FOR NOW
        header("Location: ../");
    }
} else {
    //TODO drect to 404
    // FOR NOW
    header("Location: ../");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="../">
    <title><?= $title ?></title>


    <!-- tailwind -->
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="bg-lemon-milk p-4">
    <?php menu($app->getIsSignedIn()) ?>
    <header class="mb-12">
        <h1 class="text-4xl">
            <?= $title ?>
        </h1>

        <p>
            <?= $short_description ?>
        </p>
    </header>

    <main class="max-w-2xl min-h-screen ml-auto mr-auto flex flex-col gap-12">
        <p><?= nl2br($description) ?></p>

        <article>
            <h2 class="text-2xl">
                Ingredients
            </h2>
            <ul>
                <?php
                foreach ($ingredientsArray as $ingredient) {
                ?>
                    <li class="w-full rounded-xl bg-coffee p-2 text-cream">
                        <?= $ingredient['ingredient'] ?> <?= $ingredient['amount'] ?> <?= $ingredient['unit'] ?>
                    </li>
                <?php
                }
                ?>
            </ul>
        </article>

        <article>
            <h2 class="text-2xl">
                Steps
            </h2>
            <ol>
                <?php
                foreach ($stepsArray as $step) {
                ?>
                    <li>
                        <?= $step['step'] ?>
                    </li>
                <?php
                }

                ?>
            </ol>
        </article>
    </main>

    <footer>
        <h2 class="text-xl">
            Created By <?= "$firstName $lastName" ?>
        </h2>
    </footer>
</body>

</html>
