<?php
 include '../../includes/db_connect.php';

 $id=$_POST['id'];
 $targetDir="../../Images/books/";
 $targetBookDir="../../Books/";
 $books_qry="select image,book from books where bookID='$id' ";
 $books = $con->query($books_qry);
 if ($books->num_rows > 0) {
    while ($row = $books->fetch_assoc()) {
    $imagePath=$targetDir . $row['image'];
    $bookPath=$targetBookDir.$row['book'];
      if(file_exists($imagePath))
      {
      unlink($imagePath);
    
      }
      if(file_exists($bookPath))
      {
      unlink($bookPath);
    
      }
  }
}
$qry = "delete from books where bookID='$id' ";
 
 if (mysqli_query($con, $qry)) {
        echo $id;
    }else {
        echo "Error: " . $qry . "<br>" . mysqli_error($con);
    }

 include '../../includes/db_close.php';


?>