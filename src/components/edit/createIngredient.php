<?php

declare(strict_types=1);

// function to put menu into DOM
function createIngredient(array $recipe): void
{
?>
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
<?php
}
?>
