<?php

session_start();

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
          Now enjoy the best of comic world at your digital devices in every 5 minutes.
        </p>
      </section>

    </div>
  </section>



</body>

</html>

<?php

include '_dbcon.php';

$token = $_GET['token'];
// $_SESSION['token'] = $token;

$tokensession = $_SESSION['tokensession'];
if ($tokensession == $token) {
  $update = "UPDATE `test` SET active = '1' WHERE `test` . `token` = '$tokensession' ";

  $query = mysqli_query($conn, $update);

  if ($query) {
    header('location:contentmail.php');
  } else {
    header('location:index.php');
  }
} 
else {
  header('location:error.php');
}


?>
