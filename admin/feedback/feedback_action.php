<?php

session_start();

function validate($data,$for)
{
    if (empty($data['message'])) {
         $_SESSION['errors']['message'] = "Message is required";
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
    $error = validate($data,"update");
    $id = $_POST['id'];
    if ($error == false) {
    $message = $_POST['message'];
    $qry = "update feedback set message = '$message' where feedbackID='$id'";
    include '../../includes/db_connect.php';
    $result =  $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Feedback Updated Successfully',
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