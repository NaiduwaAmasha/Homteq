<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
		include("db.php");
		
        $pagename="Order Confirmation"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file
		
		include("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        $currrentdatetime = date("y-m-d H:i:s");
		$SQL1 = "INSERT INTO orders(userId,orderDateTime,orderStatus) VALUES(".$_SESSION['userid'].",'".$currrentdatetime."','Placed');";
		$exeSQL = mysqli_query($conn, $SQL1) or die (mysqli_error());
		
		if(mysqli_errno($conn) == 0){

            $SQL2 = "select MAX(orderNo) As orderNo,userid,orderDateTime,orderTotal,orderStatus from orders where userId= ".$_SESSION['userid'];
            
			$exeSQL2 = mysqli_query($conn, $SQL2);
            $arrayord = mysqli_fetch_array($exeSQL2);
            $orderNum = $arrayord['orderNo'];

            echo "Successful order - ORDER REFERENCE NO:".$orderNum;

            echo "<table>";
            echo "<tr><th>Product Name</th><th>Price</th><th>Quntity</th><th>Subtotal</th>";
            $index;
            $value;
            $total=0;
            foreach($_SESSION['basket'] as $index => $value){

                $SQL3 = "select prodid,prodName,prodPrice from product where prodid=".$index;
                $exeSQL3 = mysqli_query($conn, $SQL3);
                $arrayb = mysqli_fetch_array($exeSQL3);
                $subtotal = $arrayb['prodPrice'] * $value ;

                $SQL4 = "Insert into Order_line(orderNo,prodId,quantityOrdered,subTotal) values(".$arrayord['orderNo'].",".$arrayb['prodid'].",".$value.",".$subtotal.")";
                $exeSQL4 = mysqli_query($conn, $SQL4);
               
					echo "<tr>";
					echo "<td>".$arrayb['prodName'];
					echo "<td>£".$arrayb['prodPrice'];
					echo "<td>".$value;
					$subtotal = $value * $arrayb['prodPrice'];
					echo "<td>£".$subtotal;
					$total+=$subtotal;
                    echo "</tr>";  
            }
                echo "<tr>";
                echo "<td colspan='3'>TOTAL";
                echo "<td>£".$total."</td>";
                echo "</tr>";
                echo "</table>";
                $SQL5 = "Update orders set orderTotal=".$total." where orderNo =".$orderNum;
                $exeSQL5 = mysqli_query($conn,$SQL5);
                echo "To Log out and leave the system <a href='logout.php'>Logout</a>";
            }else{
            echo "There has been an error placing the order!";
        }
        session_unset();

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>