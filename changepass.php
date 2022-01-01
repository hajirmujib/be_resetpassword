<?php 
	$conn=mysqli_connect("localhost","root","","deep_link");
	$email=$_GET['email'];
	$id=$_GET['id'];
if (isset($_POST['edit'])) {


	$newPass=$_POST['Pass'];

	$qSelect=$conn->query("SELECT * FROM user WHERE id='$id' AND email='$email'");
	$qCount=$qSelect->num_rows;


	if($qCount==1){
		$update=$conn->query("UPDATE user SET password='$newPass' WHERE id='$id'");
		if($update){
			
		echo "<p style='margin-left:40%'>new pass : ".$newPass."</p>";
		}else{
		echo "FAILED UPDATE PASSWORD";

		}
		
	}else{

		echo "FAILED REST PASSWORD";
	}
}
	




 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Reset Password</title>
 </head>
 <body>
 	<div style="margin-left: 40%;">
 		<form method="POST">
 			<h5>New Password</h5>
 			<input type="text" name="Pass">
 			<button name="edit">Kirim</button>
 		</form>
 	</div>
 </body>
 </html>