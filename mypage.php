<?php
	session_start();
	include 'dbconnect.php';    // $db -> connection name

	if(isset($_SESSION['user']) != "") {
    	$emailid = $_SESSION['user'];
      	$sql ="SELECT * FROM Book WHERE email IN ('$emailid')";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- google fonts -->
		<link href='https://fonts.googleapis.com/css?family=Cinzel+Decorative:700' rel='stylesheet' type='text/css'>
		<!-- gridSystem -->
		<link rel="stylesheet" type="text/css" href="grid.css">
		<!-- styling -->
		<!-- styling -->
		<link rel="stylesheet" type="text/css" href="styles.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>My Account</title>
		<script src="index.js"></script>
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
			</div>
			<div class="navbar-right" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> My Account</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="row mypagediv">
    	<div class="col col-2 navb" >
    		<div class="mypagebaground">
    			<ul class="mypageul">
				  <li class="mypageli"><a href="mybooks.php?email=<?php echo $row["email"];?>" target="iframe">MyBooks</a></li>
				  <li class="mypageli"><a href="addBooks.php" target="iframe">Add new Books</a></li>
				  <li class="mypageli"><a href="accountSetting.php" target="iframe">Account Settings</a></li>
				</ul>
    		</div>
		</div>
		<div class="col col-10 iframe">
			<iframe src="mybooks.php?email=<?php echo $row["email"];?>" name="iframe"></iframe>
		</div>
	</div>
</body>
</html>
<?php
} else {
	header("Location:  login.php");
}
$db->close();
?>	