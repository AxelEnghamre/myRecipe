<?php

declare(strict_types=1);

require_once(__DIR__ . "/dataBase.php");

class steps extends dataBase
{


    // get all steps based on recipe id
    public function getStepsFromRecipeId(int $recipeId): array
    {
        $sql = "SELECT * FROM steps WHERE recipe_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $recipeId
        ]);

        $response = $query->fetchAll();

        if (isset($response[0])) {
            return $response;
        }

        return [];
    }
}
