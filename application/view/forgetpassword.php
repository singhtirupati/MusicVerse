<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/forget.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">
  
    <!-- Login container -->
      <div class="forget-container">
        <div class="page-wrapper forget-content-wrap">
          <div class="forget-content">
            <div class="error-msg">
              <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
            </div>
            <div class="logo">
              <img src="/public/img/logo.svg" alt="Music Verse">
            </div>
            <div class="title-head">
              <h1>Forget Password</h1>
              <p>Please enter your registered email id to get password reset link.</p>
            </div>
    
            <!-- Form container -->
            <div class="form-container">
              <form action="/home/forget" method="post">
                <div class="form-input">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()">
                  <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) {echo $GLOBALS["emailErr"];} ?></span>
                </div>
    
                <div class="form-input">
                  <input type="submit" name="forgetpassword" id="submit-btn" value="Send Email">
                </div>
              </form>
            </div>

            <div class="back-container">
              <a href="/home/login">Go Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/public/js/script.js"></script>
  </body>
</html>
