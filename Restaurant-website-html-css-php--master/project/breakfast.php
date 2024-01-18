 <?php   
 session_start();  
 require 'dbconfig/config.php';  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="breakfast.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="breakfast.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
        <meta charset="utf-8">
<title>Food Bazaar Traditional Restaurant | About Us</title>


<link rel="stylesheet" href="css/style.css">

<style>


footer{
    padding: 1em;
    color: white;
    background-color:black;
    clear: right;
	height: 2px;
	width:1350px;
    position:fixed;
    bottom: 0;
	text-align:center;
}
header {
    padding: 1em;
    color: black;
    background-color: no color;
    clear: left;
    text-align:center;
}
*{
padding:0;
margin:0;
}
nav {
    background-color:black;
	height:50px;
	
}

nav ul {
	
    border:1 px solid red;
	height:50px;
	width:1000px;
}

nav ul li {
    list-style-type:none;
	width:150px;
    float: left;
    border-right:1px solid #CCC;
	text-align:center;
}

li a{
	
    text-decoration: none;
	color:red;
	line-height:50px;
	display:block;
	
}

/* Change the link color to #111 (black) on hover */
li a:hover {
    background-color: red;
	color:green;
}

table,th, td {
	width: auto;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}

</style>
<title>food bazzar Traditional Restaurant | Menu</title>   
      </head>  
      <body>  
				  <nav>
			  <ul>
			  <li><a href="home.html"><b>Home</b></a></li>
			   <li><a href="menu.html"><b>Menu</b></a></li>
			 <li><a href="contact.html"><b>Contact Us</b></a></li>
			   <li><a href="about_us.html"><b>About Us</b></a></li>
				  <li><a href="index.php"><b>LogIn</b></a></li>
			  <li><a href="register.php"><b>SignUp</b></a></li>
			</ul>
			</nav>
			<div class="container">
			  <img src="logo1.png" alt="" style="width:300px;height:100px;">
			<h1>traditional restaurent</h1>
           <br />  
           <div class="container" style="width:700px align="center";">  
                 
                <?php  
                $query = "SELECT * FROM food_item ORDER BY food_id ASC";  
                $result = mysqli_query($con, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4" >  
                     <form method="post" action="breakfast.php?action=add&id=<?php echo $row["food_id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="ORDER" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <table align="right" style="width:70%">
				<caption >ORDER DETAILS</caption>
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td><?php echo $values["item_price"]; ?></td>  
                               <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="breakfast.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right"> <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />
				   
      </body>  
 </html>