<?php
require_once "Auth.php";
$auth=new Auth();
if(isset($_POST['feedback_submit']))
{
    $feedback=$_POST['feedback_message'];
    $bookID=$_POST['bookID'];
    if(empty($feedback))
    {
        $response = [
            'status' => 'error',
            'message' => "Feedback is Required"
          ];
          $_SESSION['alert'] = $response;
          header("location:book.php?bookID=".$bookID);
    }
    else
    {
        include "includes/db_connect.php";
        $qry="insert into feedback (bookID,userID,message,created_at) values('".$bookID."','".$auth->getId()."','".$feedback."',CURRENT_TIMESTAMP)";
        $result=$con->query($qry);
        include "includes/db_close.php";
        if($result)
        {
            $response = [
                'status' => 'success',
                'message' => "Thank You For The Feedback!"
              ];
              $_SESSION['alert'] = $response;
              header("location:book.php?bookID=".$bookID);
        }
    }
    
}


?>