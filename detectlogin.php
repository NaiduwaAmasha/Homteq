<?php
	if(isset($_SESSION['userid'])){
		echo "<p style='float:right;'>".$_SESSION['fname']." ".$_SESSION['sname']." / ".$_SESSION['user_type']." No: ".$_SESSION['userid'];
		
	}
?>