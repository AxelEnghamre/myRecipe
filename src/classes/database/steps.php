<?php

declare(strict_types=1);

require_once(__DIR__ . "/dataBase.php");

class steps extends dataBase
{

    // get all step properties
    public function getStep(int $id): array
    {
        $sql = "SELECT * FROM steps WHERE id = ?";
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

    // get all steps based on recipe id
    public function getStepsFromRecipeId(int $recipeId): array
    {
        $sql = "SELECT * FROM steps
                WHERE recipe_id = ?
                ORDER BY order_index ASC";
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

    // update a step
    public function update(int $id, string $step, string $details, string $orderIndex): void
    {
        $sql = "UPDATE steps
                SET
                step = ?,
                details = ?,
                order_index = ?
                WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $step,
            $details,
            $orderIndex,
            $id
        ]);
    }
}
