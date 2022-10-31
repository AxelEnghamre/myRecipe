<?php

declare(strict_types=1);
require_once(__DIR__ . "./../src/classes/app.php");
require_once(__DIR__ . "./../src/components/menu.php");
require_once(__DIR__ . "./../src/classes/database/recipes.php");


$app = new app;

// if the user is not signed in then redirect to login
if (!$app->getIsSignedIn()) {
    header("Location: ../login");
    exit;
}

$recipes = new recipes;

$userRecipesIds = $recipes->getRecipesIdsFromUserId($app->getUserId());
$userRecipes = array_map(function ($id) use ($recipes) {
    return $recipes->getRecipe($id);
}, $userRecipesIds);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <title>dashboard</title>
</head>

<body class="bg-lemon-milk p-4">
    <?php menu($app->getIsSignedIn()) ?>

    <section>
        <h1 class="text-4xl">Dashboard</h1>
        <h3>Welcome <?= $app->getUserFirstName() ?> <?= $app->getUserLastName() ?></h3>
    </section>

    <section>
        <h2 class="text-2xl">Your Recipes</h2>
        <ul>
            <?php
            foreach ($userRecipes as $recipe) {
            ?>
                <li class="w-full flex flex-row gap-4 content-center">
                    <a href="/edit/?recipe_id=<?= $recipe['id'] ?>" class="w-14 h-8 bg-cream rounded-xl grid place-items-center">edit</a>
                    <a href="/api/deleteRecipe.php?recipe_id=<?= $recipe['id'] ?>" class="w-14 h-8 bg-warning rounded-xl grid place-items-center">delete</a>
                    <p class="grid place-content-center"><?= $recipe['name'] ?></p>
                </li>
            <?php
            }
            ?>
        </ul>
    </section>

    <section>
        <h2 class="text-2xl">Create a Recipe</h2>
        <form action="/api/createRecipe.php" method="POST" class="w-full flex flex-col gap-4">
            <section class="w-full flex flex-col gap-1">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Recipe name" required>
            </section>

            <section class="w-full flex flex-col gap-1">
                <label for="shortDescription">Short description</label>
                <textarea type="textarea" name="shortDescription" id="shortDescription" placeholder="Recipe short description" required></textarea>
            </section>

            <section class="w-full flex flex-col gap-1">
                <label for="description">Description</label>
                <textarea type="textarea" name="description" id="description" placeholder="Recipe description" required></textarea>
            </section>

            <input type="submit" value="Add Recipe" class="w-32 h-8 bg-cream rounded-xl grid place-items-center hover:cursor-pointer">
        </form>
    </section>

</body>

</html>
