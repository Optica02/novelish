<?php
require_once '../Auth.php';

$auth=new Auth();
if(!$auth->isLoggedIn())
{
    header('location: ../login.php');
}
else
{
    if($auth->getRole()=="Author")
    {
        header('location: dashboard');
    }
    else if($auth->getRole()=="Admin")
    {
        header('location: ../admin');
    }
    else
    {
        header('location: ../index.php');
    }
}


?>