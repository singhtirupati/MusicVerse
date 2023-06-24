<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Enjoy your music...</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/login.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">

    <!-- Login container -->
      <div class="login-container">
        <div class="page-wrapper login-content-wrap">
          <div class="login-content">
            <div class="error-msg">
              <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
            </div>
            <div class="logo">
              <img src="/public/img/logo.svg" alt="Music Verse">
            </div>
            <div class="title-head">
              <h1>Login to enjoy your music.</h1>
            </div>

            <!-- Form container -->
            <div class="form-container">
              <form action="/home/login" method="post">
                <div class="form-input">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()">
                  <span class="error"><?php if(isset($GLOBALS["emailErr"])) {echo $GLOBALS["emailErr"];} ?></span>
                  <span class="error" id="checkEmail"></span>
                </div>

                <div class="form-input">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                  <span class="error"><?php if(isset($GLOBALS["passwordErr"])) {echo $GLOBALS["passwordErr"];} ?></span>
                  <span class="error" id="checkPass"></span>
                </div>

                <div class="form-input">
                  <a href="/home/forget">Forgot your password?</a>
                </div>

                <div class="form-input">
                  <input type="submit" name="login" id="submit-btn" value="Sign In">
                </div>
              </form>
            </div>

            <div class="signup-container">
              <p>Don't have an account?</p>
              <a href="/register/signup">Sign Up For Free</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/public/js/script.js"></script>
  </body>
</html>
