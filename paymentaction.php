<?php
;require_once('Auth.php');
$auth=new Auth();
$khalti_public_key = "test_public_key_ac329b36d2824be6ab64b234a6cf6948";
$uniqueProductId ='test';
$uniqueUrl = "http://localhost/book_system";
$uniqueProductName = "test";

if(isset($_POST['mobile']) && isset($_POST['mpin']))
{

    $mobile=$_POST['mobile'];
    $mpin=$_POST['mpin'];
    include "includes/db_connect.php";
    $qry="select * from cart where userID='".$auth->getId()."' and checkedOut=0";
    $result=$con->query($qry);
    if($result->num_rows>0)
    {
        $cart=$result->fetch_assoc();
        $qry="SELECT sum(price) as amount from cartitems INNER JOIN books on cartitems.bookID=books.bookID WHERE cartID='".$cart['cartID']."'";
        $result=$con->query($qry);
        $data=$result->fetch_assoc();
    }
    include "includes/db_close.php";
    $amount=$data['amount'];
    $amount = (float) $amount * 100;

    try{
           
            $curl = curl_init();

            curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://khalti.com/api/v2/payment/initiate/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "public_key": "' . $khalti_public_key . '",
                "mobile": ' . $mobile . ',
                "transaction_pin": ' . $mpin . ',
                "amount": ' . ($amount) . ',
                "product_identity": "' . $uniqueProductId . '",
                "product_name": "' . $uniqueProductName . '",
                "product_url": "' . $uniqueUrl . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);
      
        curl_close($curl);
        $parsed = json_decode($response, true);


        if (key_exists("token", $parsed)) {
            $token = $parsed["token"];
            $message=[
                'status'=>'success',
                'token'=>$token
            ];
            $_SESSION['khalti_token']=$token;
            $_SESSION['khalti_mpin']=$mpin;
            $_SESSION['khalti_amount']=$amount;
        } else {
            $error_message = "incorrect mobile or mpin";
            $message=[
                'status'=>'error',
                'message'=>$error_message
            ];
        }
    } catch (Exception $e) {
        $error_message = "incorrect mobile or mpin";
        $message=[
            'status'=>'error',
            'message'=>$error_message
        ];

    }

    echo json_encode($message);
}

if(isset($_POST['otp']))
{
    try {
        $otp = $_POST["otp"];
        $token = $_SESSION["khalti_token"];
        $mpin = $_SESSION["khalti_mpin"];


        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://khalti.com/api/v2/payment/confirm/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "public_key": "' . $khalti_public_key . '",
            "transaction_pin": ' . $mpin . ',
            "confirmation_code": ' . $otp . ',
            "token": "' . $token . '"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        $parsed = json_decode($response, true);

        if (key_exists("token", $parsed)) {
            if ($parsed["amount"]==$_SESSION['khalti_amount']) {

                include "includes/db_connect.php";
                $qry="select * from cart where userID='".$auth->getId()."' and checkedOut=0";
                $result=$con->query($qry);
                if($result->num_rows>0)
                {
                    $cart=$result->fetch_assoc();
                    $qry="SELECT books.bookID from cartitems INNER JOIN books on cartitems.bookID=books.bookID WHERE cartID='".$cart['cartID']."'";
                    $result=$con->query($qry);
                    $bookIds=[];
                    while($data=$result->fetch_assoc())
                    {
                        $bookIds[]=$data['bookID'];
                    }
                    $qry="update cart set checkedOut=1 where cartID='".$cart['cartID']."'";
                    $con->query($qry);
                    $book_allowed=$auth->getBookAllowed(); 
                    $existingData = json_decode($book_allowed, true);
                    $mergedData = array_merge($existingData, $bookIds);  
                    $new_book_allowed=json_encode($mergedData);      
                    $qry="update users set book_allowed='".$new_book_allowed."' where userID='".$auth->getId()."'";
                    $con->query($qry);      

                }
                include "includes/db_close.php";
                $message=[
                    'status'=>'success',
                    'message'=>'payment success'
                ];
                $_SESSION['alert'] = $message;
            }


        } else {
            $error_message = "couldnot process the transaction at the moment.";
            if (key_exists("detail", $parsed)) {
                $error_message = $parsed["detail"];
            }
            $message=[
                'status'=>'error',
                'message'=>$error_message
            ];

        }
    } catch (Exception $e) {
        $error_message = "couldnot process the transaction at the moment.";
        $message=[
            'status'=>'error',
            'message'=>$error_message
        ];

    }
    echo json_encode($message);
}


?>