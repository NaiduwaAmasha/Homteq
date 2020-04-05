<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
		include("db.php");
		
        $pagename = "Your Login Results"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(!empty($email) & !empty($password)){
			$SQL = "Select * from users Where userEmail='".$email."';";
			$exeSQL = mysqli_query($conn, $SQL);
			$arrayu = mysqli_fetch_array($exeSQL);
			 

			if($arrayu['userEmail'] != $email){
				echo "<p>The email you entered was not recognized";
				echo "<p>Go back to <a href='login.php'>login</a></p>";
			}else{
				echo "<h3>Login success!</h3>";

				if($arrayu['userType'] == 'A'){
					$_SESSION['user_type'] = 'Administrator';
					echo "User has logged in as a hometeq Administrator";
					echo "<p>Continue shopping for <a href='index.php'>Home Tech</a>";
				}
				if($arrayu['userType'] == 'C'){
					$_SESSION['user_type'] = 'Customer';
					echo "User has logged in as a hometeq Customer";
					echo "<p>View your <a href='basket.php'>Smart Basket</a>"; 
					echo "<p>Continue shopping for <a href='index.php'>Home Tech</a>";

				}

				$_SESSION['userid'] = $arrayu['userId'];
				$_SESSION['userType'] = $arrayu['userType'];
				$_SESSION['fname'] = $arrayu['userFName'];
				$_SESSION['sname'] = $arrayu['userSName'];
				echo "<p>Hello ".$_SESSION['fname']." ".$_SESSION['sname'];
				echo "<p>You have successfully logged in as a homteq ".$_SESSION['userType']."!";
				echo "<p>Continue shopping for <a href='index.php'>Home Tech</a>";
				echo "<p>View your <a href='basket.php'>Smart Basket</a>"; 
				
				
			}
		}else{
			echo "<h3>Login failed!</h3>";
			echo "<p>your login form is incomplete";
			echo "<p>Make sure you provide all the required details";
			echo "<br/><p>Go back to <a href='login.php'>Login</a>";
		}

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>