<?php 
require_once 'config/config.php';
// Loading from the library folder

spl_autoload_register(function($className){
  require_once 'libraries/'.$className.'.php';
});
