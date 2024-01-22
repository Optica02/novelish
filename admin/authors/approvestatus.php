<?php
session_start();
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $qry = "update users set is_approved = 1 where userID='".$id."'";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Auther Approved Successfully',
        ];
        $_SESSION['alert'] = $response;
        echo '
            <script>
                window.location = "pending_author.php";
            </script>

             ';
    }
    else
    {
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        echo '
            <script>
                window.location = "pending_author.php";
            </script>

             ';

    }
}

session_write_close();

?>