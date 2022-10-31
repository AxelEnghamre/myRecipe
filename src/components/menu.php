<?php

declare(strict_types=1);

// function to put menu into DOM
function menu($isSignedIn = false): void
{
?>

    <nav id="menu" class="w-screen h-screen bg-coffee fixed top-0 left-0 -z-30 overflow-x-hidden overflow-y-scroll flex flex-col justify-center opacity-0 duration-500">
        <ul class="flex flex-col text-cream w-20 gap-10 p-10">
            <a href=<?= __DIR__ . '/' ?> class="text-5xl hover:scale-125 duration-300">Search</a>

            <?php

            if ($isSignedIn) { ?>
                <a href=<?= __DIR__ . '/dashoard/' ?> class='text-5xl hover:scale-125 duration-300'>Dashoard</a>
                <a href=<?= __DIR__ . '/logout/' ?> class="text-2xl hover:scale-125 duration-300">logout</a>
            <?php
            } else {
            ?>
                <a href=<?= __DIR__ . '/login/' ?> class="text-2xl hover:scale-125 duration-300">login</a>
            <?php
            }
            ?>

        </ul>
    </nav>

    <button id="menuButton" class="fixed z-50 top-4 right-4 w-14 h-14 flex flex-col justify-center items-center gap-3 group bg-coffee rounded-xl hover:cursor-pointer">
        <div id="bar1" class="w-10/12 h-1 rounded-xl bg-cream duration-300"></div>
        <div id="bar2" class="w-10/12 h-1 rounded-xl bg-cream duration-300"></div>
        <div id="bar3" class="w-10/12 h-1 rounded-xl bg-cream duration-300"></div>
    </button>

    <script defer>
        // the script is run defer due to event listeners
        const bar1 = document.getElementById("bar1");
        const bar2 = document.getElementById("bar2");
        const bar3 = document.getElementById("bar3");

        const menu = document.getElementById("menu");

        document.getElementById("menuButton").addEventListener("click", () => {

            /*
                Animation for menuButton
            */
            // bar 1
            bar1.classList.toggle("absolute");
            bar1.classList.toggle("rotate-45");

            // bar 2
            bar2.classList.toggle("opacity-0");

            // bar 3
            bar3.classList.toggle("absolute");
            bar3.classList.toggle("-rotate-45");

            /*
                Animation for menu
            */
            menu.classList.toggle("-z-30"); // Default value from closed state
            menu.classList.toggle("z-30");
            menu.classList.toggle("opacity-0"); // Default value from old state
            menu.classList.toggle("opacity-1");

        });
    </script>

<?php
}
?>
