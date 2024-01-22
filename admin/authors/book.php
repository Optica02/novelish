<?php

if(!isset($_GET['id']))
{
    header('location:index.php');
}

include '../../includes/db_connect.php';
$qry = "SELECT books.*,genre.genreName FROM books INNER JOIN genre ON books.genreID = genre.genreID  where books.userID='".$_GET['id']."'";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>

<?php include '../admin_nav.php';?>

<?php
function limitWords($string, $limit) {
    $words = explode(' ', $string); // Split the string into an array of words
    $limitedWords = array_slice($words, 0, $limit); // Extract the desired number of words
    $limitedString = implode(' ', $limitedWords); // Join the limited words back into a string
    return $limitedString;
}
?>



<!-- toast notification-->
<div id="toast"> <i id="toastIcon"></i> <span id="message"></span></div>

<div class="lg:py-20  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638]"><?php echo $_GET['author'] ?> books</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
    
    <div class="my-8">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>price</th>
                    <th>Image</th>
                    <th>Genre</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
            $sn = 1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            ?>

                <tr>
                    <td><?php echo $sn ;?></td>
                    <td><?php echo limitWords($row['bookName'],5); ;?></td>
                    <td><?php echo $row['price'] ;?></td>
                    <td class="w-[15%]"><img class=" w-full rounded-sm" src=" ../../Images/books/<?php echo $row['image'] ;?>"
                            alt="no image">
                    </td>
                    <td><?php echo $row['genreName'] ;?></td>
                    <td><?php echo $row['author'] ;?></td>
                    <td class="w-[14%]">
                        <a class="py-2" href="book_edit.php?id=<?php echo $row['bookID']?>">
                            <i class="text-2xl text-blue-600 hover:text-blue-800 font-bold fas fa-edit"></i>
                        </a>
                        <button
                            class=" font-bold delete ml-2"
                            id="<?php echo $row['bookID'] ?>"><i class="text-red-600 hover:text-red-800 text-2xl fas fa-trash"></i></button>
                    </td>
                </tr>

                <?php
              $sn++;
            }
          }
          ?>

            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.delete').click(function() {
        $(document).ready(function() {

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                                url: 'book_delete.php',
                                type: 'POST',
                                data: {
                                    'id': this.id
                                },
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal.fire('Deleted!', response.message,
                                    response.status);
                                setTimeout(function() {
                                    location.href = "index.php"
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
        });
    });
});
</script>



<?php include '../admin_footer.php';?>