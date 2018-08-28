<?php 

class Pages extends Controller{
  public function __construct(){
    $this->postModel = $this->model('Post');
  }
  
  public function index(){
    $this->view('pages/index');
  }
  
  public function products(){
    $this->view('pages/products');
  }
  
  public function references(){
    $this->view('pages/references');
  }
  
  public function admin(){
    $this->view('pages/admin');
  }
  
  public function lumino(){
    $this->view('pages/lumino');
  }
  
  public function qa(){
    $this->view('pages/qa');
  }
  
  public function discout(){
    $this->view('pages/discount');
  }
  
  public function contact(){
    $this->view('pages/contact');
  }
  
  public function market(){
    $this->view('pages/market');
  }
  
  public function signin(){
    $this->view('pages/signin');
  }
  
  public function register(){
    $this->view('pages/register');
  }
  
  public function kitchens(){
    $this->view('pages/kitchens');
  }
  
  public function lg_solid_surface(){
    $this->view('pages/lg_solid_surface');
  }
  
  public function lumino_solid_surface(){
    $this->view('pages/lumino_solid_surface');
  }
  
  public function doors(){
    $this->view('pages/doors');
  }
  
  public function aquahome_equipment_for_bathrooms(){
    $this->view('pages/aquahome_equipment_for_bathrooms');
  }
  
  public function interiors(){
    $this->view('pages/interiors');
  }
  
  public function bathroom_furniture(){
    $this->view('pages/bathroom_furniture');
  }
  
  public function viewproduct(){
    $this->view('pages/viewproduct');
  }
}
