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

    // get all user properties from email
    public function getUserFromEmail(string $email): array
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $email
        ]);

        $response = $query->fetch();

        // ensure a id
        if (isset($response['id'])) {
            return $response;
        }

        // if no id then return empty
        return [];
    }

    // get all users ids by search first_name
    public function getUsersIdsFromSearchFirstName(string $search): array
    {
        $sql = "SELECT id
                FROM users
                WHERE first_name LIKE CONCAT(?,'%')";
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

    // get all users ids by search last_name
    public function getUsersIdsFromSearchLastName(string $search): array
    {
        $sql = "SELECT id
                FROM users
                WHERE last_name LIKE CONCAT(?,'%')";
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


    // register a user
    public function register(string $email, string $firstName, string $lastName, $pwd): void
    {
        $sql = "INSERT INTO users(
            email,
            first_name,
            last_name,
            pwd
        ) VALUES(?,?,?,?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            $email,
            $firstName,
            $lastName,
            $pwd
        ]);
    }
}
