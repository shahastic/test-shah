
<?php





// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"],1);
// $active_group = 'default';
// $query_builder = TRUE;
// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);




$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

require "_dbcon.php";

//Generate a random string.
$token = bin2hex(random_bytes(16));

$email = $_POST["email"];

//check whether username exists
$existSql = "SELECT * FROM `test` WHERE email = '$email'";
$result = mysqli_query($conn , $existSql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows > 0){
  //exists =true;
  $showError = "Email already exists!";
}
else {
  //exists = false;
    $sql = "INSERT INTO `test` (`email`, `token`, `tstamp`, `active`) VALUES ('$email', '$token', current_timestamp(), '0')";
    $result = mysqli_query($conn , $sql);
    if($result){
      $showAlert = true;

      // // $to_email = "shahr6485@gmail.com";
      // $subject = "Email Activation";
      // $body = "Please verify your email to successfully subscribe to the XKCD comics! Click here to <a href='http://localhost/XKCD_challenge/welcome.php?token=$token' class='link'>verify</a> ";
      // $header = "From: Rahul Kumar <php.send.mail.xkcd@gmail.com>";

      // if(mail($email , $subject , $body , $header)){
      //   $_SESSION['msg'] = "Check your email to activate account $email";
      //   //header
      // }
      // else{
      //   //echo "Email not sent, please try again!";

      $phpmailer = new PHPMailer(true);
      try {
         
        $_SESSION['tokensession'] = $token;
        $_SESSION['email'] = $email;

          $phpmailer->isSMTP();
          $phpmailer->SMTPAuth = true;
          $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $phpmailer->Host = "smtp.gmail.com";
          $phpmailer->Port = "587";
          $phpmailer->Username = "phpmailassign@gmail.com";
          $phpmailer->Password = "guru6484";
          $phpmailer->setFrom("phpmailassign@gmail.com");
          $phpmailer->addAddress($email);
          $phpmailer->isHTML(true);
          $phpmailer->Subject = "Verify email!";
          $phpmailer->Body    = "Enjoy the eternity of comics.
          https://test-shah.herokuapp.com/welcome.php?token=$token\n";
          if ($phpmailer->send()) {
            header("Location: mailverify.php");
          } else {
            header("Location: error.php");
          }
      } catch (Exception $e) {
        header("Location: error.php");
      }
  } else {
    header("Location: error.php");
  }

      }
    }
  

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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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

</body >
</html >