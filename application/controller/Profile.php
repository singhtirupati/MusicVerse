<?php
  session_start();
  $_SESSION["message"] = "";

  /**
   * Profile controller class to update user profile.
   */
  class Profile extends Framework {

    /**
     * Function load user profile update page.
     */
    public function update() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->model("UserDb");

        $database = new UserDb();
        
        $data = $database->fetchUserProfile($_SESSION["email"]);

        $_SESSION["email"] = $data[0]["user_email"];
        $_SESSION["userPhone"] = $data[0]["user_phone"];

        if(isset($_POST["update-profile"])) {
          $this->model("Email");
          $this->model("Signup");

          $validateData = new Signup();
          $email = new Email();
        
          $validateData->validateEmail($_POST["email"]);
          $validateData->validateContact($_POST["phone"]);
          $validateData->validateInterest($_POST);
          
          // Disabled email verification using api as it taking time to receive response.
          // $email->verifyEmail($_POST["email"]);

          // Check if input fields are in valid format or not.
          if($validateData->emailErr == ""
              && $validateData->phoneErr == ""
              && $validateData->interestErr == "") {

            // Verify whether email is working or not.
            if($email->emailErr == "") {

              // Check whether if profile has been updated in database or not.
              if($database->updateProfile($_SESSION["email"], $_POST["email"], $_POST["phone"], $_POST["genre"])) {
                $_SESSION["message"] = "Profile updated successfully!";
                $this->view("profileupdate");
              }
              else {
                $_SESSION["message"] = "Unable to update your profile!";
                $this->view("profileupdate");
              }
            }
            else {
              $_SESSION["message"] = "Invalid email";
              $this->view("profileupdate");
            }
          }
          else {
            $GLOBALS["interestErr"] = $validateData->interestErr;
            $GLOBALS["phoneErr"] = $validateData->phoneErr;
            $GLOBALS["emailErr"] = $validateData->emailErr;
            $this->view("profileupdate");
          }
        }
        else {
          $this->view("profileupdate");
        }
      }
      else {
        $this->view("login");
      }
    }

  }
?>
