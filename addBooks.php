<?php

session_start();
include 'dbconnect.php';    // $db -> connection name

$file = $_FILES['image']['tmp_name'];
$userName = $_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookTitle = $_POST['title'];
    $bookDesc = $_POST['desc'];
    $bookISBN = $_POST['isbn'];
    $bookPrice = $_POST['price'];
    $email = $_SESSION['user'];
    if (file_exists($file)) {
      $image = file_get_contents($_FILES['image']['tmp_name']);
      $image_name = $_FILES['image']['name'];
      $ext = pathinfo($image_name, PATHINFO_EXTENSION);
      $image_size = getimagesize($_FILES['image']['tmp_name']);
      $base64 = 'data:image/'.$ext.';base64,' . base64_encode($image);
      if ($image_size == FALSE) {
          echo "Not an image";
          exit();
      }
    }
    
    $sql = "INSERT INTO Book (name,isbn,description,price,email,imgname,image) VALUES('$bookTitle','$bookISBN','$bookDesc','$bookPrice','$email','$image_name','$base64')";
    $result = mysqli_query($db, $sql);
    if ($result) {
        echo "Uploaded!";
        
        echo "<script>window.top.location.href = 'mypage.php';</script>";
    } else {
        echo mysqli_error($db);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
<title> Sell </title>
<!--<link rel="stylesheet" href="addBooks.css">-->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="addBooks.css">
<script type="text/javascript" src="addBooks.js"></script>

<style type="text/css">
  .formName{
    color:red;
    font-weight: bold;
  }
</style>
</head>
<body>
  <img id="top" src="images/top.png" alt="">
  <div id="form_container">
    <h1><a>Submit a book Ad</a></h1>
    
    <form id="form_1110463" class="appnitro" method="post" enctype="multipart/form-data">
      <div class="form_description">
			  <h2>Submit a book Ad</h2>
			  <p>Hello <span class="formName"><?php echo $userName ?></span>   Sell your book here!</p>
		  </div>
		  <ul >

			  <li id="li_1" >
		      <label class="description" for="element_1">Ad Title </label>
		      <div>
            <input id="element_1" class="element text medium" maxlength="255" value="" type="text" name="title" />
          </div><p class="guidelines" id="guide_1"><small>Book's title.</small></p>
        </li>		
        <li id="li_2" >
          <label class="description" for="element_2">Ad Description </label>
          <div>
            <textarea id="element_2" name="desc" class="element textarea medium"></textarea> 
          </div><p class="guidelines" id="guide_2"><small>A description of the book's condition would be great.</small></p>      
        </li>		
        <li id="li_7" >
          <label class="description" for="element_7">ISBN </label>
          <div>
            <input id="element_7" class="element text medium" type="text" name="isbn" >
          </div><p class="guidelines" id="guide_7"><small>Look up your books ISBN on the net!</small></p>
        </li>		
        <li id="li_8" >
          <label class="description" for="element_8">Price </label>
          <span class="symbol">$</span>
		      <span>
            <input id="element_8_1" class="element text currency" type="text" name="price">
            <label for="element_8_2">Dollars.Cents</label>
		      </span>
		      <p class="guidelines" id="guide_8"><small>Buyers prefer ads with realistic prices!</small></p> 
		    </li>		
		    <li id="li_3" >
          <label class="description" for="element_3">Upload book picture </label>
		      <div>
            <input class="element file" id="element_3" type="file" name="image">
          </div><p class="guidelines" id="guide_3"><small>Book ads with pictures sell more!</small></p>
        </li>		
        <li class="buttons">
          <input id="saveForm" class="button_text" type="submit" value="Post Book">
        </li>
      </ul>
    </form>

  </div>
</body>
</html>
