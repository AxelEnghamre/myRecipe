<?php

declare(strict_types=1);

class app
{
    private array $errors;
    private bool $isSignedIn;
    private string $userFirstName;
    private string $userLastName;
    private int $userId;


    function __construct()
    {
        // ensure session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //  ensure user status
        $this->signIn();

        //  ensure errors
        $this->setErrors();
    }

    // sign in the user based on session
    private function signIn(): void
    {
        if (isset($_SESSION['isSignedIn'])) {
            if ($_SESSION['isSignedIn'] === true) {
                $this->isSignedIn = true;
                $this->userFirstName = $_SESSION['userFirstName'];
                $this->userLastName = $_SESSION['userLastName'];
                $this->userId = $_SESSION['userId'];
            }
        } else {
            $this->isSignedIn = false;
            $this->userFirstName = "";
            $this->userLastName = "";
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
    public function getUserFirstName(): string
    {
        return $this->userFirstName;
    }
    public function getUserLastName(): string
    {
        return $this->userLastName;
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
