<?php

declare(strict_types=1);

// function to put menu into DOM
function updateSteps(array $stepsArray): void
{
?>
    <ul>
        <?php
        foreach ($stepsArray as $step) {
        ?>
            <li>
                <form action="/api/step/update.php" method="post">
                    <input type="hidden" name="stepId" value=<?= $step['id'] ?>>

                    <label for="step">step</label>
                    <input type="text" name="step" value="<?= $step['step'] ?>">

                    <label for="details">details</label>
                    <input type="text" name="details" value="<?= $step['details'] ?>">

                    <label for="orderIndex">order</label>
                    <input type="number" name="orderIndex" value="<?= $step['order_index'] ?>">

                    <input type="submit" value="save">

                    <a href="/api/step/delete.php?stepId=<?= $step['id'] ?>">delete</a>
                </form>
            </li>
        <?php
        }
        ?>
    </ul>
<?php
}
?>
