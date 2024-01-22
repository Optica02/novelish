<?php

require_once "../../Auth.php";

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
    }else if ($rowCount > 0)
    {
        $auth=new Auth();

        if($data['email']!=$auth->getEmail())
        {
            $_SESSION['errors']['email'] = 'Email is already taken';
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

    $qry = "update users set name = '$name',email='$email' where userID='$id'";
    include '../../includes/db_connect.php';
    $result =  $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Profile Updated Successfully',
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
            window.location = "edit.php";
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
            window.location = "edit.php";
        </script>';
    }

}


session_write_close();



?>