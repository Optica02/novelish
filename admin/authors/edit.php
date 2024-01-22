<?php include '../admin_nav.php';?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "select * from users where userID='".$id."'";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';
      if ($result->num_rows > 0) {        
        $row = $result->fetch_assoc();
}
}


?>

<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[21%] mr-[5%]"
    id="mainarea">
    <h1 class="text-4xl font-bold text-[#061638] pt-12">Author Update</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-full border mx-12 shadow bg-[#F9F5F6] rounded-xl" >
        <div class="px-10 py-10">
            <form action="author_action.php" class="w-full" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['userID']; ?>">
                <div class="my-2">
                   <label for="name" class="text-black text-xl font-bold">Name</label>
                   <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="name" name="name" value="<?php echo isset($row['name']) ?$row['name']:''; ?>">
                    <?php if (isset($_SESSION['errors']['name'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['name'].'*'; ?></span>
                    <?php endif; ?> 
                </div>
                <div class="my-2">
                   <label for="email" class="text-black text-xl font-bold">Email</label>
                   <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="email" name="email" value="<?php echo isset($row['email']) ?$row['email']: ''; ?>">
                   <?php if (isset($_SESSION['errors']['email'])): ?>
                    <span class="block text-red-600"><?php echo $_SESSION['errors']['email'].'*'; ?></span>
                    <?php endif; ?> 
                </div>
                
                <div class="my-2">
                    <label for="role" class="text-black text-xl font-bold">Role</label>
                    <select required type="text" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="role" name="role">
                        <option  value="Author" <?php echo $row['role']=='Author'?'selected':''  ?> >
                            Author
                        </option>
                        <option  value="User" <?php echo $row['role']=='User'?'selected':''  ?>>
                            User
                        </option>
                    </select>
                </div>

                <div class="my-2">
                   <label for="password" class="text-black text-xl font-bold">password</label>
                   <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="password" name="password" placeholder="keep this empty if you don't want to change password">
                   <?php if (isset($_SESSION['errors']['password'])): ?>
                    <span class="block text-red-600"><?php echo $_SESSION['errors']['password'].'*'; ?></span>
                    <?php endif; ?> 
                </div>
                
                <div class="my-4">
                   <input type="submit" name="update" value="update" class="rounded text-white px-4 py-2 bg-blue-600 hover:bg-blue-800 text-md font-semibold cursor-pointer">
                   <a class="rounded bg-red-600 hover:bg-red-800 text-white px-4 py-2 text-md font-semibold" href="index.php">Exit</a> 
                </div>
               
            </form>
        </div>

    </div>
    
</div>



<?php

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

session_write_close();
?>




<?php include '../admin_footer.php';?>