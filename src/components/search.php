<?php

declare(strict_types=1);

// function to put search into DOM
function search(): void
{
?>
    <form id="searchForm" method="post" class="w-full">
        <input type="search" name="search" id="search" placeholder="search..." class="w-full h-16 p-8 rounded-xl text-xl bg-cream placeholder:text-coffee">
        <ul id="searchResaultList" class="w-full mt-16 flex flex-col gap-12 p-12 bg-cream rounded-xl">

        </ul>
    </form>

    <script defer>
        // the script is run defer due to event listeners and elements
        const searchForm = document.getElementById("searchForm");
        const searchResaultList = document.getElementById("searchResaultList");


        // searcForm submit handler
        const searchFormSubmtHandler = async (e) => {
            // e is the event that we knows are comming from the search input
            // therefor the value comes from e.target.value
            // String garantes a string type
            const value = String(e.target.value);

            // preventing html to submit the form
            e.preventDefault();

            if (value.length > 2) {
                // FormData() structures the data like a form
                let searchformData = new FormData();
                // append the value with the search key
                searchformData.append('search', value);

                // fetch the serach api with the search data
                const response = await fetch("/api/search.php", {
                    method: 'POST',
                    body: searchformData
                });

                // if the response was okey then retreve the data as json
                if (response.ok) {
                    const data = await response.json();

                    hydrateSearchList(data);
                }

            }
        }

        // on submit the default should be prevented and the search should go once more
        searchForm.addEventListener("submit", (e) => {
            e.preventDefault();
            searchFormSubmtHandler(e);
        });

        // search (input in searchForm) on keyup handler
        search.addEventListener("keyup", (e) => {
            searchFormSubmtHandler(e);
        });

        // function to hydrate the search results with links to recipes
        const hydrateSearchList = (recipes) => {
            searchResaultList.innerHTML = null;

            recipes.forEach(recipe => {
                // if all requerd parameters is proved then create the list element
                if ('firstName' in recipe && 'lastName' in recipe && 'id' in recipe && 'name' in recipe) {
                    const name = recipe['name'];
                    const id = recipe['id'];
                    const firstName = recipe['firstName'];
                    const lastName = recipe['lastName'];


                    // list tag
                    const li = document.createElement('li');
                    li.setAttribute("class", "border-b-solid border-b-2 border-b-coffee p-1");

                    // anchor tag
                    const a = document.createElement('a');
                    a.setAttribute("href", "recipe/?" + id);
                    a.innerText = `${name} made by ${firstName} ${lastName}`;
                    a.setAttribute("class", "w-full");

                    // append the list
                    li.appendChild(a);
                    searchResaultList.appendChild(li);
                }
            });
        }
    </script>
<?php
}
?>
