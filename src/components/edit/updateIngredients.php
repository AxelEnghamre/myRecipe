<?php

declare(strict_types=1);

// function to put menu into DOM
function updateIngredients(array $ingredientsArray): void
{
?>
    <ul class="w-full flex flex-col gap-3">
        <?php
        foreach ($ingredientsArray as $ingredient) {
        ?>
            <li class="w-full">
                <form action="/api/ingredient/update.php" method="post" class="w-full flex flex-col gap-4 bg-coffee p-4 rounded-xl text-cream overflow-hidden">
                    <input type="hidden" name="ingredientId" value=<?= $ingredient['id'] ?>>

                    <section class="flex flex-row ">
                        <label for="ingredient" class=" w-24 flex items-center justify-end">ingredient</label>
                        <input type="text" name="ingredient" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $ingredient['ingredient'] ?>">
                    </section>

                    <section class="flex flex-row ">
                        <label for="amount" class=" w-24 flex items-center justify-end">amount</label>
                        <input type="number" name="amount" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $ingredient['amount'] ?>">
                    </section>

                    <section class="flex flex-row ">
                        <label for="unit" class=" w-24 flex items-center justify-end">unit</label>
                        <input type="text" name="unit" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $ingredient['unit'] ?>">
                    </section>

                    <section class="flex flex-row gap-6">
                        <input type="submit" value="save" class="w-14 h-8 bg-cream text-coffee rounded-xl grid place-items-center hover:cursor-pointer">
                        <a href="/api/ingredient/delete.php?ingredientId=<?= $ingredient['id'] ?>" class="w-14 h-8 bg-warning text-coffee rounded-xl grid place-items-center hover:cursor-pointer">delete</a>
                    </section>

                </form>
            </li>
        <?php
        }
        ?>
    </ul>
<?php
}
?>
