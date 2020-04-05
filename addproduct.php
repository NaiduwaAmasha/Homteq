<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
        $pagename="Add a New Product"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file
        
        include ("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        echo "<form action='addproduct_conf.php' method='post'>";
		echo "<table style='border: 0px'>";
		echo "<tr><td style='border: 0px'>Product Name</td><td style='border: 0px'><input type='text' name='productName'>";
		echo "<tr><td style='border: 0px'>Small Picture Name</td><td style='border: 0px'><input type='text' name='productSPic'>";
		echo "<tr><td style='border: 0px'>Large Picture Name</td><td style='border: 0px'><input type='text' name='productLPic'>";
		echo "<tr><td style='border: 0px'>Short Description</td><td style='border: 0px'><input type='text' name='shortDesc'>";
		echo "<tr><td style='border: 0px'>Long Description</td><td style='border: 0px'><input type='text' name='LongDesc'>";
		echo "<tr><td style='border: 0px'>Price</td><td style='border: 0px'><input type='text' name='price'>";
		echo "<tr><td style='border: 0px'>Initial Stock Quantity</td><td style='border: 0px'><input type='text' name='intialStockQuantity'/>";
		echo "<tr><td style='border: 0px'><input type='submit' value='Add Product'></td><td style='border: 0px'><input type='reset' value='Clear Form'>";
		echo "</table>";
		echo "</form>";

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>