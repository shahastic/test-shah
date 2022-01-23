
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

<body> </body >
</html >

<?php
$email = $_SESSION['email'];
$url_email = $_GET['email'];
echo $email;
echo $url_email;
if ($email == $url_email) {
    // $initial_page = "https://test-shah.herokuapp.com/index.php";
    include '_dbcon.php';
    
    $sql = "UPDATE `test` SET `active` = '0' WHERE `test`.`email` = '$email'";
  
    $del_sql = "DELETE FROM `test` WHERE `test`.`email` = '$email'";
   
    $result = mysqli_query($conn, $sql);
    
    $del_result = mysqli_query($conn, $del_sql);
    
    session_unset();
    session_destroy();
    if ($result) {
        echo '<section class="inline">
        <div class="content">
          <header>
            <h1>Unsubscribed!</h1>
          </header>
          <section>
            <p>
              Oops, you have unsubscribed the service. Please subscribe to continue.
            </p>
          </section>
    
          <footer>
          <form action="index.php" >
              <button type="submit" name="submit" >Subscribe</button>
            </form>
          </footer>
    
        </div>
      </section>';
    }
    else {
        header("Location : https://test-shah.herokuapp.com/index.php");
} 

}
?>