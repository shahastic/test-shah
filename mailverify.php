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
        <h1>Email Verification!</h1>
      </header>
      <section>
        <p>
          Verification Link sent, please verify the mail.
        </p>
      </section>
      
    </div>
  </section>

  <!-- to avoid refilling the form -->
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

</body >
</html >