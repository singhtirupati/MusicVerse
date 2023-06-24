<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/reset.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">

      <!-- Password reset container -->
      <div class="reset-container">
        <div class="page-wrapper reset-content-wrap">
          <div class="reset-content">
            <div class="error-msg">
              <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
            </div>
            <div class="logo">
              <img src="/public/img/logo.svg" alt="Music Verse">
            </div>
            <div class="title-head">
              <h1>Password Reset</h1>
            </div>

            <!-- Form container -->
            <div class="form-container">
              <form action="/home/reset" method="post">
                <div class="form-input">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()">
                  <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) {echo $GLOBALS["emailErr"];} ?></span>
                </div>

                <div class="form-input">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                  <span class="error" id="checkPass"><?php if(isset($GLOBALS["passwordErr"])) {echo $GLOBALS["passwordErr"];} ?></span>
                </div>

                <div class="form-input">
                  <label for="password">Confirm Password</label>
                  <input type="password" name="cnfpassword" id="cnfpassword" placeholder="Password" onblur="matchPassword()">
                  <span class="error" id="checkCnfPass"><?php if(isset($GLOBALS["cnfpasswordErr"])) {echo $GLOBALS["cnfpasswordErr"];} ?></span>
                </div>

                <div class="form-input">
                  <input type="submit" name="resetpassword" id="submit-btn" value="Change Password">
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
