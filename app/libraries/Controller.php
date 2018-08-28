<?php 
// Base Controller this loads the models and Multiviews
class Controller{
  // Load models
  public function model($model){
    // require model file_exists
    require_once '../app/models/'.$model.'.php';
  
    return new $model();
  }
  
  // Load view
  public function view($view, $data=array()){
    // check for the view file_exists
    if (file_exists('../app/views/'.$view.'.php')) {
      require_once '../app/views/'.$view.'.php';
    }else{
      header("Location: index.php");
    }
  }
}
