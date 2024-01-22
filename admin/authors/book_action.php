<?php

require_once "../../Auth.php";
$auth=new Auth();
 function validate($inputData,$for)
{
  if(empty($inputData['bookName']))
  {
  $_SESSION['errors']['bookName']='bookName is required';
  }
  else if(!preg_match('/^[a-zA-Z\s]+$/',$inputData['bookName']))
  {
    $_SESSION['errors']['bookName']='Only character string is valid';

  }

  if(empty($inputData['desc']))
  {
  $_SESSION['errors']['desc']='Description is required';
  }
  if(empty($inputData['author']))
  {
  $_SESSION['errors']['author']='Author is required';
  }

  if($inputData['premium']==1)
  {
      if(empty($inputData['price']))
      {
      $_SESSION['errors']['price']='Price is required';
      }
      else if(!preg_match('/^[0-9]+$/',$inputData['price']))
      {
          $_SESSION['errors']['price']='Should contain only numbers';
      }
  }


  if(isset($_SESSION['errors']))
  {
    return true;
  }
  else{
    return false;
  }
// session_write_close();
}

if (isset($_POST['update'])) {
  $inputData=$_POST;
  $error=validate($inputData,"update");
  $id = $_POST['id'];
  if($error==false)
  {
    include '../../includes/db_connect.php';
    $bookName = mysqli_real_escape_string($con,$_POST['bookName']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);
  
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $premium = $_POST['premium'];
    $author = $_POST['author'];
    $book_query="select image,book from books where bookID='$id' ";
    $books = $con->query($book_query);
    include '../../includes/db_close.php';
    
    $qry = "update books set bookName = '$bookName',description='$desc',genreID='$genre',premium='$premium',author='$author'";
    
    // Check if a file is selected
    if (!empty($_FILES["image"]["name"]))
    {

      // File upload path
      $targetDir="../../Images/books/";
      $fileName = basename($_FILES["image"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    
      // Allow only specific file formats (modify as needed)
      $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
      if (in_array($fileType, $allowedTypes))
      {
        // Upload the file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath))
        {
          // File uploaded successfully, insert file details into the database
          $qry = $qry.",image='$fileName'";
          if ($books->num_rows > 0)
          {
            while ($row = $books->fetch_assoc())
            {
              $imagePath=$targetDir . $row['image'];
              if(file_exists($imagePath))
              {
                unlink($imagePath);
              }
            }
          }
        }
        else
        {
          // echo "Error uploading the file.";
          $response = [
            'status' => 'error',
            'message' => "Error uploading the file.",
          ];
          $_SESSION['alert'] = $response;
          echo 
            '<script>
                window.location = "book_edit.php?id=' . $id . '";
            </script>';
            die();
        } 
      }
      else
      {
        $response = [
          'status' => 'error',
          'message' => "Invalid file format.<br> Only JPG, JPEG, PNG, and GIF files are allowed.",
        ];
        $_SESSION['alert'] = $response;
        echo 
          '<script>
              window.location = "book_edit.php?id=' . $id . '";
          </script>';
          die();
        // echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
      }
    }
    // Check if a file is selected
    if (!empty($_FILES["book"]["name"]))
    {

      // book upload path
      $targetDirBook="../../Books/";
      $bookFileName=basename($_FILES['book']['name']);
      $targetBookPath=$targetDirBook.$bookFileName;
      $bookType=pathinfo($targetBookPath,PATHINFO_EXTENSION);
    
    
      // Allow only specific file formats (modify as needed)
      $bookAllowedTypes = array('pdf');
      if (in_array($bookType, $bookAllowedTypes))
      {
        // Upload the file to the specified directory
        if (move_uploaded_file($_FILES["book"]["tmp_name"], $targetBookPath))
        {
          // File uploaded successfully, insert file details into the database
          $qry = $qry.",book='$bookFileName'";
          if ($books->num_rows > 0)
          {
            while ($row = $books->fetch_assoc())
            {
              $bookPath=$targetDirBook . $row['book'];
              if(file_exists($bookPath))
              {
                unlink($bookPath);
              }
            }
          }
        }
        else
        {
          // echo "Error uploading the file.";
          $response = [
            'status' => 'error',
            'message' => "Error uploading the file.",
          ];
          $_SESSION['alert'] = $response;
          echo 
            '<script>
                window.location = "book_edit.php?id=' . $id . '";
            </script>';
            die();
        } 
      }
      else
      {
        $response = [
          'status' => 'error',
          'message' => "Invalid file format.<br> Only pdf files are allowed.",
        ];
        $_SESSION['alert'] = $response;
        echo 
          '<script>
              window.location = "book_edit.php?id=' . $id . '";
          </script>';
          die();
        // echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
      }
    }
    
    $qry = $qry." where bookID='$id'";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';

    // toastify("genre Updated Successfully","success");
    if ($result == true)
    {
      $response = [
        'status' => 'success',
        'message' => 'books Updated Successfully',
      ];

      $_SESSION['alert'] = $response;
      echo
      '<script>
      window.location = "book.php";
      </script>';
    }
    else
    {
      $response = [
        'status' => 'error',
        'message' => "Error:" . $qry . "<br>" . $con->error,
      ];
      $_SESSION['alert'] = $response;
      echo
      '<script>
      window.location = "book.php";
      </script>';
    }
  }
  else
  {
    $response = [
      'status' => 'error',
      'message' => 'Opps! Something Went Wrong',
    ];
    $_SESSION['alert'] = $response;
      echo
    '<script>
    window.location = "book_edit.php?id=' . $id . '";
    </script>';
  }
}
session_write_close();
?>