<?php

declare(strict_types=1);

// function to put menu into DOM
function updateRecipe(array $recipe): void
{
?>
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
<?php
}
?>
