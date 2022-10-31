<?php

declare(strict_types=1);

require_once(__DIR__ . "/dataBase.php");

class users extends dataBase
{
    // get all user properties from id
    public function getUser(int $id): array
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $id
        ]);

        $response = $query->fetch();

        return $response;
    }

    // get all user properties from name and pwd
    public function getUserFromNameAndPwd(string $name, string $pwd): array
    {
        $sql = "SELECT * FROM users WHERE name = ? AND pwd = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $name,
            $pwd
        ]);

        $response = $query->fetch();

        // ensure a id
        if (isset($response['id'])) {
            return $response;
        }

        // if no id then return empty
        return [];
    }
}
