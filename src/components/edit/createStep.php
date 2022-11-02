<?php

declare(strict_types=1);

// function to put menu into DOM
function createStep(array $recipe): void
{
?>
    <form action="/api/step/create.php" method="post">
        <input type="hidden" name="recipeId" value=<?= $recipe['id'] ?>>

        <label for="step">step</label>
        <input type="text" name="step" placeholder="Step">

        <label for="details">details</label>
        <input type="text" name="details" placeholder="Step detail">

        <label for="orderindex">order</label>
        <input type="number" name="orderIndex" placeholder="Step order">

        <input type="submit" value="add step">
    </form>
<?php
}
?>
