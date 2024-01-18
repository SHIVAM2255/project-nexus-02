<?php
session_start();
require 'dbconfig/config.php'; 

 ?>
 <!Doctype html>
 <html> 
 <head>
 <title>Login Page</title>
 <link rel="stylesheet" href="css/style.css">
 </head>
 <body style= "background-color:#95a5a6;">
  
  <div class="main_wrapper">
      <center>
	  <h2>Login Form</h2>
	  <img src="images/avatar.png" class="avatar"/>
	  </center>
	  
	  <form class="myform" action="index.php" method="post">
	  <label><b>Username:</b></label><br>
	  <input name="username" type="text" class="inputvalues" placeholder="type your username" required/><br>
	  <label><b>password:</b></label><br>
	  <input name="password" type="password" class="inputvalues" placeholder="type your password" required/><br>
	  <input name="login" type="submit" id="login_btn" value="Login"/><br>
	  <a href="register.php"><input type="button" id="register_btn" value="Rregister"/>
	  </form>
	  
	  <?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			//username.trim();
			//password.trim();
			
			$query="select * from user_info WHERE username='$username' AND passward='$password'";
			
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				
				$_SESSION['username']=$username;
				header('location:logout.php');
				 
			}
			else 
			{
				
				echo '<script type="text/javascript"> alert("Invalid Credentials") </script>';
			}
		}
	  ?>
  </div>
 </body>
 </html>