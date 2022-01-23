<?php
session_start();
include '_dbcon.php';
require("vendor/autoload.php");
require_once("php-mailer/PHPMailer.php");
require_once("php-mailer/SMTP.php");
require_once("php-mailer/Exception.php");
$email = $_SESSION['email'];

use PHPMailer\PHPMailer\PHPMailer;
?>
  <?php
    $initial_page = "https://test-shah.herokuapp.com/index.php";
	$email = $_SESSION['email'];
	$random = rand(0, 1000);
	$api    = 'http://xkcd.com/' . $random . '/info.0.json';
	$json = file_get_contents($api);
	$data = json_decode($json);
	$title = 'Latest comics' . $data->safe_title;
	$name = $data->title;
	$img = $data->img;
	$subject = "$data->title";
	$unsubscribe_url = "https://test-shah.herokuapp.com/unsubscribe.php?email=$email";
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "587";
	$mail->Username = "testmailassignmentphp@gmail.com";
	$mail->Password = "Hritik@123!!";
	$mail->setFrom("testmailassignmentphp@gmail.com");
	$mail->addAddress($email);
	$mail->isHTML(true);
	$mail->Subject = "New data Arrived...";
	$mail->Body = '
  	          <p>Hello XKCDian</p>
  	          Here is your new data.
  	          <h3>' . $data->safe_title . "</h3>
  	          <img src='" . $data->img . "' alt='some data hehe'/>
			<br />
			To read the data,  --> <a target='_blank' href='https://xkcd.com/" . $data->num . "'>Click here</a><br /> 
			To Unsubscribe the Xkcd,  --> <a target='_blank' href='" . $unsubscribe_url . "'>Click here</a><br />";
	$mail->addStringAttachment(file_get_contents($img), "$subject.jpg");
	if ($mail->send()) {
		header("Location: success.php");
	} else {
		echo '<div class="container2">
        <div class="brand-title" style="color: red;">Error!!!</div>
        <br> <br> <br>
        <p>You have not subscribed to XKCD!!!</p>
        <br> <br> <br>
        <div class="inputs">
            <button type="submit" class="btn btn-primary"><a style="color: white; text-decoration: none;" href='.$initial_page.'>Subscribe</a></button>
        </div>
    </div>';
	}
	
	?>