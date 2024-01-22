<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="style.css">


</head>

<body class="font-sans">

    <div class="h-[100vh] bg-[#2F49C8]  flex items-center">
        <div class="grid grid-cols-2 gap-20 relative w-full mx-40 text-white after:content-[''] after:absolute after:left-1/2 after:w-1 after:bg-white after:h-full">
            <div class="flex items-center justify-center">
                <div>
                    <h2 class="text-4xl font-bold">Register Page</h2>
                    <p class="mt-2">Let's Register here</p>
                </div>
            </div>
            <div class="">
                <div class="justify-center flex">
                    <i class="fa-solid fa-users text-6xl"></i>
                </div>
                <form method="POST" action="action.php" class="mt-10 flex flex-col gap-5">
                    <div class="">
                        <div class="flex gap-3 border border-white p-2 rounded-xl ">
                            <i class="fa-solid fa-user text-base my-auto"></i>
                            <input name="name" id="name" value="<?php echo $_SESSION['old_data']['name'] ?? '' ?>" type="text" class="w-full bg-transparent  border-none border-gray-500 outline-none placeholder:text-white" placeholder="name">
                        </div>
                        <?php if (isset($_SESSION['errors']['name'])) :  ?>
                            <p class=" text-sm text-red-400"><?php echo $_SESSION['errors']['name'] ?> *</p>
                        <?php endif; ?>

                    </div>
                    <div class="">
                        <div class="flex gap-3 border border-white p-2 rounded-xl ">
                            <i class="fa-solid fa-envelope text-base my-auto"></i>
                            <input name="email" id="email" value="<?php echo $_SESSION['old_data']['email'] ?? '' ?>" type="text" class="w-full bg-transparent  border-none border-gray-500 outline-none placeholder:text-white" placeholder="Email">
                        </div>
                        <?php if (isset($_SESSION['errors']['email'])) :  ?>
                            <p class=" text-sm text-red-400"><?php echo $_SESSION['errors']['email'] ?> *</p>
                        <?php endif; ?>

                    </div>
                   
                    <div class="">
                        <div class="border border-white rounded-xl p-2  ">
                            <div class="flex gap-3">
                                <i class="fas fa-lock text-base my-auto"></i>
                                <input id="password"  value="<?php echo $_SESSION['old_data']['password'] ?? '' ?>" name="password" type="password" class="w-full bg-transparent  border-none border-gray-500 outline-none placeholder:text-white" placeholder="Password">
                            </div>
                        </div>
                        <?php if (isset($_SESSION['errors']['password'])) :  ?>
                            <p class=" text-sm text-red-400"><?php echo $_SESSION['errors']['password'] ?> *</p>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <div class="border border-white rounded-xl p-2 ">
                            <div class="flex gap-3">
                                <i class="fas fa-lock text-base my-auto"></i>
                                <input id="confirm_password" value="<?php echo $_SESSION['old_data']['confirm_password'] ?? '' ?>" name="confirm_password" type="password" class="w-full bg-transparent  border-none outline-none border-gray-500 placeholder:text-white" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <input type="checkbox" id="showPasswordCheckbox">
                        <label class="cursor-pointer" for="showPasswordCheckbox">Show Password</label>
                    </div>
                    <div class="">
                        <label for="role" class="block mb-2 text-sm font-medium text-white">Select role</label>
                        <select id="role" name="role" class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option selected value="User">User</option>
                            <option value="Author">Author</option>
                        </select>
                    </div>
                    <div class="mt-5">
                        <button type="submit" name="register" class="w-full border border-white font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-white py-2 rounded-xl hover:text-black before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Register</button>
                    </div>
                    <div class="flex justify-between mt-5">
                       
                        <a href="login.php" class="underline hover:text-blue-400">
                            Login
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
            togglePasswordVisibility("confirm_password", "showPasswordCheckbox");
        });
    });
   
</script>

</html>


<?php

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
if (isset($_SESSION['old_data'])) {
    unset($_SESSION['old_data']);
}


?>