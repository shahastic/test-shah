


<!DOCTYPE html>
<html lang="en">
<!-- sessionstart top -->
<head>

  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS File -->
  <link rel="stylesheet" href="style.css">
  <title>Mail Verify</title>
</head>

<body>



  <section class="inline">
    <div class="content">
      <header>
        <h1>Email verified!</h1>
      </header>
      <section>
        <p>
          Now enjoy the best of comic world at your digital devices.
        </p>
      </section>

    </div>
  </section>



</body>

</html>

<?php

include '_dbcon.php';

$url_email = $_GET['email'];
$url_token = $_GET['token'];
// $_SESSION['token'] = $token;

// $tokensession = $_SESSION['tokensession'];
if ($url_email && $url_token) {
  $update = "UPDATE `test` SET active = '1' WHERE `test` . `email` = '$email' AND `test` . `token` = '$token'";

  $query = mysqli_query($conn, $update);

  if ($query) {
    header('Location: contentmail.php?email=$url_email&token=$url_token');
  } else {
    header('Location: index.php');
  }
} 
else {
  header('Location: error2.php');
}


?>
