<?php

  use App\Credentials;

  spl_autoload_register(function($className) {
    require_once 'classes/' . $className . '.php';
  });

  // Initialized the route object
  $routeObj = new Route();
?>
