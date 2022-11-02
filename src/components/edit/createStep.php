<?php

declare(strict_types=1);

// function to put menu into DOM
function createStep(array $recipe): void
{
?>
    <form action="/api/step/create.php" method="post" class="w-full flex flex-col gap-4 bg-coffee p-4 rounded-xl">
        <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>

        <section class=" flex flex-col gap-1">
            <label for="step" class="text-lg text-cream">step</label>
            <input type="text" name="step" placeholder="Step" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <section class=" flex flex-col gap-1">
            <label for="details" class="text-lg text-cream">details</label>
            <input type="text" name="details" placeholder="Step detail" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <section class=" flex flex-col gap-1">
            <label for="orderindex" class="text-lg text-cream">order</label>
            <input type="number" name="orderIndex" placeholder="Step order" class="bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee placeholder:text-warning">
        </section>

        <input type="submit" value="add step" class="w-32 h-8 bg-cream text-coffee rounded-xl grid place-items-center hover:cursor-pointer">
    </form>
<?php
}
?>
