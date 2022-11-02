<?php

declare(strict_types=1);

if (isset($_GET['recipe_id'])) {
    require_once('../src/classes/recipes.php');
    require_once('../src/classes/steps.php');
    require_once('../src/classes/ingredients.php');
    require_once('../src/classes/users.php');

    $urlId = intval($_GET['recipe_id']);

    // Recipes DB connection
    $ecipes = new recipes;
    $ingredients = new ingredients;
    $steps = new steps;
    $users = new users;


    // Get recipe
    $recipe = $recipes->getRecipe($urlId);

    if (isset($recipe['id'])) {
        // Define vars to use from the recipe
        $recipeId = $recipe['id'];
        $title = $recipe['name'];
        $short_description = $recipe['short_description'];
        $description = $recipe['description'];
        $ownerId = $recipe['user_id'];

        // Get all recipe steps
        $stepsArray = $steps->getStepsFromRecipeId($recipeId);

        // get all recipe ingredients
        $ingredientsArray = $ingredients->getIngredientsFromRecipeId($recipeId);

        // Get owners name
        //$owner = $users->getUserName($ownerId);
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
    <header class="mb-12">
        <h1 class="text-4xl">
            <?= $title ?>
        </h1>

        <p>
            <?= $short_description ?>
        </p>
    </header>

    <main class="max-w-2xl min-h-screen ml-auto mr-auto flex flex-col gap-12">
        <p>
            <?= $description ?>
        </p>

        <article>
            <h2 class="text-2xl">
                Ingredients
                <ul>
                    <?php
                    foreach ($ingredientsArray as $ingredient) {
                        echo "<li>";
                        echo $ingredient['ingredient'] . " " . $ingredient['amount'] . $ingredient['unit'];
                        echo "</li>";
                    }
                    ?>
                </ul>
            </h2>
        </article>

        <article>
            <h2 class="text-2xl">
                Steps
            </h2>
            <ol>
                <?php
                foreach ($stepsArray as $step) {
                    echo "<li>";
                    echo $step['step'];
                    echo "</li>";
                }

                ?>
            </ol>
        </article>
    </main>

    <footer>

    </footer>
</body>

</html>
