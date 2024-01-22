<?php

session_start();

function validate($data,$for)
{
    if (empty($data['genreName'])) {
         $_SESSION['errors']['genreName'] = "Genre name is required";
    }
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['genreName'])) {
        $_SESSION['errors']['genreName'] = "Only character string is valid";
    }

    if (isset($_SESSION['errors'])) {
        return true;
    }
    else{
        return false;
    }

}

if (isset($_POST['add'])) {
    $data = $_POST;
    $error = validate($data,"add");
    if ($error == false) {
        $genre = $_POST['genreName'];
        $qry = "INSERT INTO `genre` (`genreName`) VALUES ('".$genre."')";
        include '../../includes/db_connect.php';
        $result = $con->query($qry);
        include '../../includes/db_close.php';

        if ($result == true) {
            $response = [
                'status' => 'success',
                'message' => 'Genre Added Successfully',
            ];
            
            
            $_SESSION['alert'] = $response;
           header('location:index.php');
        }
        else {
            $_SESSION['old_data'] = $data;
            $response = [
                'status' => 'error',
                'message' => 'Opps! Something Went Wrong',
            ];
            $_SESSION['alert'] = $response;
            header('location:create.php');
        }
    }

    else{
        $_SESSION['old_data'] = $data;
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        header('location:create.php');
    }
}

if (isset($_POST['update'])) {
    $data = $_POST;
    $error = validate($data,"update");
    $id = $_POST['id'];
    if ($error == false) {
    $genre = $_POST['genreName'];
    $qry = "update genre set genreName = '$genre' where genreID='$id'";
    include '../../includes/db_connect.php';
    $result =  $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Genre Updated Successfully',
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