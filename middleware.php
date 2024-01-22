<?php

require_once('Auth.php');
$auth=new Auth();

if(!$auth->isLoggedIn())
{
    $response = [
        'status' => 'error',
        'message' => " Login in first!",
      ];
      $_SESSION['alert'] = $response;
      header('location:login.php');
}
?>