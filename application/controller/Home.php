<?php
  session_start();
  $_SESSION["message"] = "";

  /**
   * Home controller class to load home, login, dashboard, forget password
   * and sign out page.
   */
  class Home extends Framework {

    /**
     * Function to load landing page.
     */
    public function index() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->view("welcome");
      }
      else {
        $this->view("home");
      }
    }

    /**
     * Function to load dashboard page.
     */
    public function dashboard() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->model("UserDb");
        $userDb = new UserDb();
        $musicList = $userDb->requestMusic();
        $_SESSION["musicList"] = $musicList;

        $this->redirect("welcome");
      }
      else {
        $this->redirect("home");
      }
    }

    /**
     * Function to load user profile page.
     */
    public function user() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->model("UserDb");
        $userDb = new UserDb();
        $userId = $userDb->getUserId($_SESSION["email"]);
        $userProfile = $userDb->fetchUserProfile($_SESSION["email"]);
        $userMusic = $userDb->getUserMusic($userId);
        $userFavourite = $userDb->getFavourite($userId);

        $_SESSION["userProfile"] = $userProfile;
        $_SESSION["userMusic"] = $userMusic;
        $_SESSION["userFavourite"] = $userFavourite;

        $this->view("dashboard");
      }
      else {
        $this->redirect("home");
      }
    }

    /**
     * Function to load login page.
     */
    public function login() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->redirect("welcome");
      }
      else {
        if(isset($_POST["login"])) {
          $this->model("UserDb");
          $this->model("Signup");
          $userDb = new UserDb();
          $validateSignup = new Signup();
  
          $validateSignup->validateEmail($_POST["email"]);
          $validateSignup->validatePassword($_POST["password"]);
  
          // Check if there is no error in input field data.
          if($validateSignup->emailErr == "" && $validateSignup->passwordErr == "") {

            // Check if user login data exists or not in database.
            if($userDb->checkLogin($_POST["email"], $_POST["password"])) {
              $userProfile = $userDb->fetchUserProfile($_POST["email"]);
              $musicList = $userDb->requestMusic();
              $userId = $userDb->getUserId($_POST["email"]);
              $userMusic = $userDb->getUserMusic($userId);

              $_SESSION["userProfile"] = $userProfile;
              $_SESSION["musicList"] = $musicList;
              $_SESSION["userMusic"] = $userMusic;
              $_SESSION["email"] = $_POST["email"];
              $_SESSION["userId"] = $userId;
              $_SESSION["username"] = $userDb->getUsername($_POST["email"]);
              $_SESSION["loggedIn"] = TRUE;

              $this->redirect("welcome");
            }
            else {
              $_SESSION["message"] = "The username and password are incorrect.";
              $this->view("login");
            }
          }
          else {
            $GLOBALS["emailErr"] = $validateSignup->emailErr;
            $GLOBALS["passwordErr"] = $validateSignup->passwordErr;
            $this->view("login");
          }
        }
        else {
          $this->view("login");
        }
      }
    }
    
    /**
     * Function to load forget password page.
     */
    public function forget() {
      $_SESSION["mailSent"] = FALSE;

      if(isset($_POST["forgetpassword"])) {
        $this->model("UserDb");
        $this->model("Signup");
        $this->model("Email");

        $userDb = new UserDb();
        $validateSignup = new Signup();
        $email = new Email();

        $validateSignup->validateEmail($_POST["email"]);

        // Check if email format is valid.
        if($validateSignup->emailErr == "") {

          // Check if username exists in databse.
          if($userDb->checkUserNameExists($_POST["email"])) {

            // Send password reset email.
            if($email->sendEmail($_POST["email"])) {
              $_SESSION["message"] = "E-mail has been sent!";
              $_SESSION["mailSent"] = TRUE;
              $this->view("login");
            }
            else {
              $_SESSION["message"] = "E-mail could not be sent!";
              $this->view("forgetpassword");
            }
          }
          else {
            $_SESSION["message"] = "User does not exist.";
            $this->view("forgetpassword");
          }
        }
        else {
          $GLOBALS["emailErr"] = $validateSignup->emailErr;
          $this->view("forgetpassword");
        }
      }
      else {
        $this->view("forgetpassword");
      }
    }

    /**
     * Function to load reset password page.
     */
    public function reset() {
      
      // Check if password reset has been generated or not.
      if(isset($_SESSION["mailSent"]) && $_SESSION["mailSent"]) {
        if(isset($_POST["resetpassword"])) {
          $this->model("UserDb");
          $this->model("Signup");

          $userDb = new UserDb();
          $validateSignup = new Signup();

          $validateSignup->validateEmail($_POST["email"]);
          $validateSignup->validatePassword($_POST["password"]);
          $validateSignup->matchPassword($_POST["password"], $_POST["cnfpassword"]);

          // Check if email and password fields are valid.
          if($validateSignup->emailErr == ""
              && $validateSignup->passwordErr == ""
              && $validateSignup->cnfpasswordErr == "") {

            // Check if user email already exists or not in database.
            if($userDb->checkUserNameExists($_POST["email"])) {

              // Check if user credentials has been updated.
              if($userDb->updateCredentials($_POST["email"], $_POST["password"])) {
                $_SESSION["message"] = "Password changed successfully.";
                $_SESSION["mailSent"] = FALSE;
                $this->view("login");
              }
              else {
                $_SESSION["message"] = "Error while updating password.";
                $this->view("resetpassword");
              }
            }
            else {
              $_SESSION["message"] = "User does not exist.";
              $this->view("resetpassword");
            }
          }
          else {
            $GLOBALS["emailErr"] = $validateSignup->emailErr;
            $GLOBALS["passwordErr"] = $validateSignup->passwordErr;
            $GLOBALS["cnfpasswordErr"] = $validateSignup->cnfpasswordErr;
            $this->view("resetpassword");
          }
        }
        else {
          $this->view("resetpassword");
        }
      }
      else {
        $this->view("login");
      }
    }

    /**
     * Function to load signout page.
     * After sign out destroy session.
     */
    public function signout() {
      session_unset();
      session_destroy();
      $this->redirect("home");
    }

    /**
     * Function to load error page.
     */
    public function page() {
      $this->error('error');
    }

  }
?>
