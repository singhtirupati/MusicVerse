<?php

  $_SESSION["message"] = "";
  
  /**
   * Register controller class contains methods to register
   * new user.
   */
  class Register extends Framework {
    
    /**
     * Function to load user registration page.
     */
    public function signup() {
      if(isset($_POST["register"])) {
        $this->model("Signup");
        $this->model("UserDb");
        $this->model("Email");

        $userDb = new UserDb();
        $emailVerify = new Email();
        $validateSignup = new Signup();

        $registerOk = $validateSignup->checkRegistration($_POST);

        // Disabled email verification using api as it taking time to receive response.
        // $emailVerify->verifyEmail($_POST["email"]);

        // Check for input fields are valid or not.
        if($registerOk) {

          // Check for email api verification.
          if($emailVerify->emailErr == "") {

            // Check if user already register or not.
            if(!$userDb->checkUserNameExists($_POST["email"])
                && !$userDb->checkUserContactExists($_POST["phone"])) {

              // Check if user has been register or not.
              if($userDb->registerUser($_POST)) {
                $_SESSION["message"] = "Your account has been created successfully!";
                $this->view("login");
              }
              else {
                $_SESSION["message"] = "Error while creating your account. Please try again.";
                $this->view("register");
              }
            }
            else {
              $_SESSION["message"] = "User already exists.";
              $this->view("register");
            }
          }
          else {
            $_SESSION["message"] = "Invalid email!";
            $this->view("register");
          }
        }
        else {
          $GLOBALS["nameErr"] = $validateSignup->nameErr;
          $GLOBALS["genderErr"] = $validateSignup->genderErr;
          $GLOBALS["interestErr"] = $validateSignup->interestErr;
          $GLOBALS["phoneErr"] = $validateSignup->phoneErr;
          $GLOBALS["emailErr"] = $validateSignup->emailErr;
          $GLOBALS["passwordErr"] = $validateSignup->passwordErr;
          $GLOBALS["cnfpasswordErr"] = $validateSignup->cnfpasswordErr;
          $this->view("register");
        }
      }
      else {
        $this->view("register");
      }
    }

  }
?>
