<?php
session_start();

class Auth {
    private $isLogin, $name, $email, $role , $id,$isApproved,$book_allowed;

    public function __construct()
    {
        $this->isLogin = false;
        $this->name = "";
        $this->email = "";
        $this->role = "";
        $this->book_allowed="";

        if (isset($_SESSION['email'])) {
            include "includes/db_connect.php";

            $email = $_SESSION['email'];
            $qry = "SELECT * FROM users WHERE email='" . $email . "'";
            $result = $con->query($qry);

            if ($result) {
                $data = $result->fetch_assoc();

                if ($data) {
                    $this->isLogin = true;
                    $this->name = $data['name'];
                    $this->email = $data['email'];
                    $this->role = $data['role'];
                    $this->id = $data['userID'];
                    $this->isApproved = $data['is_approved'];
                    $this->book_allowed = $data['book_allowed'];
                }
            }

            include "includes/db_close.php";
        }
    }

    public function isLoggedIn()
    {
        return $this->isLogin;
    }
    public function isApproved()
    {
        return $this->isApproved;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBookAllowed()
    {
        return $this->book_allowed;
    }
}

