<?php
	session_start();


 ?>
 <!Doctype html>
 <html> 
 <head>
 <title>Logout Page</title>
 <link rel="stylesheet" href="css/style.css">
 </head>
 <body style= "background-color:#95a5a6;">
  
  <div class="main_wrapper">
      <center>
	  <h2>Home Page</h2>
	  <h3>Welcome 
			<?php echo $_SESSION['username']?>
	  </h3>
	  <img src="images/avatar.png" class="avatar"/>
	  </center>
	  
	  <form class="myform" action="logout.php" method="post">
	  <h2>Press below to go Menupage for Order</h2>
	  <a href="menu.html"><input type="button" id="Menu_btn" value="Go Menupage"/>
	  <input name="logout" type="submit" id="logout_btn" value="Logout"/><br>
	  
	  </form>
	  
	  <?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header('location:index.php');
			}
	  ?>
  </div>
 </body>
 </html>