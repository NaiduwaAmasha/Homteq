<!DOCTYPE html>
<html>
    <body>
        <?php
        session_start();
        include("db.php");
        $pagename="Smart Basket"; //Create and populate a variable called $pagename
		
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file
		
		include ("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
		
        //if the value of the product id to be deleted (which was posted through the hidden field) is set  
        if(isset($_POST['h_index'])){
			
            //capture the posted product id and assign it to a local variable $delprodid
            $delprodid = $_POST['h_index'];
            unset($_SESSION['basket'][$delprodid]); 
            echo "<p>1 item removed from the basket</p>";
        }
        
          //unset the cell of the session for this posted product id variable
          //display a "1 item removed from the basket" message 
 
	if(isset($_POST['h_prodid'])){
		
			$newprodid = $_POST['h_prodid'];
			$reququantity  = $_POST['p_quantity'];
			
			//create a new cell in the  basket session array. Index this cell with the new product id. 
			//Inside the cell store the required product quantity
			  $_SESSION['basket'][$newprodid]=$reququantity;
			 //echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
			echo "<p>1 item added"; 
	}else{
		echo "<p>Current basket unchanged";
	}
		echo "<table>";
		echo "<tr><th>Product Name</th><th>Price</th><th>Quntity</th><th>Subtotal</th><th></th>";
		$total=0;
	   
		if(isset($_SESSION['basket'])){
			$index;
			$value;
		   
			foreach($_SESSION['basket'] as $index => $value){
				
				$SQL="select prodId, prodName,prodPrice,prodQuality from Product WHERE prodId =".$index;
				$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
				while ($arrayp=mysqli_fetch_array($exeSQL)){
					echo "<tr>";
					echo "<td>".$arrayp['prodName'];
					echo "<td>£".$arrayp['prodPrice'];
					echo "<td>".$value;
					$subtotal = $value * $arrayp['prodPrice'];
					echo "<td>£".$subtotal;
					$total+=$subtotal;
					echo "<td><form action='basket.php' method='post'>";
					echo "<input type='submit' value='REMOVE'/>";
					echo "<input type=hidden name=h_index value=".$index.">"; 
					echo "</form>";
				   
				}
				
			}
			
		   
			
		}else{
			echo "<p>Empty basket</p>";
		}

    echo "<tr>";
    echo "<td colspan='3'>TOTAL";
    echo "<td>£".$total;
    echo "<td></td>";
    echo "</table>";
	echo "<a href='clearbasket.php'>CLEAR BASKET</a>";
	if(isset($_SESSION['userid'])){
		echo "<p>To finalise your order: <a href='checkout.php'>Checkout</a>";
	}else{
		echo "<p>New homteq customers :<a href='signup.php'>Sign up</a></p>";
   		echo "<p>Returning homteq customers :<a href='login.php'>Login</a></p>";
	}
    
        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>