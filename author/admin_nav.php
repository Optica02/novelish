<?php
require_once '../../Auth.php';

$auth=new Auth();
if(!$auth->isLoggedIn())
{
    header('location:../../login.php');
}
else
{
    if($auth->getRole()=="User")
    {
        header('location:../../index.php');
    }
    else if($auth->getRole()=="Admin")
    {
        header('location:../../admin');
    }
    else{
        if(!$auth->isApproved())
        {
            $response = [
                'status' => 'error',
                'message' => "Contact admin for approval.",
              ];
              $_SESSION['alert'] = $response;
            header('location:../../index.php');
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <!-- input css -->
    <link rel="stylesheet" href="../../input.css">

         <!-- sweetalert links  -->
        <link rel="stylesheet" href="../../plugins/sweetalert/sweetalert2.min.css">
        <script src="../../plugins/sweetalert/sweetalert2.min.js"></script>

    <!-- data table links  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js"
        integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- toast notification  -->

       <!-- toast notification  -->
       <link rel="stylesheet" href="../../toastify.css">
        <link rel="stylesheet" href="../../style.css">
        <script src="../../toastify.js"></script>
        
        <script src="../../tailstyle.js"></script>
    
    <title>Home</title>
    <style>
    .hide {
        display: none !important;

    }
    </style>
</head>

<body>
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
    <!-- Start of Side Navbar -->

    <div class="bg-[#061638] w-[20%] fixed text-white flex md:block md:px-6 top-0 left-0 bottom-0" id="sidebarnav">
        <div class="mx-auto md:mx-0 flex-col">
            <h1 class="text-xl font-bold ml-2.5">
                <a href="#"><span class="lg:hidden">N</span><span id="NepaNewstitle" class="hidden lg:inline-block">
                        Novelish</span><span class="text-4xl text-red-600">.</span></a>
            </h1>

            <ul class="pt-10 space-y-4 text-lg" id="menu">
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="dashboard">
                    <a href="../index.php" class="px-2">
                        <i class="fas fa-home"></i><span class="sidbarNavItemName hidden lg:inline-block ml-1">
                            Dashboard</span></a>
                </li>
                
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="books">
                    <a href="../books/" class="px-2">
                        <i class="fas fa-book"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Books</span></a>
                </li>
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="books">
                    <a href="../profile/" class="px-2">
                        <i class="fas fa-user"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Profile</span></a>
                </li>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="books">
                    <a href="../../index.php" class="px-2">
                        <i class="fas fa-globe"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Back To Site</span></a>
                </li>
               
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]">
                    <a href="../../logout.php" class="px-2">
                        <i class="fas fa-sign-out"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- End of Side Navbar -->

    <!-- Start of Top Navbar -->

    <div class="fixed transparent-all z-30 duration-1000 ease hidden lg:block top-0 right-0 left-[20%] text-xl py-4 px-8 text-[#c4c4c4] bg-white border-b-2 border-b-[#c4c4c4]"
        id="topbarnav">
        <div class="grid grid-cols-2">
            <div>
                <a onclick="sidebarToggle()"><i
                        class="text-left cursor-pointer fas fa-bars hover:text-[#606060]"></i></a>
            </div>
            <div class="space-x-4 text-right">
                <a href="../../logout.php"><i class="far fa-sign-out-alt hover:text-[#606060]"></i></a>     
            </div>
        </div>
    </div>

    <!-- End of Top Navbar -->