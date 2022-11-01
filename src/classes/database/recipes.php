<?php

declare(strict_types=1);

require_once(__DIR__ . "/dataBase.php");

class recipes extends dataBase
{
    // get all recipe properties from id
    public function getRecipe(int $id): array
    {
        $sql = "SELECT * FROM recipes WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $id
        ]);

        $response = $query->fetch();

        return $response;
    }

    // get all recipes ids from user_id
    public function getRecipesIdsFromUserId(int $userId): array
    {
        $sql = "SELECT id FROM recipes WHERE user_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $userId
        ]);

        $response = $query->fetchAll();

        $ids = array_map(function ($element) {
            return $element['id'];
        }, $response);

        return $ids;
    }

    public function getRecipesIdsFromSearchName(string $search): array
    {
        $sql = "SELECT id
                FROM recipes
                WHERE name LIKE CONCAT(?,'%')";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $search
        ]);

        $response = $query->fetchAll();

        $ids = array_map(function ($element) {
            return $element['id'];
        }, $response);

        return $ids;
    }

    // create a recipe
    public function create(string $name, string $shortDescription, string $description, int $user_id): void
    {
        $sql = "INSERT INTO recipes
                (name,
                short_description,
                description,
                user_id)
                VALUES(?,?,?,?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $name,
            $shortDescription,
            $description,
            $user_id
        ]);
    }

    // delete a recipe
    public function delete(int $id): void
    {
        $sql = "DELETE FROM recipes WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $id
        ]);
    }
}
