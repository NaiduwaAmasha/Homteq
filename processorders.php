<!DOCTYPE html>
<html>
    <body>
        <?php
         include("db.php");
        $pagename="Process Orders"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file

        include ("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        $SQL = "select o.orderNo,o.orderDateTime,o.orderStatus,u.userId,u.userFName,u.userSName,ol.quantityOrdered,p.prodName
        from orders o
        join users u on u.userId = o.userId
        join order_line ol on ol.orderNo = o.orderNo
        join product p on p.prodid = ol.prodId
        ";

        $exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error());

        $rowNo = 0;
        echo "<table>";
        while($array = mysqli_fetch_array($exeSQL)){
           // echo "orderNo : ".$array['orderNo']." rowNo ".$rowNo."</br>";
          
        if($rowNo != $array['orderNo']){
           
            echo "<tr style='background-color:#8cc'>
            <th>Order</th>
            <th>Order Date Time</th>
            <th>User Id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Status</th>
            <th>Product</th>
            <th>Quality</th></tr> ";   
            echo "<tr>";
            echo "<td>No: ".$array['orderNo'];
            echo "<td>".$array['orderDateTime'];
            echo "<td>".$array['userId'];
            echo "<td>".$array['userFName'];
            echo "<td>".$array['userSName'];

            if($array['orderStatus'] == 'Placed'){
                echo "<td>";
                echo "<form action='processorders.php' method='post'>";
                echo "<select name='orderStatus'>";
                echo "<option>Placed</option>";
                echo "<option>Ready to collect</option>";
                echo "</select>";
                echo "<input type='submit' value='Update'>";
                echo "<input type=hidden name=h_orderNo value='".$array['orderNo']."'>";
                echo "</form>";
                echo "</td>";
               
            }
            if($array['orderStatus'] == 'Ready to collect'){
                echo "<td>";
                echo "<form action='processorders.php' method='post'>";
                echo "<select name='orderStatus'>";
                echo "<option>Ready to collect</option>";
                echo "<option>Collected</option>";
                echo "</select>";
                echo "<input type='submit' value='Update'>";
                echo "<input type=hidden name=h_orderNo value='".$array['orderNo']."'>";
                echo "</form>";
                echo "</td>";
            }else if($array['orderStatus'] == 'Collected'){
                echo "<td>".$array['orderStatus'];
            
            
        }

             echo "<td>".$array['prodName'];
             echo "<td>".$array['quantityOrdered'];
             echo "</tr>";
            
         $rowNo+=1;
    }else{

        echo "<tr>";
        echo "<td colspan='6'></td>";
        echo "<td>".$array['prodName'];
        echo "<td>".$array['quantityOrdered'];
        echo "</tr>";
      
    } 
    
        
        }
        echo "</table>";  
        
        if(isset($_POST['orderStatus'])){
            $orderStatus = $_POST['orderStatus'];
            $orderNo = $_POST['h_orderNo'];
            $SQL = "update orders set orderStatus='".$orderStatus."' where orderNo=".$orderNo;
            $exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error());
        }
    
            
    
              
           
          
                
               
               
          
               
        
        
        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>