<?php

declare(strict_types=1);

require_once(__DIR__ . "/dataBase.php");

class ingredients extends dataBase
{
    // get all ingredient properties
    public function getIngredient(int $id): array
    {
        $sql = "SELECT * FROM ingredients WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $id
        ]);

        $response = $query->fetch();

        if (isset($response['id'])) {
            return $response;
        }

        return [];
    }

    // get all ingredients based on recipe id
    public function getIngredientsFromRecipeId(int $recipeId): array
    {
        $sql = "SELECT * FROM ingredients WHERE recipe_id = ?";
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

    // delete all ingredient based on recipe id
    public function deleteIngredientsFromRecipeId(int $recipeId): void
    {
        $sql = "DELETE FROM ingredients WHERE recipe_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $recipeId
        ]);
    }

    // delete a specific ingredient
    public function delete(int $id): void
    {
        $sql = "DELETE FROM ingredients WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $id
        ]);
    }

    // create a ingredient
    public function create(string $ingredient, float $amount, string $unit, int $recipeId): void
    {
        $sql = "INSERT INTO ingredients
        (ingredient,
        amount,
        unit,
        recipe_id)
        VALUES(?,?,?,?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $ingredient,
            $amount,
            $unit,
            $recipeId
        ]);
    }

    // update a ingredient
    public function update(int $id, string $ingredient, string $amount, string $unit): void
    {
        $sql = "UPDATE ingredients
                SET
                ingredient = ?,
                amount = ?,
                unit = ?
                WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $ingredient,
            $amount,
            $unit,
            $id
        ]);
    }
}
