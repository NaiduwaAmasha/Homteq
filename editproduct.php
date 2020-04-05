<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
       include ("db.php"); //include db.php file to connect to DB
       $pagename="View & Edit Product"; //create and populate variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file
		
		include ("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        if(isset($_POST['h_id'])){
            $pridtobeupdated = $_POST['h_id'];
            $newprice = $_POST['newPrice'];
            $newqutoadd = $_POST['addItems'];

            $SQL1 = "select prodQuality from Product where prodid=".$pridtobeupdated;
            $exeSQL1=mysqli_query($conn, $SQL1) or die (mysqli_error());
            $arrayyqu = mysqli_fetch_array($exeSQL1);
            $newstock = $newqutoadd + $arrayyqu['prodQuality'];
            if(!empty($newprice)){
                $SQL2 = "update product set prodPrice=".$newprice.",prodQuality=".$newstock." where prodid=".$pridtobeupdated; 
                $exeSQL2=mysqli_query($conn, $SQL2) or die (mysqli_error());
            }else{
                $SQL3 = "update product set prodQuality=".$newstock." where prodid=".$pridtobeupdated; 
                $exeSQL3=mysqli_query($conn, $SQL3) or die (mysqli_error());
            }
        }


       //create a $SQL variable and populate it with a SQL statement that retrieves product details
        $SQL="select prodid, prodName, prodPicNameSmall,prodDescripShort,prodPrice,prodQuality from Product";
        //run SQL query for connected DB or exit and display error message
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
        echo "<table style='border: 0px'>";
        //create an array of records (2 dimensional variable) called $arrayp.
        //populate it with the records retrieved by the SQL query previously executed.
        //Iterate through the array i.e while the end of the array has not been reached, run through it
        while($arrayp=mysqli_fetch_array($exeSQL))
        {
        echo "<tr>";
        echo "<td rowspan='3'  style='border: 0px'>";
        echo "<a>";
            //display the small image whose name is contained in the array
            echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
            //close the anchor
            echo "</a>";
        echo "</td>";
       
        echo "<td colspan='2' style='border: 0px'>";
        echo "<p><h5>".$arrayp['prodName']."</h5>"; //display product name as contained in the array
        echo "<p>".$arrayp['prodDescripShort']."</p>"; //display short decription of the product as contained in the array
        echo "</td>";
        
        echo "</tr>";
        echo "<tr>";
        echo "<td style='border: 0px'>";
        echo "<p>Current Price: <b>£".$arrayp['prodPrice']."</b>"; //display product price as contained in the array
        echo "<p>Current Stock: <b>".$arrayp['prodQuality']."</b>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<form action='editproduct.php' method='post'>";
        echo "<p>New Price:<input type='text' name='newPrice' />";
        echo "<p>Add number of items: ";
        echo "<select name='addItems'> ";
			for($count=0;$count<=$arrayp['prodQuality'];$count++){
				echo "<option value=".$count.">".$count."</option>";
			}
		  "</select> ";
        
       
       
        echo "</td>";
        
       
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='2' style='border: 0px'>";
        echo "<input type='submit' value='update'/>";
        echo "</td>";
        echo "</tr>";
        echo "<input type=hidden name=h_id value=".$arrayp['prodid'].">"; 
        echo "</form>";

        
        
      
        }
        echo "</table>";

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>
