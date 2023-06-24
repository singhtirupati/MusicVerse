<?php

  // Import PHPMailer classes into the global namespace.
  // These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  use App\Credentials;

  // Load Composer's autoloader.
  require 'vendor/autoload.php';

  /**
   * This class contains  methods to verify email using api
   * and send email to reset password.
   */
  class Email {

    /**
     *  @var string $emailErr
     *    Stores email error messages.
     */
    public string $emailErr = "";

    /**
     * Function to verify email using an api.
     * Api will verify whether email is active or not.
     * It will check whether smtp_check is true, and valid format.
     * 
     *  @param string $email
     *    In this function email is passed as parameter.
     */
    public function verifyEmail(string $email) {

      // Creating Credentials class object to access credentials.
      $credentials = new Credentials();
      $client = new \GuzzleHttp\Client();
      
      $response = $client->request('GET', "https://api.apilayer.com/email_verification/check?email=$email", 
        ['headers' => ['Content-Type' => 'text/plain', 'apikey'=> $_ENV['APIKEY']]]
      );
      
      $responseReceived = $response->getBody();
      $validationResult = json_decode($responseReceived, true);

      // Check whether email format and smtp_check is valid or not.
      if ($validationResult["format_valid"] && $validationResult["smtp_check"]) {
        $this->emailErr = "";
      } 
      else {
        $this->emailErr = "Invalid e-mail!";
      }
    }

    /**
     * This function will send email to entered email id on form.
     * 
     *  @param string $email
     *    Holds email.
     * 
     *  @return bool
     *    It will return true if sent, else false if not.
     */
    public function sendEmail(string $email) {

      // Create an instance; passing `true` enables exceptions.
      $mail = new PHPMailer(true);

      // Server settings
      try {
        
        // Enable verbose debug output.
        $mail->SMTPDebug = 0;
        
        // Send using SMTP.
        $mail->isSMTP();
        
        // Set the SMTP server to send through.
        $mail->Host = 'smtp.gmail.com';
        
        // Enable SMTP authentication.
        $mail->SMTPAuth = TRUE;
        
        // SMTP username.
        $mail->Username = $_ENV["EMAIL"];
        
        // SMTP password.
        $mail->Password = $_ENV["EMAIL_PASSWORD"];
        
        // Enable implicit TLS encryption.
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        
        // TCP port to connect to; use 587 if you have set
        // `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`.
        $mail->Port = 465; 
      
        // Recipients email
        $mail->setFrom('from@example.com', 'Photography');
        $mail->addAddress($email);
        $mail->addReplyTo('info@example.com', 'Information');
      
        // Email contents, set email format to HTML.
        $mail->isHTML(true);
        $mail->Subject = 'Reset your password.';
        $mail->Body = 'Hi,<br><br>Forgot your password?<br>
        We received a request to reset the password for your account.<br>
        <br>To reset your password, click on the button below:<br>
        <a href="http://musicverse.com/home/reset" style="color: white;background-color: #008ecf;padding: 10px 15px;display: inline-block;border-radius: 8px;text-decoration: none;">Reset password</a><br><br>
        Or copy and paste the URL into your browser:<br>
        <a href="http://musicverse.com/home/reset">http://musicverse.com/home/reset</a>';
        $mail->AltBody = '';

        $mail->send();

        return TRUE;
      } 
      catch (Exception $e) {
        return FALSE;
      }
    }

  }
?>
