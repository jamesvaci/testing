<?php 

class Core {
  
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = array();
  
  public function __construct(){
    $url = $this->getUrl();
    if(!isset($_COOKIE['Language'])) {
    $cookie_value = "EN";
    setcookie('Language', $cookie_value, time() + (86400 * 30), "/");
  }
    // looking in controllers for first values
    if(file_exists('../app/controllers/'.ucwords($url[0]).'Controller.php')){
      // If it file_exists
      $this->currentController = ucwords($url[0]);
      // Unset 0 Indexes
      unset($url[0]);
    }
    // Require the controllers
    require_once '../app/controllers/'.$this->currentController.'Controller.php';
    
    $this->currentController = new $this->currentController;
    // Checking for the second partif
    if (isset($url[1])) {
      // Checking to see if method file_exists
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
      }
    }
    
    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }
  
  public function getUrl(){
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
