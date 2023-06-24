<?php

  /**
   * Route class contains default controller and 
   * method value.
   * This class contains method to fetch controller
   * and method details from url.
   */
  class Route {

    /**
     *  @var string $controller
     *    Holds default value for controller.
     */
    public $controller = "Home";

    /**
     *  @var string $method
     *    Holds default value for method.
     */
    public string $method = "index";

    /**
     *  @var array $parameter
     *    Stores parameter passed in url.
     */
    public array $parameter = [];

    /**
     * Constructor to check whether controller file
     * or method exists or not.
     * It will fetch parameter passed in url.
     * 
     *  @return void
     */
    public function __construct() {
      $url = $this->retrieveURL();

      if(file_exists('application/controller/' . $url[0] . '.php')) {
        $this->controller = $url[0];
        unset($url[0]);
      }

      require_once 'application/controller/' . $this->controller . '.php';

      $this->controller = new $this->controller;

      if(isset($url[1])) {
        if(method_exists($this->controller, $url[1])) {
          $this->method = $url[1];
          unset($url[1]);
        }
      }

      $this->parameter = $url ? array_values($url) : [];

      call_user_func_array([$this->controller, $this->method], $this->parameter);
    }

    /**
     * Function to remove whitespaces and special characters
     * from url.
     * 
     *  @return array
     *    It will return url value.
     */
    public function retrieveURL() {
      $url = $_SERVER['REQUEST_URI'];
      $url = trim($url, "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = ucfirst($url);
      $url = explode("/", $url);

      return $url;
    }
    
  }
?>
