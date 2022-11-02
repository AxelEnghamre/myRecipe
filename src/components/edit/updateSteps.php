<?php

declare(strict_types=1);

// function to put menu into DOM
function updateSteps(array $stepsArray): void
{
?>
    <ul class="w-full flex flex-col gap-3 items-center">
        <?php
        foreach ($stepsArray as $step) {
        ?>
            <li class="max-w-xl">
                <form action="/api/step/update.php" method="post" class="w-full flex flex-col gap-4 bg-coffee p-4 rounded-xl text-cream overflow-hidden">
                    <input type="hidden" name="stepId" value=<?= $step['id'] ?>>

                    <section class="flex flex-row ">
                        <label for="step" class=" w-24 flex items-center justify-end">step</label>
                        <input type="text" name="step" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $step['step'] ?>">
                    </section>

                    <section class="flex flex-row ">
                        <label for="details" class=" w-24 flex items-center justify-end">details</label>
                        <input type="text" name="details" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $step['details'] ?>">
                    </section>

                    <section class="flex flex-row ">
                        <label for="orderIndex" class=" w-24 flex items-center justify-end">order</label>
                        <input type="number" name="orderIndex" class="flex-1 bg-coffee rounded-lg focus:bg-cream duration-100 border-coffee focus:border-cream border-2 p-1 text-cream focus:text-coffee" value="<?= $step['order_index'] ?>">
                    </section>

                    <section class="flex flex-row gap-6">
                        <input type="submit" value="save" class="w-14 h-8 bg-cream text-coffee rounded-xl grid place-items-center hover:cursor-pointer">
                        <a href="/api/step/delete.php?stepId=<?= $step['id'] ?>" class="w-14 h-8 bg-warning text-coffee rounded-xl grid place-items-center hover:cursor-pointer">delete</a>
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
