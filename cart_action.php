<?php
require_once('Auth.php');
$auth=new Auth();

if(isset($_POST['add_to_cart']))
{
    $bookID=$_POST['bookID'];
    include "includes/db_connect.php";
    $qry="select * from cart where userID='".$auth->getId()."' and checkedOut=0";
    $result=$con->query($qry);
    if($result->num_rows>0)
    {
        $cart=$result->fetch_assoc();
        $qry="select * from cartitems where cartID='".$cart['cartID']."' and bookID='".$bookID."'";
        $result=$con->query($qry);
        if($result->num_rows>0)
        {
            $response = [
                'status' => 'error',
                'message' => "Book Already Exists!"
              ];
              $_SESSION['alert'] = $response;
              header("location:book.php?bookID=".$bookID);
        }
        else
        {
            $qry="insert into cartitems (cartID,bookID) values('".$cart['cartID']."','".$bookID."')";
            $result=$con->query($qry);
            if($result)
            {
                $response = [
                    'status' => 'success',
                    'message' => "Book Added Successfully"
                  ];
                  $_SESSION['alert'] = $response;
                  header("location:book.php?bookID=".$bookID);
            }
        }
    }
    else
    {
       $qry="insert into cart (userID,checkedOut) values('".$auth->getId()."',0)";
       $result=$con->query($qry);
       if($result)
       {
        $qry="select * from cart where userID='".$auth->getId()."' and checkedOut=0";
        $result=$con->query($qry);
        $cart=$result->fetch_assoc();
        $qry="insert into cartitems (cartID,bookID) values('".$cart['cartID']."','".$bookID."')";
        $result=$con->query($qry);
        if($result)
        {
            $response = [
                'status' => 'success',
                'message' => "Book Added Successfully"
              ];
              $_SESSION['alert'] = $response;
              header("location:book.php?bookID=".$bookID);
        }
       }
    }
    include "includes/db_close.php";
}

if(isset($_POST['delete']))
{
    include 'includes/db_connect.php';

    $id=$_POST['id'];
    
   $qry = "delete from cartitems where itemID='$id' ";
    
    if (mysqli_query($con, $qry)) {
           echo $id;
       }else {
           echo "Error: " . $qry . "<br>" . mysqli_error($con);
       }
   
    include 'includes/db_close.php';
}


?>