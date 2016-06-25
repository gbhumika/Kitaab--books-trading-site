<?php
	include 'dbconnect.php';    // $db -> connection name
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$deleteSQL = $_POST['bookID'];
		$deleteSQL = 'DELETE FROM Book WHERE id = '.$deleteSQL;
		if (mysqli_query($db, $deleteSQL)) {
			echo "Record deleted successfully";
		} 
		else {
			 echo "Error deleting record: " . mysqli_error($db);
		}
	}

if(isset($_GET['email'])) 
	{
	$emailid = $_GET['email'];
	$sql ="SELECT * FROM Book WHERE email IN ('$emailid')";
	$result = $db->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Cinzel+Decorative:700' rel='stylesheet' type='text/css'>
	<!-- gridSystem -->
	<link rel="stylesheet" type="text/css" href="grid.css">
	<!-- styling -->
	<link rel="stylesheet" type="text/css" href="styles.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>myaccount</title>
</head>
<body>

<div class="row text-center">
	<?php
	$newrow=4;
	while($row = $result->fetch_assoc())
		 {
		 	if ($newrow<4)
		 	{
		 		$newrow++;
		 	}
		 	else
		 	{
		 		echo'<div class="row">';
		 		$newrow=1;
		 	}
			echo '<div class="col col-3">
					<div class="item">
						<div class="img">
							<a target="_blank" href="searchpage.php?id='.$row["id"].'"</a>
							<img src="';
							if ($row["image"] == '') {
								echo 'http://www.colimdo.org/media/4283853/not-available.jpg';
							} 
							else {
								echo $row["image"];
							}
							echo '" alt="Fjords" style="width:80%;height:100%">
						</div>
						<div>
							<div class="desc">
							<h3 class="title">'.$row["name"].'</h3>
							<form method="POST">
								<input name="bookID" hidden value="'.$row['id'].'">
								<button type="submit">Remove</button> 
							</form>
							</div>
						</div>
					</div>
				</div>';		
			if ($newrow == 4)
				{echo '</div>';}
	 }
		$db->close();
	?>
</div>
</body>
</html>

<?php
}
?>