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
  </section>

  <!-- To avoid refilling the form -->
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

</body >
</html >

