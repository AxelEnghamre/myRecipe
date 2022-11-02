<?php

declare(strict_types=1);

// function to put menu into DOM
function updateRecipe(array $recipe): void
{
?>
    <form action="/api/recipe/update.php" method="post" class="w-full flex flex-col gap-4 bg-coffee p-4 rounded-xl">
        <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>
        <section class=" flex flex-col gap-1">
            <label for="name" class="text-lg text-cream">Name</label>
            <input type="text" name="name" id="name" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $recipe['name'] ?>">
        </section>

        <section class=" flex flex-col gap-1">
            <label for="shortDescription" class="text-lg text-cream">Short description</label>
            <textarea type="textarea" name="shortDescription" id="short_description" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee"><?= $recipe['short_description'] ?></textarea>
        </section>

        <section class=" flex flex-col gap-1">
            <label for="description" class="text-lg text-cream">Description</label>
            <textarea type="textarea" name="description" id="description" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee"><?= $recipe['description'] ?></textarea>
        </section>

        <input type="submit" value="save" class=" w-14 h-8 bg-cream text-coffee rounded-xl grid place-items-center hover:cursor-pointer">
    </form>
<?php
}
?>
