<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Music Verse</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/register.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">

      <!-- Register container -->
      <div class="register-container">
        <div class="page-wrapper register-content-wrap">
          <div class="register-content">
            <div class="left-container">
              <div class="logo">
                <img src="/public/img/logo.svg" alt="Music Verse">
              </div>
              <div class="title-head">
                <h1>Listen music anytime, anywhere on <strong>MUSIC VERSE</strong>.</h1>
              </div>
            </div>
            <div class="right-container">
              <div class="error-msg">
                <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
              </div>
              <h2>Register</h2>
              
              <!-- Form container -->
              <div class="form-container">
                <form action="/register/signup" method="post">
                  <div class="form-input">
                    <label for="fname">Name</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" onblur="validateName()" value="<?php if(isset($_POST["name"])) { echo $_POST["name"]; } ?>">
                    <span class="error" id="checkName"><?php if(isset($GLOBALS["nameErr"])) { echo $GLOBALS["nameErr"]; } ?></span>
                  </div>
  
                  <div class="form-input gender-div">
                    <label for="gender" id="gender">Gender</label>
                    <input type="radio" id="male" name="gender" value="Male" <?php if (isset($_POST["gender"]) && $_POST["gender"]=="Male") { echo "checked"; }?>>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" <?php if (isset($_POST["gender"]) && $_POST["gender"]=="Female") { echo "checked"; }?>>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="Other" <?php if (isset($_POST["gender"]) && $_POST["gender"]=="Other") { echo "checked"; }?>>
                    <label for="other">Other</label>
                    <input type="radio" id="pref" name="gender" value="Prefer not to say" <?php if (isset($_POST["gender"]) && $_POST["gender"]=="Prefer not to say") { echo "checked"; }?>>
                    <label for="prefer not to say">Prefer not to say</label>
                    <span class="error" id="checkGender"><?php if(isset($GLOBALS["genderErr"])) { echo $GLOBALS["genderErr"]; } ?></span>
                  </div>
  
                  <div class="form-input interest-div">
                    <label for="">Interests - Genre</label>
                    <input type="checkbox" id="pop" name="genre[]" value="Pop" <?php if(isset($_POST["genre"]) && isset($_POST["genre"][0])) { echo "checked"; } ?>>
                    <label for="pop">Pop</label>
                    <input type="checkbox" id="rock" name="genre[]" value="Rock" <?php if(isset($_POST["genre"]) && isset($_POST["genre"][1])) { echo "checked"; } ?>>
                    <label for="rock">Rock</label>
                    <input type="checkbox" name="genre[]" id="classic" value="Classic" <?php if(isset($_POST["genre"]) && isset($_POST["genre"][2])) { echo "checked"; } ?>>
                    <label for="classic">Classic</label>
                    <input type="checkbox" name="genre[]" id="hiphop" value="Hip Hop" <?php if(isset($_POST["genre"]) && isset($_POST["genre"][3])) { echo "checked"; } ?>>
                    <label for="hiphop">Hip Hop</label>
                    <input type="checkbox" name="genre[]" id="others" value="Others" <?php if(isset($_POST["genre"]) && isset($_POST["genre"][4])) { echo "checked"; } ?>>
                    <label for="others">Others</label>
                    <span class="error" id="checkInterest"><?php if(isset($GLOBALS["interestErr"])) { echo $GLOBALS["interestErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="phone">Contact Number</label>
                    <input type="text" name="phone" id="phone" placeholder="Contact Number" onblur="validatePhone()" value="<?php if(isset($_POST["phone"])) { echo $_POST["phone"]; } ?>">
                    <span class="error" id="checkPhone"><?php if(isset($GLOBALS["phoneErr"])) { echo $GLOBALS["phoneErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()" value="<?php if(isset($_POST["email"])) { echo $_POST["email"]; } ?>">
                    <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) { echo $GLOBALS["emailErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                    <span class="error" id="checkPass"><?php if(isset($GLOBALS["passwordErr"])) { echo $GLOBALS["passwordErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="cnfpassword" id="cnfpassword" placeholder="Password" onblur="matchPassword()">
                    <span class="error" id="checkCnfPass"><?php if(isset($GLOBALS["cnfpasswordErr"])) { echo $GLOBALS["cnfpasswordErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <input type="submit" name="register" id="submit-btn" value="Sign Up">
                  </div>
                </form>
              </div>
              <div class="signin-container">
                <p>Already have an account?</p>
                <a href="/home/login">Sign In</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/public/js/script.js"></script>
  </body>
</html>
