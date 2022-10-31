<?php

declare(strict_types=1);

class app
{
    private array $errors;
    private bool $isSignedIn;
    private string $userName;
    private int $userId;


    function __construct()
    {
        // ensure session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //  ensure user status
        $this->signIn();

        // handle errors
        $this->setErrors();
    }

    // sign in the user based on session
    private function signIn(): void
    {
        if (isset($_SESSION['isSignedIn'])) {
            if ($_SESSION['isSignedIn'] === true) {
                $this->isSignedIn = true;
                $this->userName = $_SESSION['userName'];
                $this->userId = $_SESSION['userId'];
            }
        } else {
            $this->isSignedIn = false;
            $this->userName = "";
            $this->userId = 0;
        }
    }

    // error handeling based on session
    private function setErrors(): void
    {
        if (isset($_SESSION['errors'])) {
            $this->errors = $_SESSION['errors'];
        } else {
            $this->errors = [];
        }

        // create or reset the session errors
        $_SESSION['errors'] = [];
    }


    // retrieve user data
    public function getIsSignedIn(): bool
    {
        return $this->isSignedIn;
    }
    public function getUserName(): string
    {
        return $this->userName;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }

    // retrieve error data
    public function getErrors(): array
    {
        return $this->errors;
    }
}
