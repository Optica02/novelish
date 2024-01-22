<?php
include "middleware.php"
?>
<?php include "includes/header.php" ?>
<?php 
if(isset($_GET['bookID']))
{
    $bookID=$_GET['bookID'];
    $qry="select * from books where bookID='".$bookID."'";
    include "includes/db_connect.php";
    $result=$con->query($qry);
    $data=$result->fetch_assoc();
    $qry="select users.*,feedback.* from feedback inner join users on feedback.userID=users.userID where bookID='".$bookID."' order By created_at DESC";
    $feedbackResult=$con->query($qry);
    include "includes/db_close.php";
}


function timeCalculate($created_at)
{
    // Set the time zone to Nepal
    date_default_timezone_set('Asia/Kathmandu');
    // Get the current timestamp
    // $currentDateTime = date('Y-m-d H:i:s');
    $currentTimestamp = date('Y-m-d H:i:s');
    $createdTimestamp=$created_at;

    // Convert the timestamps to DateTime objects
    $createdAtDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $createdTimestamp);
    // $createdAtDateTime = new DateTime("@$createdTimestamp");
    $currentDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $currentTimestamp);
    // die(print_r($createdAtDateTime, true));
    // die(print_r($currentDateTime, true));




    // Calculate the difference between the two timestamps
    $interval = $currentDateTime->diff($createdAtDateTime);
    // die(print_r($interval, true));

    // Determine the appropriate time unit based on the interval
    if ($interval->y >= 1) {
        // If the difference is at least 1 year
        $timeAgo = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
    } elseif ($interval->m >= 1) {
        // If the difference is at least 1 month
        $timeAgo = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
    } elseif ($interval->d >= 1) {
        // If the difference is at least 1 day
        $timeAgo = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
    } elseif ($interval->h >= 1) {
        // If the difference is at least 1 hour
        $timeAgo = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
    } elseif ($interval->i >= 1) {
        // If the difference is at least 1 minute
        $timeAgo = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
    } else {
        // If the difference is less than 1 minute
        $timeAgo = "just now";

    }

    return $timeAgo;


}

?>

<section class="px-20 py-10 bg-blue-50">
    <div class="grid grid-cols-5 gap-10">
        <div class="col-span-2">
            <img class="rounded-xl w-full " src="Images/books/<?php echo $data['image'] ?>" alt="">
        </div>
        <div class="mt-5 col-span-2">
            <h2 class="text-2xl font-bold"><?php echo $data['bookName'] ?></h2>
            <hr class="bg-black h-1 mt-1 w-full">
            <?php
            if($data['premium']==1)
            {
                $book_allowed=$auth->getBookAllowed();
                $book_allowed=json_decode($book_allowed);
                if($book_allowed!=null && in_array($data['bookID'],$book_allowed))
                {
                    ?>
                    <h2 class=" mt-2 text-green-600 uppercase">Purchased</h2>
                    <div class="my-5 flex gap-5">
                        <div class="flex">
                            <a href="Books/<?php echo $data['book'] ?>" target="_blank" class="flex">
                                <div class="w-full border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-xl hover:text-white before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Read Book</div>
                            </a>
                        
                        </div>
                    </div>
                    <?php
                }
                else{

                ?>
                <h2 class=" mt-2 text-red-600"">Rs. <?php echo $data['price']?></h2>
                <div class="my-5 flex gap-5">
                    <div class="flex">
                        <form action="cart_action.php" method="POST">
                            <input type="hidden" name="bookID" value="<?php echo $data['bookID'] ?>">
                            <button type="submit" name="add_to_cart" class="w-full border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-xl hover:text-white before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <?php
                }
            }
            else
            {
                ?>
                <h2 class=" mt-2 text-green-600 uppercase">Free</h2>
                <div class="my-5 flex gap-5">
                    <div class="flex gap-5">
                    <a href="Books/<?php echo $data['book'] ?>" download class="flex">
                        <div class="w-full border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-xl hover:text-white before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Download</div>
                    </a>
                    <a href="Books/<?php echo $data['book'] ?>" target="_blank" class="flex">
                        <div class="w-full border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-xl hover:text-white before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Read Book</div>
                    </a>
                     
                    </div>
                </div>
                <?php
            }
            ?>
            <div>
                <p><?php echo $data['description'] ?></p>
            </div>
        </div>
        <div class="">
                <div class=" mt-1">
                    <div class=" relative">
                        <div class="flex justify-center relative z-10">
                            <h2 class="bg-blue-50 px-2 text-blue-800 text-base font-bold">Recent Feedbacks</h2>
                        </div>
                        <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
                        </div>
                    </div>
                </div>
                <div class="">
                            <!-- element to be in loop -->
                            <?php 
                            if($feedbackResult->num_rows>0)
                            {
                                while($feedback=$feedbackResult->fetch_assoc() )
                                {
                            ?>
                                <div class="cursor-default font-semibold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                    <div>
                                        <span class="text-gray-400 text-xs">
                                            <?php
                                                $timeAgo=timeCalculate($feedback['created_at']);
                                                echo $timeAgo; 
                                            ?>
                                        </span>
                                        <h2 class="cursor-pointer text-lg hover:text-blue-500">
                                                <?php echo $feedback['name']; ?>
                                        </h2>
                                        <p class="font-normal text-xs">
                                                <?php echo $feedback['message']; ?>
                                        </p>
                                    </div>
                                </div>    
                            <?php
                            }
                            }
                            else
                            {
                                ?>
                            <div class="cursor-default font-semibold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                <p class="text-red-600 text-sm hover:text-red-800 cursor-pointer text-center">No any feebacks here!</p>
                            </div>
                                <?php
                            }   
                            ?>
                    

                </div>
        </div>
    </div>



    <!-- comment section -->
    <div class=" mt-20">
        <div class="w-1/2 mx-auto">
            <div class=" relative">
                <div class="flex justify-center relative z-10">
                    <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold capitalize">Write a Feeback</h2>
                </div>
                <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
                </div>
            </div>
            <form method="POST" action="feedback_action.php"  class="flex flex-col gap-5 mt-5">
                <input type="hidden" name="bookID" value="<?php echo $data['bookID'] ?>">
                <div>
                    <div class="relative">
                        <textarea name="feedback_message" id="feedback_message" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "></textarea>
                        <label for="feedback_message"  class="absolute text-base text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Write Your Feedback..!!</label>
                    </div>
                    
                </div>
                
                <div class="mt-2 justify-end flex gap-5">
                    <button type="submit" name="feedback_submit" class="w-full border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-lg hover:text-white before:content-[''] before:absolute before:top-full hover:before:top-0 before:left-0 before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out ">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!--end of comment section -->

    
</section>



<?php include "includes/footer.php" ?>
