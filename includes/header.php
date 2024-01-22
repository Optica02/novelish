<?php

require_once('Auth.php');
$auth = new Auth();

include "includes/db_connect.php";
$genreQuery = "select * from genre";
$genreResult = $con->query($genreQuery);
if($auth->isLoggedIn())
{
    $qry="SELECT COUNT(cartitems.bookID) as cart from users INNER JOIN cart on cart.userID=users.userID INNER JOIN cartitems on cart.cartID=cartitems.cartID WHERE users.userID='".$auth->getId()."' and cart.checkedOut=0";
    $countResult=$con->query($qry);
    $count=$countResult->fetch_assoc();
}
include "includes/db_close.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="input.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

     <!-- sweetalert links  -->
     <link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
    <script src="plugins/sweetalert/sweetalert2.min.js"></script>

    <!-- {{-- font awesome link --}} -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- end of google font link -->
   
        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
     <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    


</head>

<body>

    <!-- toast  -->
    <section id="toast" class="toast top-5  shadow-xl text-white">
        <div class="flex px-2  py-2 ">
            <div class="my-1 mr-3">
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


    <nav class="bg-white shadow-xl px-20 py-2 sticky top-0 z-50">
        <div class="flex justify-between items-center text-xl">
            <a href="index.php">
                <div class="w-[100px]">
                    <img class="w-full" src="logo.jpeg" alt="">
                </div>
            </a>
            <div>
                <ul class="flex gap-5 items-center">
                    <li><a href="index.php" class="relative cursor-pointer before:rounded-lg before:content-[''] before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1">Home</a></li>
                    <li class="group relative">
                        <a href="" class="flex items-center gap-1  relative before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1">Genre<i class="fa-solid fa-angle-down mt-0.5"></i></a>
                        <div class="group-hover:z-10  pointer-events-none group-hover:pointer-events-auto -z-1 absolute -left-5 opacity-0 invisible -mt-3 transition-all duration-500 pt-4 min-w-[250px] w-auto group-hover:visible group-hover:opacity-100 group-hover:mt-0">
                            <ul class="bg-white rounded-xl shadow-lg shadow-gray-700 p-4">
                                <?php
                                while ($genreData = $genreResult->fetch_assoc()) {
                                ?>
                                    <li class="mt-2 flex"><a href="genre.php?genreID=<?php echo $genreData['genreID'] ?>" class="relative capitalize before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><?php echo $genreData['genreName']  ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li><a href="about.php" class="relative cursor-pointer before:rounded-lg before:content-[''] before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1">About Us</a></li>
                    <li><a href="contact.php" class="relative cursor-pointer before:rounded-lg before:content-[''] before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1">Contact Us</a></li>
                    <li class="w-[400px]">
                        <form action="search.php" method="GET" class="w-full">   
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" id="default-search" name="key" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 d" placeholder="Search " required>
                                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="flex gap-3">
                <?php
                if($auth->isLoggedIn())
                {
                ?>
                <a href="cart.php">
                    <div class="cursor-pointer relative">
                        <span class="absolute bg-red-500 px-1.5 text-white rounded-full -top-3 -right-1 text-sm"><?php echo $count['cart']  ?></span>
                        <i class="fa-solid text-2xl fa-cart-shopping"></i>
                    </div>
                </a>
                <?php
                }
                else
                {
                    ?>
                    <a href="cart.php">
                        <div class="cursor-pointer">
                            <i class="fa-solid text-2xl fa-cart-shopping"></i>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <div class="cursor-pointer relative group">
                    <i class="fas fa-user text-2xl"></i>
                    <div class="group-hover:z-10 w-[150px] -right-5   pointer-events-none group-hover:pointer-events-auto -z-1 absolute opacity-0 invisible -mt-3 transition-all duration-500 pt-4 group-hover:visible group-hover:opacity-100 group-hover:mt-0">
                        <ul class="bg-white rounded-xl text-lg shadow-lg shadow-gray-700 p-4">
                            <?php
                            if ($auth->isLoggedIn()) {
                                if ($auth->getRole() == "Author") {
                            ?>

                                    <li class="mt-2 flex gap-5"><a href="author" class="relative w-full before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><i class="fa-solid fa-home text-base mr-2"></i><span>Dashboard</span></a></li>
                                <?php
                                }
                                ?>
                                <li class="mt-2 flex gap-5"><a href="cart.php" class="relative w-full before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><i class="fa-solid fa-cart-shopping text-base mr-2"></i><span>Cart</span></a></li>
                                <li class="mt-2 flex gap-5"><a href="user_book.php" class="relative w-full before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><i class="fa-solid fa-book text-base mr-2"></i><span>Books</span></a></li>
                                <li class="mt-2 flex gap-5"><a href="logout.php" class="relative w-full before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><i class="fa-solid fa-right-from-bracket text-base mr-2"></i><span>Logout</span></a></li>
                                <?php
                            } else {
                                ?>
                                <li class="mt-2 flex gap-5"><a href="login.php" class="relative w-full before:content-[''] before:rounded-lg before:h-1 before:bg-red-500 before:absolute before:duration-500 hover:before:w-full before:w-0 before:-bottom-1"><i class="fa-solid fa-right-from-bracket text-base mr-2"></i><span>Login</span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>