
<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="style.css">
    <script>
        // Check if the success message is set in the session
        <?php if (isset($_SESSION['passwordReset']) &&$_SESSION['passwordReset']==true) : ?>
            // Display the success message using JavaScript alert
            alert("Password Reset successfully! check your email");
            // Remove the success message from the session
            <?php unset($_SESSION['passwordReset']); ?>
        <?php endif; ?>
    </script>

</head>

<body class="font-sans">


<!-- toast  -->
<section id="toast"  class="toast top-5 z-50  shadow-xl text-white">
        <div class="flex px-2  py-2 ">
            <div  class="my-1 mr-3">
                <button id="toastStatus" class=" rounded-full bg-transparent border-2 border-solid">

                </button>
            </div>
            <div>
                <h2 id="toastTitle" class="font-bold "></h2>
                <p id="toastMessage"></p>
            </div>
        </div>
        <div id="toastProgressBar" class="progress-bar"></div>
    </section>
    <!-- toast end -->


    <div class="h-[100vh] bg-[#2F49C8] flex items-center">
        <div class="grid grid-cols-2 gap-20 relative w-full mx-40 text-white after:content-[''] after:absolute after:left-1/2 after:w-1 after:bg-white after:h-full">
            <div class="flex items-center justify-center">
                <div>
                    <h2 class="text-4xl font-bold">Login Page</h2>
                    <p class="mt-2">Let's login here</p>
                </div>    
            </div>
            <div class="">
                <div class="justify-center flex">
                    <i class="fa-solid fa-users text-6xl"></i>
                </div>
                <form method="POST" action="action.php" class="mt-10">
                    <div class="">
                        <div class="flex gap-3 border border-white p-2 rounded-xl mt-2">
                            <i class="fa-solid fa-envelope text-base my-auto"></i>
                            <input name="email" id="email" value="<?php echo $_SESSION['old_data']['email'] ?? '' ?>" type="text" class="w-full text-white border-none !outline-none bg-transparent placeholder:text-white" placeholder="Email">
                        </div>
                        <?php if (isset($_SESSION['errors']['email'])) :  ?>
                            <p class="text-sm text-red-400"><?php echo $_SESSION['errors']['email'] ?> *</p>
                        <?php endif; ?>
                    </div>
                    <div class="mt-8">
                        <div class="flex gap-3 border border-white p-2 rounded-xl mt-2">
                            <i class="fas fa-lock text-base my-auto"></i>
                            <input name="password" type="password" id="password" value="<?php echo $_SESSION['old_data']['password'] ?? '' ?>" class="w-full  border-none border-gray-500 !outline-none bg-transparent placeholder:text-white" placeholder="Password">
                        </div>
                        <?php if (isset($_SESSION['errors']['password'])) :  ?>
                            <p class="text-sm text-red-400"><?php echo $_SESSION['errors']['password'] ?> *</p>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">

                        <input class="cursor-pointer" type="checkbox" id="showPasswordCheckbox">
                        <label class="cursor-pointer" for="showPasswordCheckbox">Show Password</label>
                    </div>
                    <div class="mt-5">
                        <button type="submit" name="login" class="w-full border border-white font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-white py-2 rounded-xl hover:text-black before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Login</button>
                    </div>
                    <div class="flex justify-between mt-5">
                        
                        <a href="auth/forgotpassword.php" class="underline hover:text-blue-400">
                            Forgot Password?
                        </a>
                        <a href="register.php" class="underline hover:text-blue-400">
                            Register
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    function togglePasswordVisibility(inputField, checkboxId) {
        const passwordInput = document.getElementById(inputField);
        const checkbox = document.getElementById(checkboxId);

        passwordInput.type = checkbox.checked ? "text" : "password";
    }

    document.addEventListener("DOMContentLoaded", function() {
        const showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

        showPasswordCheckbox.addEventListener("change", function() {
            togglePasswordVisibility("password", "showPasswordCheckbox");
        });
    });
</script>


<!-- toast script -->
<script>
    <?php
        if (isset($_SESSION['alert']))
        {
            $response = json_encode($_SESSION['alert']);
            echo "
            showToast($response);
            unsetSession();
            
            ";
    
        }
    ?>
    function showToast(response)
    {
        console.log(response.status);
        var toast = document.getElementById('toast');
        var toastStatus = document.getElementById('toastStatus');
        var toastTitle = document.getElementById('toastTitle');
        var toastMessage = document.getElementById('toastMessage');
        var toastProgressBar = document.getElementById('toastProgressBar');
        if(response.status =="success")
        {
            toastStatus.innerHTML='<i class="fas fa-check"></i>';
            toastStatus.classList.add('success');
            toast.classList.add('success');
        }
        else
        {
            toastStatus.innerHTML='<i class="fa fa-times"></i>';
            toastStatus.classList.add('error');
            toast.classList.add('error');
        }
        toastTitle.innerHTML=response.status;
        toastMessage.innerHTML=response.message;
        toast.classList.add('show');
        toastProgressBar.style.width = '100%';
        toastProgressBar.style.width = '0%';
        setTimeout(function()
        {
            toast.classList.remove('show');
        }, 3000);
    }
    function unsetSession()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'unset_session.php', true);
        xhr.send();
    }
</script>
<!-- end of toast script -->


</html>




<?php

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
if (isset($_SESSION['old_data'])) {
    unset($_SESSION['old_data']);
}


?>