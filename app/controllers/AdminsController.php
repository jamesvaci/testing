<?php

class Admins extends Controller{
  public function __construct(){
    $this->userModel = $this->model('Admin');  
  }
  
  public function a_q()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = array('created' => $_POST['created'], 'answer' => $_POST['answer']);
      if ($this->userModel->a_q($data)) {
        $data =$this->userModel->getusers();
        header("Location: index.php?url=admins/users");
      }else {
        echo "Fail";
      }
    }
  }
  
  public function a_qHidden()
  {
    $this->admin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = array('created' => $_POST['hidden_created']);
      if ($this->userModel->a_qHidden($data)) {
        $data =$this->userModel->getusers();
        header("Location: index.php?url=admins/users");
      }else {
        echo "Fail";
      }
    }
  }
  
  public function admin()
  {
    if (!empty($_SESSION['app_id'])) {
      $data = $this->userModel->isAdmin($_SESSION['app_id']);
      if ($data == "0" || $data == "1") {
        header("Location: index.php");
      }
    }else{
      header("Location: index.php");
    }
  }
  
  public function users()
  {
    $this->admin();
    $data =$this->userModel->getusers();
    $this->view('pages/admin', $data);
  }
  
  public function removeuser()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $this->userModel->removeuser($_POST['app_id']);
    }
  }
  
  public function article()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $time = time();
      $data = array('title' => $_POST['article_title'], 'description' => $_POST['article_description'], 'created' => $time);
      if($this->userModel->insert('news', $data)){
        echo 'Done';
      }else{
        echo "Error";
      };
    }  
  }
  
  public function addcategorypic()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $time = time();
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = $_POST['img_thumbCategory'];
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $data = base64_decode($data);
      
      file_put_contents('/tmp/'.$_POST['nameCategory'].'.png', $data);
      rename("/tmp/".$_POST['nameCategory'].".png", "./img/category/".$_POST['nameCategory'].".png");
      chmod("./img/category/".$_POST['nameCategory'].".png", 0755);
      header("Location: index.php?url=admins/users");
    }
  }
  
  public function addsubcategorypic()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {      
      $time = time();
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = $_POST['img_thumbCategory'];      
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $data = base64_decode($data);      
      file_put_contents('./img/category/subcategory/'.$_POST['nameCategory'].'.png', $data);
      header("Location: index.php?url=admins/users");
    }
  }
  
  public function addsubcategory()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $category = str_replace(" ", "_", $_POST['category_name']);
      $subcategory = str_replace(" ", "_", $_POST['subcategory_name']);
      $final = $this->userModel->insertsub($category, $subcategory);
      header("Location: index.php?url=admins/users");
    }
  }
  
  public function addcategory()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $category = str_replace(" ", "_", $_POST['category_name']);
      $final = $this->userModel->insertcat($category);
      header("Location: index.php?url=admins/users");
    }
  }
  
  public function addproduct()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $time = time();
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      $category = str_replace(" ", "_",strtolower($_POST['category']))."/";
      $subcategory = str_replace(" ", "_",strtolower($_POST['subcategory']))."/";
      $subsubcategory = "";
      if (strpos($_POST['subcategory']," - ")) {
        $subcategory = strtolower(str_replace(" ", "_", substr($_POST['subcategory'], (strpos($_POST['subcategory']," - ")+3)))) . "/";
        $subsubcategory = strtolower(str_replace(" ", "_", substr($_POST['subcategory'], 0, strpos($_POST['subcategory']," - ")))) . "/";
      }
      if (!file_exists('./img/category/'.$category)) {
        mkdir('./img/category/'.$category);
      }
      if (!file_exists('./img/category/'.$category.$subcategory)) {
        mkdir('./img/category/'.$category.$subcategory);
      }
      
      if ($subsubcategory) {
        if (!file_exists('./img/category/'.$subcategory.$subsubcategory)) {
          mkdir('./img/category/'.$category.$subcategory.$subsubcategory);
        }
      }
      $data = $_POST['img_thumb'];
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $data = base64_decode($data);
      file_put_contents('./img/category/'.$category.$subcategory.$subsubcategory.$_POST['product_name'].'-thumbnail-'.$time.'.png', $data);
      $data = $_POST['img_full'];
      
      $imgType = "png";
      if (substr($data, 11,4)) {
        $imgType = "jpg";
      }
      
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      
      $data = base64_decode($data);
      file_put_contents('./img/category/'.$category.$subcategory.$subsubcategory.$_POST['product_name'].'-'.$time.'.'.$imgType, $data);
      header("Location: index.php?url=admins/users");
    }
  }
}
