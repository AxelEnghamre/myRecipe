<?php

declare(strict_types=1);
$response = [];

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    require_once(__DIR__ . "./../src/classes/database/users.php");
    require_once(__DIR__ . "./../src/classes/database/recipes.php");

    $users = new users;
    $recipes = new recipes;

    // search in users
    $idsSearchFirstName = $users->getUsersIdsFromSearchFirstName($search);
    $idsSearchLastName = $users->getUsersIdsFromSearchLastName($search);

    // unique found user ids
    $foundUserIds = array_unique(array_merge($idsSearchFirstName, $idsSearchLastName));

    // search in recipes
    $idsSearchRecipeName = $recipes->getRecipesIdsFromSearchName($search);

    // this array is associative
    $idsFoundByUserIds = array_map(function ($userId) use ($recipes) {
        $idsFoundByUserId = $recipes->getRecipesIdsFromUserId(intval($userId));
        return $idsFoundByUserId;
    }, $foundUserIds);
    // make the array one dimention
    $idsFromSearchUsers = [];
    foreach ($idsFoundByUserIds as $foundUserIds) {
        foreach ($foundUserIds as $id) {
            array_push($idsFromSearchUsers, $id);
        }
    }

    // unique found recipe ids
    $foundRecipeIds = array_unique(array_merge($idsSearchRecipeName, $idsFromSearchUsers));

    //  retreive recipes
    $foundRecipes = array_map(function ($recipeId) use ($recipes) {
        return $recipes->getRecipe(intval($recipeId));
    }, $foundRecipeIds);

    // map the recipes to correct format response
    $response = array_map(function ($recipe) use ($users) {
        $user = $users->getUser(intval($recipe['user_id']));
        return [
            'id' => $recipe['id'],
            'name' => $recipe['name'],
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name']
        ];
    }, $foundRecipes);
}


//  send the response as JSON
echo json_encode($response);
