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

       echo "<form method='post' action='login_process.php'>";
	   echo "<table style='border: 0px'>";
	   echo "<tr style='border: 0px'><td style='border: 0px'>Email</td>";
	   echo "<td style='border: 0px'><input type='email' name='email'></td></tr>";
		echo "<tr style='border: 0px'><td style='border: 0px'>Password</td>";
	   echo "<td style='border: 0px'><input type='password' name='password'></td></tr>";	
		echo "<tr><td style='border: 0px'><input type='submit' value='Login'></td>";
		echo "<td style='border: 0px'><input type='submit' value='Clear Form'></td></tr>";
	   echo "</table>";
	   echo "</form>";

        include("footfile.html"); //include head layout
        
        echo "</body>";
        ?>
    </body>
</html>