<?php
include '_dbcon.php';

if(isset($_GET['token'])){

    $token = $_GET['token'];

    $update = "update test set action='1' where token='$token' ";

    $query = mysqli_query($conn , $update);

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account verified successfully!";
            header('location:contentmail.php');
        }        
    }
    else{
        $_SESSION['msg'] = "Account not verified!";
        header('location:index.php');
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

  <!-- To avoid refilling the form -->
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

</body >
</html >


