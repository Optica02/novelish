
<?php include '../admin_nav.php';?>
<?php
include '../../includes/db_connect.php';
$qry = "SELECT * FROM genre";
$result = $con->query($qry);
include '../../includes/db_close.php';
?>
<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638] pt-12">Add Books</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-[96%] border ml-12 shadow bg-[#F9F5F6] rounded-xl">
        <div class="px-10 py-10">
            <form action="book_action.php" class="w-full" method="POST" enctype="multipart/form-data">
                <div class="my-2">
                    <div>
                        <label for="bookName" class="text-black text-lg font-bold">Name</label>
                        <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="bookName" value="<?php echo isset($_SESSION['old_data']['bookName']) ? $_SESSION['old_data']['bookName'] : ''; ?>" name="bookName">

                        <?php if (isset($_SESSION['errors']['bookName'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['bookName'].'*'; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="mt-2">
                        <label for="desc" class="text-black text-lg font-bold mb-4">Description</label>
                        <textarea type="text" class=" border outline-none shadow py-2 px-4   w-full rounded-xl my-2"
                            id="desc" name="desc"><?php echo isset($_SESSION['old_data']['desc']) ? $_SESSION['old_data']['desc'] : ''; ?>
                        </textarea>
                        <?php if (isset($_SESSION['errors']['desc'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['desc'].'*'; ?></span>
                        <?php endif; ?>
                    </div>


                    <div class="my-5">
                        <label for="image" class="text-black text-lg font-bold">Image</label>
                        <input type="file" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl mt-2"  id="image" name="image">
                        
                        <?php if (isset($_SESSION['errors']['image'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['image'].'*'; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="my-5">
                        <label for="book" class="text-black text-lg font-bold">Upload Book</label>
                        <input type="file" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl mt-2"  id="book" name="book">
                        
                        <?php if (isset($_SESSION['errors']['book'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['book'].'*'; ?></span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="price" class="text-black text-lg font-bold">Price</label>
                        <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="price" value="<?php echo isset($_SESSION['old_data']['price']) ? $_SESSION['old_data']['price'] : ''; ?>" name="price">

                        <?php if (isset($_SESSION['errors']['price'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['price'].'*'; ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="author" class="text-black text-lg font-bold">Author</label>
                        <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="author" value="<?php echo isset($_SESSION['old_data']['author']) ? $_SESSION['old_data']['author'] : ''; ?>" name="author">

                        <?php if (isset($_SESSION['errors']['author'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['author'].'*'; ?></span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="premium" class="text-black text-lg font-bold">Type</label>
                        <select required type="text"
                            class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="premium"
                            name="premium">
                            <option value="0" selected>
                                Free
                            </option>
                            <option value="1">
                                Paid
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="genre" class="text-black text-lg font-bold">Genre</label>
                        <select required type="text"
                            class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="genre"
                            name="genre">
                            <?php
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['genreID'] ?>">
                                <?php echo $row['genreName'] ?>
                            </option>
                            <?php
                        }
                        }
                        else{
                            ?>
                            <option value="" disabled>--Add Genre first--</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                            
                </div>

                <div class=" my-4">
                    <input type="submit" name="add" value="Add Books"
                        class="rounded cursor-pointer text-white px-4 py-2 bg-blue-600 hover:bg-blue-800 text-md font-semibold">
                    <button class="rounded bg-red-600 hover:bg-red-800 text-white px-4 py-2 text-md font-semibold"><a
                            href="index.php">Exit</a></button>
                </div>

            </form>
        </div>

    </div>

</div>
<script>
tinymce.init({
    selector: 'textarea#desc',
    forced_root_block: '',
});
</script>
<?php
// session_start();
if(isset($_SESSION['errors']))
{

    unset($_SESSION['errors']);
}
if(isset($_SESSION['old_data']))
{
    unset($_SESSION['old_data']);

}
// session_abort();
session_write_close();

?>








<?php include '../admin_footer.php';?>