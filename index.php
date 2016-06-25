<?php
include 'dbconnect.php';    // $db -> connection name
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
	$sql = "SELECT * FROM Book WHERE name LIKE '%".$search ."%' LIMIT 0,8";
	$paginationCtrls ='1';
}
else{
	$sql = "SELECT * FROM Book";
	$res = mysqli_query($db, $sql);
	$rows = mysqli_num_rows($res);
	$page_rows = 8;
	$last = ceil($rows/$page_rows);
	if($last < 1){
		$last = 1;
		}
	$pagenum = 1;
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
		}
	if ($pagenum < 1) {
    	$pagenum = 1;
		} else if ($pagenum > $last) {
    	$pagenum = $last;
		}
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	$sql =  "SELECT * FROM Book ORDER BY id DESC $limit";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$name = $_GET['name'];
	$email = $_GET['email'];
	$message = $_GET['comments'];
	$query= "INSERT INTO contactus(name,email,message) VALUES ('$name','$email','$message')";
	$supportResult = mysqli_query($db, $query);
}

$result = $db->query($sql);

$paginationCtrls = '';
if($last != 1){
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	$paginationCtrls .= '<a style="background-color:red">'.$pagenum.' </a>&nbsp; ';
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
	<title>Kitaab</title>
	<script src="index.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Cinzel+Decorative:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- gridSystem -->
	<link rel="stylesheet" type="text/css" href="grid.css">
	<!-- styling -->
	<link rel="stylesheet" type="text/css" href="styles.css">
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
	      <a class="navbar-brand" href="#">KiTaaB</a>
	    </div>
	    <div class="navbar-right" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="login.php"><i class="fa fa-user"></i> My Account</a></li>
	      </ul>
	    </div>
			</nav>
		</div>

	<div class="header container-fluid">
		<div class="row">
			<div class="col col-12">
				<img src="images/scucover.jpg" style="min-width:10%;height:669px;" alt="SCU Library picture">
			</div>
		</div>
		<div class="headertt">
			<div class="row">
				<div class="header-text text-center">
					<h1>KiTaaB</h1>
					<p>Book trading community just for Santa Clara University.</p>
					<div class="row">
						<div class="col col-12" style="align:center;">
							<div class="search-bar">
				   				<i class="fa fa-search"></i>
				    			<form method="POST">
			    			<input id="searchCondition" type="search" class="form-control" placeholder="Search" name="search"/>
			    		</form>
							</div>
						</div>
				 	</div>
				</div>
			</div>
		</div>
	</div>


	<div class="content container-fluid text-center">
	<div class="row">
		<?php
		$newrow=1;
		if ($result->num_rows > 0) {
	     // output data of each row
		 while($row = $result->fetch_assoc())
		 {
		 	if ($newrow<5)
		 	{
		 		$newrow++;
		 	}
		 	else
		 	{
		 		echo'<div class="row">';
		 		$newrow=1;
		 	}
			echo '<div class="col col-3 inc">
				<div class="item">
					<div class="img">
						<a target="_blank" href="searchpage.php?id='.$row["id"].'"</a>
							<img src="';
            if ($row["image"] == '') {
    			echo 'http://www.colimdo.org/media/4283853/not-available.jpg';
    		} else {
    			echo $row["image"];
    		}
			echo '" alt="BookCover of the book in question" style="width:80%;height:100%">
						</a>
					</div>
					<div>
						<div class="desc">
							<h3 class="title">'.$row["name"].'</h3>
							<p class="number">$'.$row["price"].'</p>
						</div>
					</div>
				</div>
			</div>';
		 }
		$db->close();
		}
		?>
	<div class="row">

			<div class="pagination" id="center" class="col-12">
				<ul class="pagination" id="center">
                    <li><?php echo $paginationCtrls; ?></li>
				</ul>
			</div>

	</div>
</div>

	<footer>
	<div class="row">
	  <hr>
	  <div class="col col-4">
	    <img src="images/scu.png" style="width:100%;" alt="Santa Clara University">
	  </div>
	  <div class="col col-4"><a href="http://www.scu.edu" target="_blank">
	    <img src="images/banner.jpg" style="width:100%;" alt="SCU Banner"></a>
	  </div>
	  <div class="col col-4">
	    <img src="images/jesuit.png" style="width:100%;" alt="Jesuit University">
	  </div>
	</div>

	<form method="GET">
	<div class="row">
	    <div class=" col  col-4">

	      	<div class="footer container-fluid">
	      	  <h2>Contact us</h2>
	      	  <div  class="row">
	      	    <div  class=" col  col-12">
	              <input class="form-control" method="POST" id="name" name="name" size="40" placeholder="Name" type="text" required="">
	            </div>
	          </div>
	            <div  class="row">
	        	    <div  class=" col  col-12">
	                  <input class="form-control" method="POST" id="email" name="email" size="40" placeholder="Email" type="email" required="">
	              </div>
	            </div>
	              <div  class="row">
	          	    <div  class=" col  col-12">
	                    <textarea class="form-control" method="POST" id="comments" name="comments" cols="45" placeholder="Type your query here..." rows="5"></textarea>
	                </div>
	              </div>
	                <div class="row">
	                    <div class=" col  col-12">
	                      <button type="submit">Send</button>
	                    </div>
	                </div>
	                <br>
	   	  </div>
	  </div>
	      <div class=" col  col-4">
	        <div class="footer container-fluid">
	        <h2> Who we are</h2>
	        <p> Kitaab is an effort made by the students of Santa Clara University for the SCU community. Kitaab provides a platform where you can offer and buy used/old books.</p>
	          <br>
	          <p><b>Feel free to keep in touch.</b></p>
	          <div id="social">
	            <a href="https://www.facebook.com/kitaabOnline" target="_blank"><img src="images/facebook.png" alt="facebook icon" style="width:20%;height:20%;"></a>
	            <a href="https://business.google.com/b/117024498746463939619/dashboard" target="_blank"><img src="images/googlePlus.png" alt="GooglePlus icon" style="width:19%;height:19%;"></a>
	            <a href="https://www.twitter.com" target="_blank"><img src="images/twitter.png" alt="Twitter icon" style="width:20%;height:20%;"></a>
	         </div>
	      </div>
	    </div>
	    <div class=" col  col-4">
	      <div class="footer container-fluid">
	          <h1><a href="images/map.jpg" target="_blank">Campus Map</a></h1>
	          <h3> <b>Santa Clara University</b></h3>
	            <h4>500 El Camino Real</h4>
	            <h4>Santa Clara</h4>
	            <h4>CA 95053</h4>
	            <h4>(408) 554-4000</h4>
	       </div>
	    </div>
	</div>
	</form>
</footer>

</body>
</html>
