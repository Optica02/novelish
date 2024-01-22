<?php include "middleware.php"  ?>
<?php include "includes/header.php" ?>
<?php

$qry="select * from cart where userID='".$auth->getId()."' and checkedOut=0";
include "includes/db_connect.php";
$result=$con->query($qry);
if($result->num_rows>0)
{
    $cart=$result->fetch_assoc();
    $qry="SELECT cartitems.*, books.* FROM cartitems INNER JOIN books ON cartitems.bookID = books.bookID WHERE cartitems.cartID ='".$cart['cartID']."'";
    $cartResult=$con->query($qry);
}
include "includes/db_close.php";

?>
<section class="px-20 py-10 bg-blue-50 cart-section">

    <div>
        <div class=" relative">
            <div class="flex justify-center relative z-10">
                <h2 class="bg-blue-50 px-2 text-blue-800 text-2xl font-bold">My Cart</h2>
            </div>
            <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
            </div>
        </div>
        <div class=" justify-center mt-10">
            
        </div>
    </div>

    <div>
        <table class="w-full  text-center">
            <thead>
                <tr class="border-b-4 border-gray-500">
                    <th class="py-2">SN</th>
                    <th class="py-2">Book Name</th>
                    <th class="py-2">Book Price</th>
                    <th class="py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($result->num_rows>0 && $cartResult->num_rows>0)
                    {
                        $sn=1;
                        $amount=0;
                        while($data=$cartResult->fetch_assoc())
                        {
                            ?>
                            <tr class="border-b-2 border-gray-500">
                                <td class="py-1 px-5"><?php echo $sn ?></td>
                                <td class="py-1 px-5 text-left"><?php echo $data['bookName'] ?></td>
                                <td class="py-1 px-5">Rs. <?php echo $data['price'] ?></td>
                                <td class="py-1 px-5">
                                <button
                                        class=" font-bold delete ml-2"
                                        id="<?php echo $data['itemID'] ?>"><i class="text-red-600 hover:text-red-800 text-2xl fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                            $amount+=$data['price'];
                            $sn++;
                        }
                        ?>
                        <tr class="border-b-2 border-gray-500">
                            <td colspan="2" class="py-2 text-xl font-bold border-r-2 border-gray-500">Total</td>
                            <td class="font-semibold">Rs. <?php echo $amount ?></td>
                        </tr>
                        <?php

                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="4" class="pt-5"><h2 class="text-red-500 font-bold text-xl">No Cart Items Found..!!</h2></td>
                        </tr>
                        <?php
                    }
                ?>
                
            </tbody>
        </table>
        <div class="mt-5">
            <?php
                if($result->num_rows>0 && $cartResult->num_rows>0)
                {
                    ?>
                    <div class="flex justify-end">
                        <button onclick="payment(1)" type="submit" name="add_to_cart" class=" border border-[#2F49C8] px-5 font-bold duration-500 relative overflow-hidden z-10 before:-z-10  text-[#2F49C8] py-2 rounded-lg hover:text-white before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-[#2F49C8] before:transition-all before:duration-500 before:ease-in-out hover:before:left-0">Checkout</button>
                    </div>
                    <?php
                }
            ?>
 
        </div>
    </div>

 
</section>

<!-- khalti popup modal -->
<div id="khaltimodal" class="fixed opacity-0 invisible transition-all duration-500 top-0 left-0  w-full h-full z-[999] flex justify-center items-center bg-transparent">
    <div class="absolute top-0 left-0 w-full h-full backdrop-blur-sm">
    </div>
    <div class="w-1/2 bg-white border-2 border-purple-900 px-5 py-10 relative rounded-xl">
    <div class=" relative">
        <div class="flex justify-center relative z-10">
            <h2 class="bg-white px-2 text-purple-900 text-2xl font-bold capitalize">Khalti</h2>
        </div>
        <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
        </div>
    </div>
    <form id="khaltiForm" class="flex flex-col gap-5 mt-5">
        <div>
            <div class="relative">
                <input type="text" name="mobile" id="mobile" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="mobile"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Mobile Number</label>
            </div>
           
        </div>
        <div>
            <div class="relative">
                <input type="text" name="mpin" id="mpin" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="mpin"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Khalti Mpin</label>
            </div>
           
        </div>
        <div>
            <div class="relative">
                <input type="text" disabled name="price" id="price" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="Rs. <?php echo $amount ?>"/>
                <label for="price"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Price</label>
            </div>
            
        </div>
        
            <p id="khaltiError" class="text-red-500 font-bold text-sm mt-1"></p>
        <div class="mt-2 justify-end flex gap-5">
            <a onclick="payment(0)" class="bg-red-600 cursor-pointer hover:bg-red-500 border-2 border-primary  text-white font-bold transition-all duration-500 px-6 py-3 font-xl rounded-md sm:mb-0 ">Cancel</a>
            <button type="submit" class="bg-purple-900 hover:bg-purple-800 border-2 border-primary  text-white font-bold transition-all duration-500 px-6 py-3 font-xl rounded-md sm:mb-0 ">Pay Rs. <?php echo $amount ?></button>
        </div>
    </form>
    </div>
</div>


<!-- khalti otp popup modal -->
<div id="khaltiOtpModal" class="fixed opacity-0 invisible  transition-all duration-500 top-0 left-0  w-full h-full z-[999] flex justify-center items-center bg-transparent">
    <div class="absolute top-0 left-0 w-full h-full backdrop-blur-sm">
    </div>
    <div class="w-1/2 bg-white border-2 border-purple-900 px-5 py-10 relative rounded-xl">
    <div class=" relative">
        <div class="flex justify-center relative z-10">
            <h2 class="bg-white px-2 text-purple-900 text-2xl font-bold capitalize">Khalti</h2>
        </div>
        <div class="h-0.5 bg-gray-500 absolute left-0 w-full top-1/2">
        </div>
    </div>
    <form id="khaltiOtpForm" class="flex flex-col gap-5 mt-5">
       
        <div>
            <div class="relative">
                <input type="text" name="otp" id="otp" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="otp"  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">OTP</label>
            </div>
           
        </div>
            <p id="khaltiOtpError" class="text-red-500 font-bold text-sm mt-1"></p>
        <div class="mt-2 justify-end flex gap-5">
            <a onclick="otp(0)" class="bg-red-600 cursor-pointer hover:bg-red-500 border-2 border-primary  text-white font-bold transition-all duration-500 px-6 py-3 font-xl rounded-md sm:mb-0 ">Cancel</a>
            <button type="submit" class="bg-purple-900 hover:bg-purple-800 border-2 border-primary  text-white font-bold transition-all duration-500 px-6 py-3 font-xl rounded-md sm:mb-0 ">Pay Rs. <?php echo $amount ?></button>
        </div>
    </form>
    </div>
</div>


<div id="loader" class="fixed opacity-0 invisible  transition-all duration-500 top-0 left-0  w-full h-full z-[999] flex justify-center items-center bg-transparent">
<div class="absolute top-0 left-0 w-full h-full backdrop-blur-sm">
</div>
<div role="status">
    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>
    <span class="sr-only">Loading...</span>
</div>
</div>

<script>

        $(document).ready(function() {

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                swal.fire({
                    title: 'Are You Sure ?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                                url: 'cart_action.php',
                                type: 'POST',
                                data: {
                                    'id': this.id,
                                    'delete':true
                                },
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal.fire('Deleted!', response.message,
                                    response.status);
                                setTimeout(function() {
                                    location.href = "cart.php"
                                }, 2000);
                            })
                            .fail(function() {
                                swal.fire('Oops...',
                                    'Something went wrong with ajax !',
                                    'error');
                            });
                    }
                })
            });

           $('#khaltiForm').submit(function()
           {
            event.preventDefault();
            loader(1);
            var formData=$(this).serialize();
            $.ajax({
                type: 'POST', // You can change it to 'GET' if needed
                url: 'paymentaction.php',
                data: formData,
                dataType: 'json', // Change it based on your expected response type
                success: function(response) {
                    // Handle the success response here
                    loader(0);

                    console.log(response);
                    if(response.status=='success')
                    {
                        payment(0);
                        otp(1);
                    }
                    else
                    {
                        $('#khaltiError').html('* '+response.message);
                    }
                },
                error: function(error) {
                    // Handle the error here
                    console.log(error);
                }
            });
           });


           $('#khaltiOtpForm').submit(function()
           {
            event.preventDefault();
            loader(1);
            var formData=$(this).serialize();
            $.ajax({
                type: 'POST', // You can change it to 'GET' if needed
                url: 'paymentaction.php',
                data: formData,
                dataType: 'json', // Change it based on your expected response type
                success: function(response) {
                    // Handle the success response here
                    loader(0);
                    console.log(response);
                    if(response.status=='success')
                    {
                        otp(0);
                        window.location.href="index.php";
                    }
                    else
                    {
                        $('#khaltiOtpError').html('* '+response.message);
                    }
                },
                error: function(error) {
                    // Handle the error here
                    console.log(error);
                }
            });
           });

        });
    
function payment(param)
{
    var modal = document.getElementById('khaltimodal');
    if(param==1)
    {
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-1', 'visible');
    }
    else
    {
        modal.classList.remove('opacity-1', 'visible');
        modal.classList.add('opacity-0', 'invisible');
    }
}

function otp(param)
{
    var modal = document.getElementById('khaltiOtpModal');
    if(param==1)
    {
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-1', 'visible');
    }
    else
    {
        modal.classList.remove('opacity-1', 'visible');
        modal.classList.add('opacity-0', 'invisible');
    }
}

function loader(param)
{
    var modal = document.getElementById('loader');
    if(param==1)
    {
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-1', 'visible');
    }
    else
    {
        modal.classList.remove('opacity-1', 'visible');
        modal.classList.add('opacity-0', 'invisible');
    }
    
}
</script>


<?php include "includes/footer.php" ?>
