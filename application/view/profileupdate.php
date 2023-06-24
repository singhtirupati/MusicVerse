<?php
  require 'application/view/header.php';
?>

<!-- User profile container -->
<div class="banner-container">
  <div class="page-wrapper banner-wrap">
    <div class="profile-content">
      <div class="error-msg">
        <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
      </div>
      <div class="title-head">
        <h1>Profile Update</h1>
      </div>

      <!-- Form container -->
      <div class="form-container">
        <form action="/profile/update" method="post">
          <div class="form-input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()" value="<?php if(isset($_SESSION["userprofile"])) { echo $_SESSION["userprofile"][0]["user_email"]; } ?>">
            <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) { echo $GLOBALS["emailErr"]; } ?></span>
          </div>

          <div class="form-input">
            <label for="phone">Contact Number</label>
            <input type="text" name="phone" id="phone" placeholder="Contact Number" onblur="validatePhone()" value="<?php if(isset($_SESSION["userprofile"])) { echo $_SESSION["userprofile"][0]["user_phone"]; } ?>">
            <span class="error" id="checkPhone"><?php if(isset($GLOBALS["phoneErr"])) { echo $GLOBALS["phoneErr"]; } ?></span>
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
            <input type="submit" name="update-profile" id="submit-btn" value="Update Profile">
          </div>
        </form>
      </div>
      <div class="back-container">
        <a href="/home/user" class="back-btn">Go Back</a>
      </div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>
