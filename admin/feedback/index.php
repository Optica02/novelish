<?php include '../admin_nav.php';?>

<?php
if (!isset($_SESSION['isAdmin'])) {
  header("Location: ../dashboard");
}
session_write_close();
?>

<?php

include '../../includes/db_connect.php';
$qry = "select * from feedback inner join books on feedback.bookID=books.bookID inner join users on feedback.userID=users.userID order BY feedback.feedbackID desc";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>

 <!-- toast notification-->
  <div id="toast"> <i id="toastIcon"></i> <span id="message"></span></div>

<div class="lg:py-0  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638]">Feedback</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
    
    <div class="my-8">
      <table  id="myTable" class="display">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Book Name</th>
            <th>User name</th>
            <th>User email</th>
            <th>Message</th>
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
              <td><?php echo $row['bookName'] ;?></td>
              <td><?php echo $row['name'] ;?></td>
              <td><?php echo $row['email'] ;?></td>
              <td><?php echo $row['message'] ;?></td>
              <td class="">
                <button class="text-blue-600 hover:text-blue-800 rounded py-2"><a class=" text-xl font-bold" href="edit.php?id=<?php echo $row['feedbackID'];?>"><i class="fas fa-edit"></i></a></button>
                <button class="text-red-600 mx-2 hover:text-red-800 rounded py-2 text-xl font-bold delete" id="<?php echo $row['feedbackID'] ?>"><i class="fas fa-trash"></i></button>
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
   $(document).ready(function(){
        $('.delete').click(function(){
            $(document).ready(function(){

                $(document).on('click', '.delete', function(){
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
                        if (result.value){
                            $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: {'id' : this.id },
                                dataType: 'json'
                            })
                            .done(function(response){
                                swal.fire('Deleted!', response.message, response.status);
                                setTimeout(function(){location.href="index.php"} , 2000);
                            })
                            .fail(function(){
                                swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                        }
                    })
                });
            });
        });
    });
</script>



<?php include '../admin_footer.php';?>