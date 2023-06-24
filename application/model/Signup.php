<?php

  /**
   * This class will hold all validation methods and 
   * their error messages.
   */
  class Signup {

    /**
     *  @var string $nameErr
     *    Holds error message while checking name.
     */
    public string $nameErr = "";

    /**
     *  @var string $genderErr
     *    Holds gender error message while checking gender field data.
     */
    public string $genderErr = "";

    /**
     *  @var string $interestErr
     *    Holds interest error message while checking interest field data.
     */
    public string $interestErr = "";

    /**
     *  @var string $phoneErr
     *    Holds error message while checking phone number.
     */
    public string $phoneErr = "";

    /**
     *  @var string $emailErr
     *    Holds error message while checking email.
     */
    public string $emailErr = "";

    /**
     *  @var string $passwordErr
     *    Holds error message while checking password pattern.
     */
    public string $passwordErr = "";

    /**
     *  @var string $cnfpasswordErr
     *    Holds error message while checking confirm password pattern.
     */
    public string $cnfpasswordErr = "";

    /**
     *  @var int $dataValid
     *    Stores 1 if all data fields are valid, 0 if not.
     */
    public int $dataValid = 1;

    /**
     * Function to validate full name.
     * 
     *  @param string $name
     *    Holds full name of user.
     * 
     *  @return bool
     *    True if format valid, false if not.
     */
    public function validateName(string $name) {

      // Check if input field is empty.
      if(empty($name)) {
        $this->nameErr = "Name field cannot be empty.";
        $this->dataValid = 0;
        return FALSE;
      }
      else if(!preg_match("/^[a-zA-Z-' ]+$/", $name)) {
        $this->nameErr = "Only characters are allowed!";
        $this->dataValid = 0;
        return FALSE;
      }
      else {
        return TRUE;
      }
    }

    /**
     * Function to check gender value.
     * 
     *  @param array $user_data
     *    Contains user all data.
     */
    public function validateGender(array $user_data) {
      if(!isset($user_data["gender"])) {
        $this->genderErr = "Gender is required";
        $this->dataValid = 0;
      }
    }

    /**
     * Function to check whether field contains one value or not.
     * 
     *  @param array $user_data
     *    Hold user all data.
     */
    public function validateInterest(array $user_data) {
      if(!isset($user_data["genre"])) {
        $this->interestErr = "Please select at least 1 genre";
        $this->dataValid = 0;
      }
    }

    /**
     * Function to validate phone number format.
     * 
     *  @param string $phone
     *    Contains phone number.
     * 
     *  @return bool
     *   Return true if format valid, false if not.
     */
    public function validateContact(string $phone) {
      if(empty($phone)) {
        $this->phoneErr = "Phone number is required";
        $this->dataValid = 0;
        return FALSE;
      }
      else if(!preg_match("/^(\+91)[0-9]{10}$/", $phone)) {
        $this->phoneErr = "Invalid phone number!";
        $this->dataValid = 0;
        return FALSE;
      }
      else {
        return TRUE;
      }
    }

    /**
     * Function to check email format.
     * 
     *  @param string $email
     *    Contains email address.
     */
    public function validateEmail(string $email) {
      if(empty($email)) {
        $this->emailErr = "Email is required";
        $this->dataValid = 0;
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->emailErr = "Invalid email format!";
        $this->dataValid = 0;
      }
      else {
        $this->emailErr = "";
      }
    }

    /**
     * Function to check password pattern.
     *  
     *  @param string $password
     *    Contains password entered by user.
     */
    public function validatePassword(string $password) {
      $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/";

      if(empty($password)) {
        $this->passwordErr = "Password cannot be empty.";
        $this->dataValid = 0;
      }
      else if (!strlen($password) >= 8 && strlen($password) <= 15) {
        $this->passwordErr = "Password length must be greater than 8 characters.";
        $this->dataValid = 0;
      }
      else if(!preg_match($pattern, $password)) {
        $this->passwordErr = "Password must contain at least one lower, one upper, one numeric and one special character";
        $this->dataValid = 0;
      }
      else {
        $this->passwordErr = "";
      }
    }

    /**
     * Function to match password and confirm password.
     * 
     *  @param string $password
     *    Contains user password.
     * 
     *  @param string $cnfpassword
     *    Contains user confirm password.
     * 
     *  @return bool
     *    True if password match, false if not.
     */
    public function matchPassword(string $password, string $cnfpassword) {
      if(empty($cnfpassword)) {
        $this->cnfpasswordErr = "Confirm password cannot be empty";
        $this->dataValid = 0;
        return FALSE;
      }
      else if($password != $cnfpassword) {
        $this->cnfpasswordErr = "Password do not match.";
        $this->dataValid = 0;
        return FALSE;
      }
      else {
        return TRUE;
      }
    }

    /**
     * Function to check user registration data.
     * 
     *  @param array $user_data
     *    Contains all user information.
     * 
     *  @return bool
     *    True if all fields are valid, false if not.
     */
    public function checkRegistration(array $user_data) {
      $this->validateName($user_data["name"]);
      $this->validateGender($user_data);
      $this->validateInterest($user_data);
      $this->validateContact($user_data["phone"]);
      $this->validateEmail($user_data["email"]);
      $this->validatePassword($user_data["password"]);
      $this->matchPassword($user_data["password"], $user_data["cnfpassword"]);

      if($this->dataValid) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

  }
?>
