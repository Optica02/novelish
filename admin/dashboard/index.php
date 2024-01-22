 <?php
  include '../admin_nav.php';
  ?>


 <?php

    include '../../includes/db_connect.php';
    $genreQry="select count(*) as count from genre";
    $bookQry="select count(*) as count from books";
    $userQry="select count(*) as count from users where role='User'";
    $authorQry="select count(*) as count from users where role='Author' and is_approved=1";

    $bookResult=$con->query($bookQry);
    $book=$bookResult->fetch_assoc();
    $userResult=$con->query($userQry);
    $user=$userResult->fetch_assoc();
    $authorResult=$con->query($authorQry);
    $author=$authorResult->fetch_assoc();
    $genreResult=$con->query($genreQry);
    $genre=$genreResult->fetch_assoc();
    include '../../includes/db_close.php';


 ?>

 <div class="lg:py-20 mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
     id="mainarea">
     <h1 class="text-xl font-bold text-[#061638]">Admin Dashboard</h1>
     <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
     
     <div class="grid grid-cols-2 gap-5">
       
                <div class="bg-[#F9F5F6] px-20 py-10 drop-shadow-lg rounded-tl-3xl rounded-br-3xl">
                    <h1 class="cursor-pointer text-blue-600 text-center uppercase hover:text-blue-800 font-bold font-sans text-2xl"><a href="https://localhost/book_system/admin/genre/">Total <span class="uppercase">Genre</span></a></h1>
                    <p class="cursor-pointer text-center text-4xl font-bold text-gray-950 hover:text-gray-500"><?php echo $genre['count'];?></p>
                </div>

                <div class="bg-[#F9F5F6] px-20 py-10 drop-shadow-lg rounded-tl-3xl rounded-br-3xl">
                    <h1 class="cursor-pointer text-blue-600 text-center uppercase hover:text-blue-800 font-bold font-sans text-2xl"><a href="https://localhost/book_system/admin/books/">Total <span class="uppercase">Books</span></a></h1>
                    <p class="cursor-pointer text-center text-4xl font-bold text-gray-950 hover:text-gray-500"><?php echo $book['count'];?></p>
                </div>

                <div class="bg-[#F9F5F6] px-20 py-10 drop-shadow-lg rounded-tl-3xl rounded-br-3xl">
                    <h1 class="cursor-pointer text-blue-600 text-center uppercase hover:text-blue-800 font-bold font-sans text-2xl"><a href="https://localhost/book_system/admin/authors/">Total <span class="uppercase">Authors</span></a></h1>
                    <p class="cursor-pointer text-center text-4xl font-bold text-gray-950 hover:text-gray-500"><?php echo $author['count'];?></p>
                </div>

                <div class="bg-[#F9F5F6] px-20 py-10 drop-shadow-lg rounded-tl-3xl rounded-br-3xl">
                    <h1 class="cursor-pointer text-blue-600 text-center uppercase hover:text-blue-800 font-bold font-sans text-2xl"><a href="https://localhost/book_system/admin/users/">Total <span class="uppercase">Users</span></a></h1>
                    <p class="cursor-pointer text-center text-4xl font-bold text-gray-950 hover:text-gray-500"><?php echo $user['count'];?></p>
                </div>
           
    </div>

    <div class="bg-[#f7f3f3] px-10 py-10 mt-10 drop-shadow-xl rounded-tl-3xl rounded-br-3xl">
        <h1 class="text-center text-xl font-semibold">!! Welcome <span class="text-blue-600 hover:text-blue-800"><?php echo $auth->getName(); ?></span> in this Portal, Feel free to manage your task. !!</h1>
    </div>
 </div>


 <?php include '../admin_footer.php';?>