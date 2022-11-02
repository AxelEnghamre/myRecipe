<?php

declare(strict_types=1);

// function to put menu into DOM
function updateIngredients(array $ingredientsArray): void
{
?>
    <ul>
        <?php
        foreach ($ingredientsArray as $ingredient) {
        ?>
            <li>
                <form action="/api/ingredient/update.php" method="post">
                    <input type="hidden" name="ingredientId" value=<?= $ingredient['id'] ?>>

                    <label for="ingredient">ingredient</label>
                    <input type="text" name="ingredient" value="<?= $ingredient['ingredient'] ?>">

                    <label for="amount">amount</label>
                    <input type="number" name="amount" value="<?= $ingredient['amount'] ?>">

                    <label for="unit">unit</label>
                    <input type="text" name="unit" value="<?= $ingredient['unit'] ?>">

                    <input type="submit" value="save">

                    <a href="/api/ingredient/delete.php?ingredientId=<?= $ingredient['id'] ?>">delete</a>
                </form>
            </li>
        <?php
        }
        ?>
    </ul>
<?php
}
?>
