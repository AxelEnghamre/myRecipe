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

// if the recipe id does not exista
if (!isset($_GET['recipe_id'])) {
    header("Location: ../dashboard");
    exit;
}

$id = intval($_GET['recipe_id']);

$recipes = new recipes;

// retrive the recipe
$recipe = $recipes->getRecipe($id);

if (isset($recipe['id'])) {
    // if the user does not own the recipe then redirect to dashboard
    if ($recipe['user_id'] != $app->getUserId()) {
        header("Location: ../dashboard");
        exit;
    }
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

<body class="bg-lemon-milk p-4 min-h-sceen w-screen grid place-content-center">
    <?php menu($app->getIsSignedIn()) ?>
    <a href="/dashboard/" class="fixed top-8 left-4 text-lg">exit</a>

    <main class="flex flex-col max-w-2xl">
        <form action="/api/recipe/update.php" method="post" class="flex flex-col items-stretch">
            <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= $recipe['name'] ?>">

            <label for="shortDescription">Short description</label>
            <textarea type="textarea" name="shortDescription" id="short_description">
            <?= $recipe['short_description'] ?>
            </textarea>

            <label for="description">Description</label>
            <textarea type="textarea" name="description" id="description">
            <?= $recipe['description'] ?>
            </textarea>
            <!-- TODO add ingredients and their units and all the steps -->

            <input type="submit" value="save" class=" w-14 h-8 bg-white rounded-xl grid place-items-center hover:cursor-pointer">
        </form>
    </main>

</body>

</html>
