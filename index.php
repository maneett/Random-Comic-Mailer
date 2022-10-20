<?php

// checking if servername and host are set
if (!isset($_SERVER['SERVER_NAME']) || !isset($_SERVER['HTTP_HOST'])) {
    die('Server error.');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <h2 class="title">Welcome And Enjoy XKCD Comic Every 5 mins</h2>
    <br />
    <div class="container" id="email_container">
      <h1>COMIC MAILER</h1>
      <hr />
      <p>
        Enter your email in the box below to recive xckd comic in every 5 mins
      </p>
      <form id="email-form"action="" method="post">
        <input
          type="email"
          name="email"
          id="email_tf"
          placeholder="Email"
          required
          class="form_data"
        />
        <br />
        <button id="submit-email" type="button">GET OTP</button>
      </form>
    </div>
    <div class="container" id="otp_container">
      <h1>Enter OTP</h1 >
      <hr />
      <form id="email-form" action="" method="post">
        <input 
        class="form_data" 
        type="number" name="otp" 
        id="otp_tf" 
        placeholder="OTP" 
        required />
        <br />
        <button id="submit-otp" type="button">SUBSCRIBE</button>
      </form>
    </div>
    <div class="container" id="msg_container">
      <h1>Thanks For Subscribing</h1 >
      <hr />
      <p>You Will Recieve Your First Comic Shorty</p>
    </div>
    <script src="script.js"></script>
  </body>
</html>
