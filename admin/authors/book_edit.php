<?php include '../admin_nav.php';?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "select * from books where bookID='".$id."'";
    $genre_qry= "select * from genre";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    $genre = $con->query($genre_qry);
    include '../../includes/db_close.php';
      if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {
            $id = $row['bookID'];
            $bookName = $row['bookName'];
            $desc = $row['description'];
            $image = $row['image'];
            $book = $row['book'];
            $price = $row['price'];
            $genreID = $row['genreID'];
            $author = $row['author'];
            $premium = $row['premium'];


        } 
}


?>

<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638] pt-12">Update Book</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-[96%] border mx-12 shadow bg-[#F9F5F6] rounded-xl">
        <div class="px-10 py-10">
            <form action="book_action.php" class="w-full" method="POST" enctype="multipart/form-data">
                <div class="my-2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div>
                        <label for="bookName" class="text-black text-lg font-bold">Name</label>
                        <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="bookName" name="bookName" value="<?php echo $bookName; ?>">
                        <?php if (isset($_SESSION['errors']['bookName'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['bookName'].'*'; ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="desc" class="text-black text-lg font-bold">Description</label>
                        <textarea type="text" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="desc" name="desc"><?php echo $desc; ?></textarea>
                        <?php if (isset($_SESSION['errors']['desc'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['desc'].'*'; ?></span>
                        <?php endif; ?>
                    </div>
                    <label for="c_image" class="text-black text-lg font-bold">Current Image</label>
                    <div class="my-5 max-w-[500px]">
                        <img src="../../Images/books/<?php echo $image ?>">
                    </div>
                    <div>
                        <label for="image" class="text-black text-lg font-bold">Choose New Image</label>
                        <input type="file" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="image" name="image">
                    </div>

                    <div class="my-5">
                        <label for="c_book" class="text-black text-lg font-bold">Current book</label>
                        <div class="mt-2">
                            <a class="bg-blue-500 px-5 py-2 text-white rounded-xl" href="../../Books/<?php echo $book ?>"><?php echo $book ?></a>
                        </div>
                    </div>
                    
                    <div>
                        <label for="book" class="text-black text-lg font-bold">Choose New Book</label>
                        <input type="file" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="book" name="book">
                    </div>


                    <label for="price" class="text-black text-lg font-bold">Price</label>
                    <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="price" name="price" value="<?php echo $price; ?>">
                    <?php if (isset($_SESSION['errors']['price'])): ?>
                    <span class="error block text-red-600"><?php echo $_SESSION['errors']['price'].'*'; ?></span>
                    <?php endif; ?>

                    <label for="author" class="text-black text-lg font-bold">Author</label>
                    <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="author" name="author" value="<?php echo $author; ?>">
                    <?php if (isset($_SESSION['errors']['author'])): ?>
                    <span class="error block text-red-600"><?php echo $_SESSION['errors']['author'].'*'; ?></span>
                    <?php endif; ?>
                    <div>
                        <label for="premium" class="text-black text-lg font-bold">Type</label>
                        <select required type="text"
                            class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="premium"
                            name="premium">
                            <option value="0" <?php echo $premium==0?'selected':'' ?>>
                                Free
                            </option>
                            <option value="1" <?php echo $premium==1?'selected':'' ?>>
                                Paid
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="genre" class="text-black text-lg font-bold">genre</label>
                        <select required type="text"
                            class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="genre"
                            name="genre">
                            <?php
                            if ($genre->num_rows > 0) {
                            while ($row = $genre->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['genreID'] ?>" <?php echo ($row['genreID']==$genreID?'selected':'') ?>>
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
                    <input type="submit" name="update" value="Update" class=" rounded cursor-pointer text-white px-4 py-2 bg-blue-600 hover:bg-blue-800 text-md font-semibold">
                    <a class="rounded bg-red-600 hover:bg-red-800 text-white px-4 py-2 text-md font-semibold" href="index.php">
                        Exit
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>

<?php
}
 else {
    header("Location: index.php");
 }

?>
<script>
tinymce.init({
    selector: 'textarea#desc'
});
</script>
<?php
// session_start();
if(isset($_SESSION['errors']))
{

    unset($_SESSION['errors']);
    // unset($_SESSION['old_data']);
}
// session_abort();
session_write_close();

?>






<?php include '../admin_footer.php';?>