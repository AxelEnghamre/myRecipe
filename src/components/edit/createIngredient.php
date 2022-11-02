<?php

declare(strict_types=1);

// function to put menu into DOM
function createIngredient(array $recipe): void
{
?>
    <form action="/api/ingredient/create.php" method="post" class="w-full flex flex-col gap-4 bg-coffee p-4 rounded-xl text-cream">
        <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>

        <section class=" flex flex-col gap-1">
            <label for="ingredient">ingredient</label>
            <input type="text" name="ingredient" placeholder="Ingredient name" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <section class=" flex flex-col gap-1">
            <label for="amount">amount</label>
            <input type="number" name="amount" placeholder="Amount" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <section class=" flex flex-col gap-1">
            <label for="unit">unit</label>
            <input type="text" name="unit" placeholder="Unit" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <input type="submit" value="add ingredient" class="w-32 h-8 bg-cream text-coffee rounded-xl grid place-items-center hover:cursor-pointer">
    </form>
<?php
}
?>
