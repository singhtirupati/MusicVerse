<?php

  /**
   * This class contains methods to load view and model page.
   */
  class Framework {

    /**
     * Function to load view page.
     * If not found then show error page.
     * 
     *  @param string $filename
     *    Contains file name.
     */
    public function view(string $filename) {
      $dir = 'application/view/' . $filename . '.php';

      if(file_exists($dir)) {
        require_once $dir;
      }
      else {
        $this->error("error");
      }
    }

    /**
     * Function to load model page.
     * If not found then show error page.
     * 
     *  @param string $filename
     *    Contains file name.
     */
    public function model(string $filename) {
      $dir = 'application/model/' . ucfirst($filename) . '.php';

      if(file_exists($dir)) {
        require_once $dir;
      }
      else {
        $this->error("error");
      }
    }

    /**
     * Function to load error page.
     * 
     *  @param string $filename
     *    Contains file name.
     */
    public function error(string $filename) {
      $dir = 'application/view/' . $filename . '.php';

      if(file_exists($dir)) {
        require_once $dir;
      }
    }

    /**
     * Function to load passed page.
     * 
     *  @param string $filename
     *    Contains file name.
     */
    public function redirect(string $path) {
      header('location: /' . $path);
    }
    
  }
?>
