<?php
session_start();
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $message=$_POST['message'];
    $address=$_POST['address'];
    
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $response=[
            'status'=>'error',
            'message'=>'please fill all the fields'
        ];
        $_SESSION['alert']=$response;
    }
    else
    {
        $qry="insert into messages (name,email,address,contact,message) values('".$name."','".$email."','".$address."','".$phone."','".$message."')";
        include "includes/db_connect.php";
        $result=$con->query($qry);
        include "includes/db_close.php";
        if($result)
        {
            $response=[
                'status'=>'success',
                'message'=>'We will get you back soon'
            ];
            $_SESSION['alert']=$response;
            header('location:index.php');
        }
    }

}
session_write_close();

?>

<?php include "includes/header.php" ?>

<section class="px-20 py-10 bg-blue-50">
    <div class="w-full ">
            <div class=" relative">
                <div class="flex justify-center relative z-10">
                    <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold capitalize">Get In Touch</h2>
                </div>
                <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
                </div>
            </div>
        <form method="POST" class="flex flex-col gap-5 mt-5">
            <div>
                <div class="relative">
                    <input type="text" name="name" id="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                    <label for="name"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name</label>
                </div>
                
            </div>
            <div>
                <div class="relative">
                    <input type="text" name="email" id="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                    <label for="email"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" name="address" id="address" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                    <label for="address"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Address</label>
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" name="phone" id="phone" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                    <label for="phone"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Phone</label>
                </div>
            </div>
            <div>
                <div class="relative">
                    <textarea type="text" name="message" id="message" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=""></textarea>
                    <label for="message"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-blue-50  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Message</label>
                </div>
               
            </div>
            <div class="mt-2">
                <button type="submit" name="submit" class="w-full relative  bg-transparent border-2 border-primary  text-primary hover:text-white transition-all duration-500 px-6 py-3 font-xl rounded-md sm:mb-0 before:content-[''] before:absolute before:left-0 before:w-full before:bottom-0 before:h-0 hover:before:h-full before:bg-blue-800 before:transition-all before:duration-500 overflow-hidden"><span class="relative">Send Message</span></button>
            </div>
        </form>
    </div>
</section>

<?php include "includes/footer.php" ?>
