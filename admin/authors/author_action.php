<?php

session_start();

function validate($data)
{
    if (empty($data['name'])) {
         $_SESSION['errors']['name'] = "name is required";
    }
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['name'])) {
        $_SESSION['errors']['name'] = "Only character string is valid";
    }
    
    $qry="select * from users where email='".$data['email']."'";
    include "../../includes/db_connect.php";
    $result=$con->query($qry);
    $rowCount=$result->num_rows;
    include "../../includes/db_close.php";
    
    if (empty($data['email'])) {
        $_SESSION['errors']['email'] = 'Email is required';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = 'Email is invalid';
    }else if ($rowCount > 1)
    {
        $_SESSION['errors']['email'] = 'Email is already taken';
    }

    if(!empty($data['password']))
    {
        $passwordCheckRegex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$^";
        if (!preg_match($passwordCheckRegex, $data['password'])) {
            $_SESSION['errors']['password'] = "must contain Uppercase,lowercase,digits,symbols and 8 character";
        }
    }

    if (isset($_SESSION['errors'])) {
        return true;
    }
    else{
        return false;
    }

}


if (isset($_POST['update'])) {
    $data = $_POST;
    $error = validate($data);
    $id = $_POST['id'];
    if ($error == false) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    if(empty($password))
    {
        $qry = "update users set name = '$name',email='$email',role='$role' where userID='$id'";
    }
    else
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $qry = "update users set name = '$name',email='$email',role='$role',password='$passwordHash' where userID='$id'";
    }
    include '../../includes/db_connect.php';
    $result =  $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Author Updated Successfully',
        ];
        
        
        $_SESSION['alert'] = $response;
        header('location:index.php');
    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        echo
        '<script>
            window.location = "edit.php?id='.$id.'";
        </script>';
        }
    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;

        echo 
        '<script>
            window.location = "edit.php?id='.$id.'";
        </script>';
    }

}


session_write_close();



?>