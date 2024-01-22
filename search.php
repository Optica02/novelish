<?php include "includes/header.php" ?>
<?php

if($_GET['key'])
{
    
include "includes/db_connect.php";
$key='%'.$_GET['key'].'%';
$qry="select * from books where books.bookName like '".$key."'";
$result=$con->query($qry);
include "includes/db_close.php";
$book_allowed=$auth->getBookAllowed();
$book_allowed=json_decode($book_allowed);
}




?>
<section class="px-20 py-10 bg-blue-50">
    <div>
    <div class=" relative">
        <div class="flex justify-center relative z-10">
            <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold capitalize"><?php echo $_GET['key'] ?></h2>
        </div>
        <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
        </div>
      </div>
        <div class=" justify-center mt-10">
          <?php
          if($result->num_rows>0)
          {
          ?>
            <div class="grid lg:grid-cols-4 md:grid-cols-2  gap-5 card">
                <?php
                while($data=$result->fetch_assoc())
                {
                  if($book_allowed !=null)
                  {
                    ?>
                <div class="">
                  <div class="bg-white shadow-xl hover:-translate-y-2 transition-all ease-in-out duration-700 hover:shadow-2xl shadow-gray-400 border border-gray-200 rounded-lg  mb-5">
                      <div class="img-div h-[250px] ">
                        <a href="book.php?bookID=<?php echo $data['bookID']  ?>" class="">
                            <img class="rounded-t-lg w-full object-cover  h-full " src="/book_system/Images/books/<?php echo $data['image']  ?>" alt="">
                        </a>
                      </div>
                      <div class="p-5">
                          <a href="book.php?bookID=<?php echo $data['bookID']  ?>">
                              <h5 class="text-gray-900 font-bold text-base line-clamp-1 tracking-tight mb-2"><?php echo $data['bookName'] ?></h5>
                          </a>
                          
                          <div class=" pt-0 flex justify-between">
                            <a href="book.php?bookID=<?php echo $data['bookID']  ?>" class="inline-block ">
                              <button
                                class="w-full relative flex items-center gap-5  bg-transparent  text-blue-500 hover:text-white transition-all duration-500 px-3 py-1 font-xl rounded-md sm:mb-0 before:content-[''] before:absolute before:left-0 before:w-0 hover:before:w-full before:top-0 before:h-full before:bg-blue-500 before:transition-all before:duration-500 overflow-hidden"
                                type="button">
                                <span class="relative">Read More</span>
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                      stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </div>
                              </button>
                            </a>
                            
              
                            <span class=" cursor-default <?php echo in_array($data['bookID'],$book_allowed)?'text-green-600 uppercase':($data['premium']==1?'text-red-600':'text-green-600 uppercase')  ?>"><?php echo in_array($data['bookID'],$book_allowed)?'purchased':($data['premium']==1?'Rs. '.$data['price']:'free') ?></span>
                          </div>
                      </div>
                  </div>
                </div>
                <?php
                }
                else
                {
                  ?>
                  <div class="">
                  <div class="bg-white shadow-xl hover:-translate-y-2 transition-all ease-in-out duration-700 hover:shadow-2xl shadow-gray-400 border border-gray-200 rounded-lg  mb-5">
                      <div class="img-div h-[250px] ">
                        <a href="book.php?bookID=<?php echo $data['bookID']  ?>" class="">
                            <img class="rounded-t-lg w-full object-cover  h-full " src="/book_system/Images/books/<?php echo $data['image']  ?>" alt="">
                        </a>
                      </div>
                      <div class="p-5">
                          <a href="book.php?bookID=<?php echo $data['bookID']  ?>">
                              <h5 class="text-gray-900 font-bold text-base line-clamp-1 tracking-tight mb-2"><?php echo $data['bookName'] ?></h5>
                          </a>
                          
                          <div class=" pt-0 flex justify-between">
                            <a href="book.php?bookID=<?php echo $data['bookID']  ?>" class="inline-block ">
                              <button
                                class="w-full relative flex items-center gap-5  bg-transparent  text-blue-500 hover:text-white transition-all duration-500 px-3 py-1 font-xl rounded-md sm:mb-0 before:content-[''] before:absolute before:left-0 before:w-0 hover:before:w-full before:top-0 before:h-full before:bg-blue-500 before:transition-all before:duration-500 overflow-hidden"
                                type="button">
                                <span class="relative">Read More</span>
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                      stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </div>
                              </button>
                            </a>
                            <span class=" cursor-default <?php echo $data['premium']==1?'text-red-600':'text-green-600 uppercase' ?>"><?php echo $data['premium']==1?'Rs. '.$data['price']:'free' ?></span>
                          </div>
                      </div>
                  </div>
                </div>
                  <?php
                }
                }
                ?>
            </div>
          <?php
          }
          else
          {
          ?>
          <div>
            <h2 class="text-red-500 text-center font-bold text-xl ">Books Not Found...!!</h2>
          </div>
          <?php
          }
          ?>
        </div>
    </div>
</section>


<?php include "includes/footer.php" ?>
