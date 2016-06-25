<?php
	include 'dbconnect.php';    // $db -> connection name
	if(isset($_GET['id'])){
		$bookid = $_GET['id'];
		$sql ="SELECT * FROM Book WHERE id IN ('$bookid')";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>search Books</title>
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Cinzel+Decorative:700' rel='stylesheet' type='text/css'>

	<!-- gridSystem -->
	<link rel="stylesheet" type="text/css" href="grid.css">

	<!-- styling -->
	<link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="searchstyle.css">
    <!-- Character encoding -->
  	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
		<div class="row navwidth">
	<nav class="navbar navbar-fixed-top">

	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <!-- <a class="navbar-brand" href="#"><img src="http://www.iconsdb.com/icons/preview/soylent-red/book-xxl.png" width="20" height="20"></a> -->
	      <a class="navbar-brand" href="index.php">KiTaaB</a>
        <!--<div class = "col col-8"><input type="search" class="form" placeholder="Search" /></div>-->
	    </div>
	    <div class="navbar-right" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="mypage.php"><span class="glyphicon glyphicon-log-in"></span> My Account</a></li>
	      </ul>
	    </div>
			</nav>
		</div>
    <div class = "row">
  		<div class = "col col-1"><p></p></div>
      	<div class = "col col-4">
  				    <div><img class="cover-image" 
  				    src=<?php
  				    if ($row["image"] == '') {
						echo 'http://www.colimdo.org/media/4283853/not-available.jpg';
					} else {
						echo $row["image"];
					}
  				    ?> 
  				    alt="Cover art" /></div>
            </div>
        <div class="col col-1">
        	<p></p>
        </div>
        <div class = "col col-5">
                    <div class="document-title"><p><?php echo $row["name"]; ?></p></div>
  					        <div class = "isbn"><p>ISBN: <?php echo $row["isbn"]; ?></p></div>
  					        <div class = "isbn"><p>Price: $<?php echo $row["price"]; ?></p></div>
  					        <div class = "description"><h2><em>Ad Description: <?php echo $row["description"]; ?></em></h2></div>
                    <div class="sellerinfo"><h2><em>Seller's Information</h2><p><b>email: </b><?php echo $row["email"]; ?></em><br>
          </div>
       </div>

    </body>
    </html>
