<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$conn=mysqli_connect("localhost","root","","deep_link");

	$emailPost=$_POST['email'];
 
	$qSelect=$conn->query("SELECT * FROM user WHERE email='$emailPost'");
	$qCount=$qSelect->num_rows;
	$assoc=$qSelect->fetch_assoc();

	$id=$assoc['id'];
	$emailAssoc=$assoc['email'];

	$mail = new PHPMailer(true);

	if($qCount==1){
		$url='https://'.$_SERVER['SERVER_NAME'].'/deeplink/changepass.php?id='.$id.'&email='.$emailAssoc;
		//smtp setting
		$mail->isSMTP();
		$mail->Host='smtp.gmail.com';
		$mail->SMTPAuth=true;
		$mail->Username="mujibhajir@gmail.com";
		$mail->Password="@Masmjb27";
		$mail->Port=465;
		$mail->SMTPSecure="ssl";

		//setting email
		$mail->isHTML(true);
		$mail->setFrom("mujibhajir@gmail.com","Hajir_dev");
		$mail->addAddress($emailPost);
		$mail->Subject=("Reset Password");
		$mail->Body="<h4 style='color: red;'>Confirm reset password in this link bellow</h4><br><a href=".$url." target='_blank'>".$url."</a>";

    	if($mail->send()){
    		echo json_encode($url);
    	}else{
    		echo json_encode("FAILED SEND EMAIL");
    	}

		
	}else{

		
		echo json_encode("INVALID EMAIL");
	}


 ?>
