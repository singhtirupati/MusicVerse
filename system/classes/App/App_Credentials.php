<?php

  namespace App;

  /**
   * Including Dotenv to access env variables.
   * Access database credentials.
   */
  require 'vendor/autoload.php';

  use Dotenv\Dotenv;

  /** 
   * Class to store database credentials. 
   */
  class Credentials {

    public function __construct() {
      $dotenv = Dotenv::createImmutable("./");
      $dotenv->load();
    
      $_ENV['USERNAME'];
      $_ENV['PASSWORD'];
      $_ENV['DBNAME'];
      $_ENV['APIKEY'];
      $_ENV['EMAIL_PASSWORD'];
      $_ENV['EMAIL'];
    }

  }
?>
