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

    // get all user properties from email and pwd
    public function getUserFromEmailAndPwd(string $email, string $pwd): array
    {
        $sql = "SELECT * FROM users WHERE email = ? AND pwd = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $email,
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
