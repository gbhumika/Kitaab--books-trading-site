<?php
    session_start();
    include 'dbconnect.php';
    

    if(isset($_SESSION['user']) != "") {
    }
    
    $email = $_SESSION['user']; 
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    
    if(!empty($_POST['updateAccount'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uname = $_POST['name'];
            $email = $_SESSION['user'];
            $upass = $_POST['password'];
            $uphoneNumber = $_POST['phoneNumber'];
            
            
        
            $sql = "UPDATE users SET name='$uname', password='$upass', phoneNumber='$uphoneNumber' WHERE email='$email'";
            $result = mysqli_query($db, $sql);
            
            echo "<script>window.top.location.href = 'mypage.php';</script>";
        }
    }
    
    
    if(!empty($_POST['logOut'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_destroy();
        unset($_SESSION['user']);
        
        echo "<script>window.top.location.href = 'index.php';</script>";
        }
    }
    
?>








<!DOCTYPE html>
<html>
    <head>
        <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
    	<title>Account Setting</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" type="text/css" href="accountSetting.css">
    	<script type="text/javascript" src="accountSetting.js"></script>
    	
    	<style type="text/css">
    	    .formContainer{
            	width:30%;
            }
            .formName{
                color:red; 
                font-weight: bold;
            }
    	</style>
    </head>

    <body>
        <img id="top" src="images/top.png" alt="top"/>
        
    	<div id="form_container" class="formContainer">
        	<h1>Account Settings</h1>
            <form id="form_1110463" class="appnitro" method="post">
                <div class="form_description">
                    <h5>Hello <span class="formName"><?php echo $_SESSION['user'] ?></span>! Make any changes anytime!</h3>
                    
                </div>
                <ul>
					<li id="li_10" >
                        <label class="description" for="element_10">Name </label>
                        <div>
                            <input id="element_10" class="element text medium" type="text" name="name" maxlength="255" value= "<?php echo $row['name'] ?>"/>
                        </div><p class="guidelines" id="guide_10"><small>Give your first name followed by last name!</small></p> 
                    </li>
                    
                    <li id="li_7">
                        <label class="description" for="element_7">Password </label>
                        <div>
                            <input id="element_7" class="element text medium" name="password" value= "<?php echo $row['password'] ?>"/>
                        </div><p class="guidelines" id="guide_7"><small>Please have a save password!</small></p>
                    </li>	
                    
                    <li id="li_7">
                        <label class="description" for="element_7">Phone Number </label>
                        <div>
                            <input id="element_7" class="element text medium" name="phoneNumber" value= "<?php echo $row['phoneNumber'] ?>"/>
                        </div><p class="guidelines" id="guide_7"><small>Best phone number where you can be reached at!</small></p>
                    </li>	
			
					
                        <input id="saveForm" class="button_text" type="submit" name="updateAccount" value="Update Account" />
                        <input class="button_text" type="submit" name="logOut" value="Log Out"/>
                    
			    </ul>
            </form>
    	</div>
    </body>
</html>









