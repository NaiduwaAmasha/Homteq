<!DOCTYPE html>
<html>
    <body>
        <?php
		
		session_start();
		
        $pagename="Sign Up"; //Create and populate a variable called $pagename
        echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

        echo "<title>".$pagename."</title>"; //display name of the page as window title

        echo "<body>";

        include ("headfile.html"); //include header layout file

        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        echo "<form action='signup_process.php' method='post'>";
		echo "<table style='border: 0px'>";
		echo "<tr><td style='border: 0px'>First Name</td><td style='border: 0px'><input type='text' name='userFName'>";
		echo "<tr><td style='border: 0px'>SurName</td><td style='border: 0px'><input type='text' name='userSName'>";
		echo "<tr><td style='border: 0px'>Address</td><td style='border: 0px'><input type='text' name='userAddress'>";
		echo "<tr><td style='border: 0px'>Post Code</td><td style='border: 0px'><input type='text' name='userPostCode'>";
		echo "<tr><td style='border: 0px'>Tel No</td><td style='border: 0px'><input type='text' name='userTelNo'>";
		echo "<tr><td style='border: 0px'>Email</td><td style='border: 0px'><input type='email' name='userEmail'>";
		echo "<tr><td style='border: 0px'>Password</td><td style='border: 0px'><input type='password' name='userPassword'/>";
		echo "<tr><td style='border: 0px'>Confirm Password</td><td style='border: 0px'><input type='password' name='confirmPassword'>";
		echo "<tr><td style='border: 0px'><input type='submit' value='Sign Up'><td style='border: 0px'><input type='submit' value='Clear Form'>";
		echo "</table>";
		echo "</form>";

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>