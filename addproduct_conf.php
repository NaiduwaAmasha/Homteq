<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
		include("db.php");
		
        $pagename="New Product Confirmation"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file

        include ("detectlogin.php");

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

       $productName = $_POST['productName'];
	   $productSPic = $_POST['productSPic'];
	   $productLPic = $_POST['productLPic'];
	   $shortDesc = $_POST['shortDesc'];
	   $LongDesc = $_POST['LongDesc'];
	   $price = $_POST['price'];
       $intialStockQuantity =(int)$_POST['intialStockQuantity'];
   
      
       if(!(empty($productName) & empty($productSPic) & empty($productLPic) & empty($shortDesc) & empty($LongDesc) & empty($price) & empty($intialStockQuantity))){
    
                $SQL="INSERT INTO product(prodName,prodPicNameSmall,prodPicNameLarge,
                prodDescripShort,prodDescripLong,prodPrice,prodQuality) 
                VALUES ('
                    ".$productName."','
                    ".$productSPic."','
                    ".$productLPic."','
                    ".$shortDesc."','
                    ".$LongDesc."','
                    ".$price."','
                    .$intialStockQuantity.
                ');";
                $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
             
                if(mysqli_errno($conn) == 0){
                    echo "<p>The product has been added</p>";
                    echo "<p>Name of the large picture: ".$productLPic;
                    echo "<p>Name of the small picture: ".$productSPic;
                    echo "<p>short Description: ".$shortDesc;
                    echo "<p>Long Description: ".$LongDesc;
                    echo "<p>Price: ".$price;
                    echo "<p>Initial Quantity: ".$intialStockQuantity;
                    
                }else{
                    echo mysqli_errno($conn);
                    if(mysqli_errno($conn) == 1062){
                        echo "<h3>Insertion failed!</h3>";
                        echo "<p>Product name has been breached";
                        echo "<br/><p>Go back to <a href='addproduct.php'>Add Product</a></p>";
    
                    }
                    if(mysqli_errno($conn) == 1064){
                        echo "<h3>Insertion failed!</h3>";
                        echo "<p>Invalid characters eneterd in the form";
                        echo "<p>Make sure you avoid following characters:apostrophes like['] and backlashes like[\]";
                        echo "<br/><p>Go back to <a href='addproduct.php'>Add Product</a></p>";
                    }
                    if(mysqli_errno($conn) == 1054){
                        echo "<h3>Insertion failed!</h3>";
                        echo "<p>Illegal characters have been entered in the fields that are expecting numerical values";                        
                        echo "<br/><p>Go back to <a href='addproduct.php'>Add Product</a></p>";
                    }
                }
            }else{
                echo "<h3>Sign-up failed!</h3>";
                echo "<p>Email not valid";
                echo "<p>Make sure you enter a correct email address";
                echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
            }
        
       
       
	   
	   
        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>