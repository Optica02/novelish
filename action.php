<?php
require_once "Auth.php";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $data = $_POST;

    include "includes/db_connect.php";

    $qry = "SELECT * FROM users WHERE email='".$email."'";
    $result=$con->query($qry);
    $user=$result->fetch_assoc();
    if (empty($email)) {
        $_SESSION['errors']['email'] = 'Email is required';
    } else if (!$user) {
        $_SESSION['errors']['email'] = 'Invalid Email';
    }

    if (empty($password)) {
        $_SESSION['errors']['password'] = 'Password is required';
    }

    if ($user && !password_verify($password, $user["password"])) {
        $_SESSION['errors']['password'] = 'Invalid Password';
    }

    
    if (!isset($_SESSION['errors'])) {
        // Successful login
        $_SESSION['email']=$email;
        $response = [
            'status' => 'success',
            'message' => "Logged In Successfuly!",
          ];
          $_SESSION['alert'] = $response;
          redirect();
          
    } else {
        $_SESSION['old_data'] = $data;
        // Redirect to the login page with errorss
        header("Location: login.php");
    }
}

if(isset($_POST['register']))
{
    $data = $_POST;
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    //using regex and regular expression for checking password strength and stop user registring with weak password
    $passwordCheckRegex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$^";

    //saving password in the form of like encoded form in to the database
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    include "includes/db_connect.php";
    // checking the existing email
    $qry = "select * from users where email='" . $email . "'";
    $result = $con->query($qry);
    include "includes/db_close.php";
    $rowCount = mysqli_num_rows($result);

    //server side form validations
    if (empty($name)) {
        $_SESSION['errors']['name'] = 'Name is required';
    } 
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $_SESSION['errors']['name'] = "Only character string is valid";
    }

    if (empty($email)) {
        $_SESSION['errors']['email'] = 'Email is required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = 'Email is invalid';
    } else if ($rowCount > 0) {
        $_SESSION['errors']['email'] = 'Email already exists';
    }
    if (empty($password)) {
        $_SESSION['errors']['password'] = 'Password is required';
    } else if (!preg_match($passwordCheckRegex, $password)) {
        $_SESSION['errors']['password'] = "weak password";
    } else if ($password != $confirmPassword) {
        $_SESSION['errors']['password'] = 'Password doesnot matched';
    }

    if (!isset($_SESSION['errors'])) {
        $qry = "insert into users (name,email,password,role) values('" . $name . "','" . $email . "','" . $passwordHash . "','".$role."')";
        include "includes/db_connect.php";
        if($con->query($qry) ===true)
        {
            $_SESSION['email']=$email;
            include("includes/db_close.php");
            $response = [
                'status' => 'success',
                'message' => " Registration successfuly!",
              ];
              $_SESSION['alert'] = $response;
              redirect();
        }
    } else {
        $_SESSION['old_data'] = $data;
        header("location:register.php");
    }
}


function redirect()
{
    $auth=new Auth();
    if($auth->getRole()=='Admin')
    {
        header('location:admin');
    }
   
    else
    {
        header('location:index.php');
    }
}


?>