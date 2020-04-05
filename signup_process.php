<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
		include("db.php");
		
        $pagename="Your Sign Up Results"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

       $userFName = $_POST['userFName'];
	   $userSName = $_POST['userSName'];
	   $userAddress = $_POST['userAddress'];
	   $userPostCode = $_POST['userPostCode'];
	   $userTelNo = $_POST['userTelNo'];
	   $userEmail = $_POST['userEmail'];
       $userPassword = $_POST['userPassword'];
       $confirmPassword = $_POST['confirmPassword'];
       
   
      
       if(!(empty($userFName) & empty($userSName) & empty($userAddress) & empty($userPostCode) & empty($userTelNo) & empty($userEmail) & empty($userPasswor) & empty($confirmPassword))){
        if($userPassword != $confirmPassword){
            echo "<h3>Sign-up failed!</h3>";
            echo "<p>The 2 passwords are not matching";
            echo "<p>Make sure you enter correctly";
            echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
        }else{
            $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
            if(!preg_match($pattern,$userEmail,$matches)){
                $SQL="INSERT INTO users(userFName,userSName,userAddress,userPostCode,userTelNo,userEmail,userPassword) VALUES ('".$userFName."','".$userSName."','".$userAddress."','".$userPostCode."','".$userTelNo."','".$userEmail."','".$userPassword."');";
                $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
             
                if(mysqli_errno($conn) == 0){
                    echo "<h2>Sign-up successful!</h2>";
                    echo "<p>To continue, please <a href='login.php'>Login</a>";
                }else{
                    echo mysqli_errno($conn);
                    if(mysqli_errno($conn) == 1062){
                        echo "<h3>Sign-up failed!</h3>";
                        echo "<p>Email already in use";
                        echo "<p>You may be already registered or try another email address";
                        echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
                    }
                    if(mysqli_errno($conn) == 1064){
                        echo "<h3>Sign-up failed!</h3>";
                        echo "<p>Invalid characters eneterd in the form";
                        echo "<p>Make sure you avoid following characters:apostrophes like['] and backlashes like[\]";
                        echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
                    }
                }
            }else{
                echo "<h3>Sign-up failed!</h3>";
                echo "<p>Email not valid";
                echo "<p>Make sure you enter a correct email address";
                echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
            }
        }
       }else{
        echo "<h3>Sign-up failed!</h3>";
        echo "<p>Your signup form is incomplete and all fields are mandatory";
        echo "<p>Make sure you provide all the required details";
        echo "<br/><p>Go back to <a href='signup.php'>sign up</a>";
       }
       
	   
	   
        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>