
<?php
session_start();
include '_dbcon.php';
require("vendor/autoload.php");
require_once("mailer/PHPMailer.php");
require_once("mailer/SMTP.php");
require_once("mailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- CSS File -->
  <link rel="stylesheet" href="style.css">
  <title>Comics</title>
</head>

<body>

  

  <section class="inline">
    <div class="content">
      <header>
        <h1>Enjoy Comics!</h1>
      </header>
      <section>
        <p>
          Subscribe to our newsletter!
        </p>
      </section>
      <footer>
        <form action="index.php" method="POST">
          <input required type="email" id="email" name="email" placeholder="Enter your email">
          <button type="submit" name="submit">Subscribe</button>
        </form>




      </footer>
    </div>
  </section>

  <!-- To avoid refilling the form -->
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body >
</html >


<?php



if($_SERVER["REQUEST_METHOD"] == "POST"){

// require "_dbcon.php";

//Generate a random string.
$token = bin2hex(random_bytes(16));

$email = $_POST["email"];

//check whether username exists
$existSql = "SELECT * FROM `test` WHERE email = '$email'";
$result = mysqli_query($conn , $existSql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows > 0){
  //exists =true;
  header("Location: error.php");
}
else {
  //exists = false;
    $sql = "INSERT INTO `test` (`email`, `token`, `tstamp`, `active`) VALUES ('$email', '$token', current_timestamp(), '0')";
    $result = mysqli_query($conn , $sql);
    if($result){

      $phpmailer = new PHPMailer(true);
      
         
        $_SESSION['tokensession'] = $token;
        $_SESSION['email'] = $email;

          $phpmailer->isSMTP();
          $phpmailer->SMTPAuth = true;
          $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $phpmailer->Host = "smtp.gmail.com";
          $phpmailer->Port = "587";
          $phpmailer->Username = "phprtcamp@gmail.com";
          $phpmailer->Password = "php@123$";
          $phpmailer->setFrom("phprtcamp@gmail.com");
          $phpmailer->addAddress($email);
          $phpmailer->isHTML(true);
          $phpmailer->Subject = "Verify email!";
          $phpmailer->Body    = "Enjoy the eternity of comics.
          https://test-shah.herokuapp.com/welcome.php?token=$token\n";
          if ($phpmailer->send()) {
            header("Location: mailverify.php");
          } else {
            header("Location: error1.php");
          }
      
  } 

      }
    }
  

?>


