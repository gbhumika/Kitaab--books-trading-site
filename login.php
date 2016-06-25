
    <?php
    session_start();
    include 'dbconnect.php';    // $db -> connection name
    
    if($_SESSION['user'] != "") {
          header("Location:  mypage.php");
        }
   
    // login
    if(!empty($_POST['login-submit'])){
       if($_SESSION['user'] != "") {
          header("Location:  mypage.php");
        }
          $email = $_POST['email'];
          $upass = $_POST['password'];
          
      
          $sql = "SELECT * FROM users WHERE email='$email'";
          $result = mysqli_query($db, $sql);
          $row = mysqli_fetch_array($result);
          if($row['password'] == $upass) {
              $_SESSION['user'] = $row['email'];
              header("Location:  mypage.php");
          } else {
              echo '<script language="javascript">';
              echo 'alert("Please type your Email and Password again!")';
              echo '</script>';
          }
        
    }
   
    if(!empty($_POST['signup-submit'])){
          $uname = $_POST['name'];
          $email = $_POST['email'];
          $upass = $_POST['password'];
          $upassConfirm = $_POST['passwordConfirm']; 
          
          if($upass != $upassConfirm){
              echo '<script language="javascript">';
              echo 'alert("Type your password again!")';
              echo '</script>';
          }
          else
          {
          $sql = "INSERT INTO users(name,email,password) VALUES('$uname','$email','$upass')";
          $result = mysqli_query($db, $sql);
          
          header("Location:  index.php");
          }
    }
    

    ?>


    <!DOCTYPE html>
    <html lang="en" class="no-js">
        <head>
            <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD///8AAABkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREQAAABAAAAAREQARERAAERERABERAAEREREAERAAEREREQARAAERERERABAAEREREREAAAEREREREQAAERERERERABABEREREREAEQAREREREQAREAERERERABERABEREREAEREQARERAAAAEAAAAREREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
            <meta charset="UTF-8" />
            <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
            <title>Login and Registration: KiTaaB</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
            <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
            <link rel="shortcut icon" href="../favicon.ico"> 
            <link rel="stylesheet" type="text/css" href="style.css" />
        </head>
        <body>
            <div class="container">
                <!-- Codrops top bar -->
                <section>				
                    <div id="container_demo" >
                        <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                        <a class="hiddenanchor" id="toregister"></a>
                        <a class="hiddenanchor" id="tologin"></a>
                        <div id="wrapper">
                            <div id="login" class="animate form">
                                <form  method="post"> 
                                    <h1>Log in</h1> 
                                    <p> 
                                        <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                        <input id="username" name="email" required="required" type="text" placeholder="Bbronco@scu.edu"/>
                                    </p>
                                    <p> 
                                        <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                        <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                    </p>
                                    <br><br><br><br>
                                    <p class="login button"> 
                                        <input type="submit" name="login-submit" value="Login" /> 
                  								  </p>
                                    <p class="change_link">Not a member yet ?
                  									    <a href="#toregister" class="to_register">Join us</a>
                  								  </p>
                                </form>
                            </div>

                            <div id="register" class="animate form">
                                <form  method="post"> 
                                    <h1> Sign up </h1> 
                                    <p> 
                                        <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                        <input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                    </p>
                                    <p> 
                                        <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                        <input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                    </p>
                                    <p> 
                                        <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                        <input id="passwordsignup_confirm" name="passwordConfirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                    </p>
                                    <p class="signin button"> 
                    									  <input type="submit" name="signup-submit" value="Sign up"/> 
                    								</p>
                                    <p class="change_link">Already a member ? 
    									                  <a href="#tologin" class="to_register"> Go and log in </a>
    								                </p>
                                </form>
                            </div>
    						
                        </div>
                    </div>  
                </section>
            </div>
        </body>
    </html>