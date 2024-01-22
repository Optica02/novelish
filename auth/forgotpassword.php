<?php
session_start();
function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
    $password = '';
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }
    
    return $password;
}



if(isset($_POST['forgot_password']))
{

    $email=$_POST['email'];
    include "../includes/db_connect.php";
    $qry = "select * from users where email='" . $email . "'";
    $result = $con->query($qry);
    $data=$result->fetch_assoc();
    $rowCount = mysqli_num_rows($result);
    // die($rowCount);

    if (!$rowCount > 0) {
        $_SESSION['errors']['email'] = 'Email not found';
    }

    if (!isset($_SESSION['errors'])) {
        include "sendPasswordMail.php";
        // Example: Generate a random password with a length of 12 characters
        $generatedPassword = generateRandomPassword(8);
        $passwordHash = password_hash($generatedPassword, PASSWORD_DEFAULT);
        $id=$data['userID'];
        $qry="update users set password='".$passwordHash."' where userID='".$id."'";
        if($con->query($qry) ===true && sendPasswordMail($email,$generatedPassword))
        {
            $con->close();
            $_SESSION['passwordReset']=true;
            header("location:../login.php");
            exit();
        }
    }
    else
    {
        $data['email']=$email;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../input.css">
    <link rel="stylesheet" href="style.css">
    

</head>

<body class="font-sans">
    <div class="h-[100vh] bg-[#2F49C8] flex items-center">
        <div class="grid grid-cols-2 gap-20 relative w-full mx-40 text-white after:content-[''] after:absolute after:left-1/2 after:w-1 after:bg-white after:h-full">
            <div class="flex items-center justify-center">
                <div>
                    <h2 class="text-4xl font-bold">Password Reset Page</h2>
                    <p class="mt-2">Enter Your Email</p>
                </div>    
            </div>
            <div class="">
                <div class="justify-center flex">
                    <i class="fa-solid fa-users text-6xl"></i>
                </div>
                <form method="POST" class="mt-10">
                    <div class="">
                        <div class="flex gap-3 border border-white p-2 rounded-xl mt-2">
                            <i class="fa-solid fa-envelope text-base my-auto"></i>
                            <input name="email" id="email" value="<?php echo $_SESSION['old_data']['email'] ?? '' ?>" type="text" class="w-full text-white border-none !outline-none bg-transparent placeholder:text-white" placeholder="Email">
                        </div>
                        <?php if (isset($_SESSION['errors']['email'])) :  ?>
                            <p class="text-sm text-red-400"><?php echo $_SESSION['errors']['email'] ?> *</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-5">
                        <button type="submit" name="forgot_password" class="w-full border border-white font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-white py-2 rounded-xl hover:text-black before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Reset</button>
                    </div>
                    <div class="flex justify-between mt-5">
                        
                       
                        <a href="../login.php" class="underline hover:text-blue-400">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

?>