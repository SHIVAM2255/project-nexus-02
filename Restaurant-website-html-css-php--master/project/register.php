<?php
require 'dbconfig/config.php'; 


 ?>
 <!Doctype html>
 <html> 
 <head>
 <title>Registration Page</title>
 <link rel="stylesheet" href="css/style.css">
 </head>
 <body style= "background-color:#95a5a6;">
  
 <div class="main_wrapper">
      <center>
	  <h2>Registration Form</h2>
	  <img src="images/avatar.png" class="avatar"/>
	  </center>
	  
	  <form class="myform" action="register.php" method="post">
	  <label><b>Username:</b></label><br>
	  <input name="username" type="text" class="inputvalues" placeholder="type your username" required/><br>
	  <label><b>password:</b></label><br>
	  <input name="password" type="password" class="inputvalues" placeholder="your password" required/><br>
	  <label><b>Confirm password:</b></label><br>
	  <input name="cpassword" type="password" class="inputvalues" placeholder="confirm password" required/><br>
	  <input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
	  <a href="index.php"><input type="button" id="Back_btn" value="Login"/>
	  </form>
	        
	  <?php
			if(isset($_POST['submit_btn']))
			{
				//echo '<script type="text/javascript"> alert("sign up button clicked") </script>';
				
				$username=$_POST['username'];
				$password=$_POST['password'];
				$cpassword=$_POST['cpassword'];
				
				if($password==$cpassword)
				{
					$query="select * from user_info WHERE username='$username'";
					$query_run=mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						echo '<script type="text/javascript"> alert("user already exists..try another username") </script>';
					}
					else
					{
						$query="insert into user_info values('$username', '$password')";
						$query_run=mysqli_query($con,$query);
						
						if($query_run)
						{
							echo '<script type="text/javascript"> alert("User registered...go to login page to Login") </script>';
						}
						else
						{
							echo '<script type="text/javascript"> alert("Error!!!") </script>';
						}
					}
				}
				else
				{
					echo '<script type="text/javascript"> alert("Password and confirm password does not match") </script>';
				}
			}
	  
	  ?>
  </div>
 </body>
 </html>