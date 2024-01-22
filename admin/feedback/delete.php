<?php
 include '../../includes/db_connect.php';

 $id=$_POST['id'];
 $qry = "delete from feedback where feedbackID='$id' ";
 
 if (mysqli_query($con, $qry)) {
        echo $id;
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

 include '../../includes/db_close.php';


?>