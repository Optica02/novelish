<?php include "includes/header.php" ?>
<?php

$popularQry="select * from books order by download desc limit 8";
$recentQry="select * from books order by bookID desc limit 8";
include "includes/db_connect.php";
$popularResult=$con->query($popularQry);
$recentResult=$con->query($recentQry);
include "includes/db_close.php";
$book_allowed=$auth->getBookAllowed();
$book_allowed=json_decode($book_allowed);

?>
<section>
         <!-- Swiper -->
  <div class="swiper mySwiper hero-swiper lg:h-[90vh] h-[50vh]">
      <div class="swiper-wrapper h-full">
          
          <div class="swiper-slide">
            <div class="w-full h-full relative">
              <div class="absolute z-10 top-0 w-full left-0 h-full flex items-center justify-center">
                <div class="text-white text-center lg:w-1/2">
                  <h2 class="lg:text-6xl md:text-4xl text-base font-extrabold">Novelish</h2>
                  <p class="lg:px-24 px-14 mt-5 text-xs md:text-base lg:text-base">
                  "Discover worlds between the covers. Novelish - where every page sparks a journey. Immerse yourself in tales that transcend. Unleash your imagination with the magic of words. Elevate your reading experience with Novelish - Your Gateway to Endless Stories"
                  </p>
                </div>
              </div>
              <div class="w-full h-full">
                <img class="w-full h-full brightness-50" src="Images/bookbg2.jpg" />
              </div>
            </div>
          </div>
        
          <div class="swiper-slide">
            <div class="w-full h-full relative">
              <div class="absolute z-10 top-0 w-full left-0 h-full flex items-center justify-center">
                <div class="text-white text-center lg:w-1/2">
                  <h2 class="lg:text-6xl md:text-4xl text-base font-extrabold">Novelish</h2>
                  <p class="lg:px-24 px-14 mt-5 text-xs md:text-base lg:text-base">
                  "Discover worlds between the covers. Novelish - where every page sparks a journey. Immerse yourself in tales that transcend. Unleash your imagination with the magic of words. Elevate your reading experience with Novelish - Your Gateway to Endless Stories"
                  </p>
                </div>
              </div>
              <div class="w-full h-full">
                <img class="w-full h-full brightness-50" src="Images/bookbg3hd.jpg" />
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="w-full h-full relative">
              <div class="absolute z-10 top-0 w-full left-0 h-full flex items-center justify-center">
                <div class="text-white text-center lg:w-1/2">
                  <h2 class="lg:text-6xl md:text-4xl text-base font-extrabold">Novelish</h2>
                  <p class="lg:px-24 px-14 mt-5 text-xs md:text-base lg:text-base">
                  "Discover worlds between the covers. Novelish - where every page sparks a journey. Immerse yourself in tales that transcend. Unleash your imagination with the magic of words. Elevate your reading experience with Novelish - Your Gateway to Endless Stories"
                  </p>
                </div>
              </div>
              <div class="w-full h-full">
                <img class="w-full h-full brightness-50" src="Images/bookbg4hd.jpg" />
              </div>
            </div>
          </div>
        
      </div>
      <div class="absolute z-10 top-1/2 lg:right-5 right-0.5 border-2 border-white hover:bg-transparent hover:text-white text-black transit duration-300 ease-linear  bg-white rounded-full px-2 py-[3px] hero-swiper-button-next">
          <i class="fa-solid fa-arrow-right text-3xl"></i>
      </div>
      <div class="absolute z-10 top-1/2 lg:left-5 left-0.5 border-2 border-white hover:bg-transparent hover:text-white text-black transit duration-300 ease-linear  bg-white rounded-full px-2 py-[3px] hero-swiper-button-prev">
          <i class="fa-solid fa-arrow-left text-3xl"></i>
      </div>
      <div class="hero-swiper-button-prev"></div>
      <div class="swiper-pagination hero-swiper-pagination"></div>
  </div>

</section>

<section class="px-20 py-10 bg-blue-50">

<!-- trending books -->
    <div>
        <div class=" relative">
            <div class="flex justify-center relative z-10">
                <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold">Trending Books</h2>
            </div>
            <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
            </div>
        </div>
        <div class=" justify-center mt-10">
            <div class="grid lg:grid-cols-4 md:grid-cols-2  gap-5 card">
                <?php
                while($data=$popularResult->fetch_assoc())
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
        </div>
    </div>
    <!-- end of trending books -->

    
<!-- Recent books -->
    <div class="mt-20">
        <div class=" relative">
            <div class="flex justify-center relative z-10">
                <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold">Recent Books</h2>
            </div>
            <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
            </div>
        </div>
        <div class=" justify-center mt-10">
            <div class="grid lg:grid-cols-4 md:grid-cols-2  gap-5 card">
                <?php
                while($data=$recentResult->fetch_assoc())
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
        </div>
    </div>
    <!-- end of recent books -->


</section>

<script>
        var swiper = new Swiper(".hero-swiper", {
        spaceBetween: 30,
        effect: "fade",
        autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
        navigation: {
            nextEl: ".hero-swiper-button-next",
            prevEl: ".hero-swiper-button-prev",
        },
        pagination: {
            el: ".hero-swiper-pagination",
            clickable: true,
        },
        });

        var swiper = new Swiper(".testimonial-swiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          loop:true,
          coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2.5,
            slideShadows: false,
          },
          pagination: {
            el: ".testimonial-pagination",
          },
          navigation: {
            nextEl: ".testimonial-swiper-button-next",
            prevEl: ".testimonial-swiper-button-prev",
          },
        });
    </script>


<?php include "includes/footer.php" ?>
