<?php
  class User
  {
    private $db;
    
    public function __construct()
    {
      $this->db = new Database;
    }
    
    public function getcategories()
    {
      $this->db->query('SELECT * FROM bane_db.bane_category');
      return $this->db->resultSet();
    }
    
    public function getcategoriesseperate($type)
    {
      if ($type == 'kitchens') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="Kitchens"');
      }elseif ($type == 'modernkitchens') {
        $this->db->query('SELECT subcategory->"$.Modern_Kitchens" FROM bane_db.bane_category WHERE name="Kitchens"');
      }elseif ($type == 'rustickitchens') {
        $this->db->query('SELECT subcategory->"$.Rustic_Kitchens" FROM bane_db.bane_category WHERE name="Kitchens"');
      }elseif ($type == 'classickitchens') {
        $this->db->query('SELECT subcategory->"$.Classic_Kitchens" FROM bane_db.bane_category WHERE name="Kitchens"');
      }elseif ($type == 'ceramic_floor') {
        $this->db->query('SELECT subcategory->"$.Ceramic_floor" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'fittings') {
        $this->db->query('SELECT subcategory->"$.Fittings" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'aquastil') {
        $this->db->query('SELECT subcategory->"$.AquaStil" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'haberdashery') {
        $this->db->query('SELECT subcategory->"$.Haberdashery" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'huppe') {
        $this->db->query('SELECT subcategory->"$.HUPPE" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'bathroom_equipment') {
        $this->db->query('SELECT subcategory->"$.Bathroom_Equipment" FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'lg_solid_surface') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="LG_Solid_Surface"');
      }elseif ($type == 'lumino_solid_surface') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="Lumino_Solid_Surface"');
      }elseif ($type == 'doors') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="Doors"');
      }elseif ($type == 'aquahome_equipment_for_bathrooms') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="AquaHome_Equipment_for_Bathrooms"');
      }elseif ($type == 'interiors') {
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="Interiors"');
      }else{
        $this->db->query('SELECT subcategory FROM bane_db.bane_category WHERE name="Bathroom_Furniture"');
      }
      return $this->db->resultSet();
    }
    
    public function qa($data)
    {
      $timestamp = date_timestamp_get(date_create());
      $this->db->query('INSERT INTO bane_db.bane_qa (user_id, question, created) VALUES(:user_id, :question, :created)');
      $this->db->bind(':user_id', $data['app_id']);
      $this->db->bind(':question', $data['question']);
      $this->db->bind(':created', $timestamp);
      
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }
    
    public function getQA()
    {
      $this->db->query('SELECT bane_users.first_name, bane_qa.question, bane_qa.answer FROM bane_db.bane_qa, bane_db.bane_users WHERE bane_qa.user_id=bane_users.app_id AND bane_qa.hidden=0');
      return $this->db->resultSet();
    }
    
    public function register($data){
      $timestamp = date_timestamp_get(date_create());
      $salt = md5(microtime(false));
      $hash = md5($salt.$data['password']);
      $app_id = $this->gen_uuid();
      $this->db->query('INSERT INTO bane_db.bane_users (app_id, first_name, last_name, email, pass_hash, pass_salt, created) VALUES(:app_id, :first_name, :last_name, :email, :pass_hash, :pass_salt, :created)');
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':pass_hash', $hash);
      $this->db->bind(':pass_salt', $salt);
      $this->db->bind(':created', $timestamp);
      $this->db->bind(':app_id', $app_id);
      
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }
    
    private function gen_uuid() {
      return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
      );
    }
    
    public function signin($data){
      $this->db->query('SELECT pass_salt, pass_hash, privlige FROM bane_db.bane_users WHERE email = :email');
      $this->db->bind(':email', $data['email']);  
      
      $t = $this->db->single();
      
      if($t->privlige == 0){
        return 2;
      }else{
        if (md5($t->pass_salt.$data['password']) == $t->pass_hash) {
          return 3;
        }else{
          return 4;
        }  
      }
    }
    
    public function sessionData($email){
      $this->db->query('SELECT app_id, first_name FROM bane_db.bane_users WHERE email = :email');
      $this->db->bind(':email', $email);  
      
      $res = $this->db->single();
      
      return $res;
    }
    
    public function isLoggedIn()
    {
      if(isset($_SESSION['app_id'])) {
         return 1;
      }else{
         return 0;
      }
    }
    
    public function findUsersEmail($email)
    {
      $this->db->query('select * from bane_db.bane_users where email =:email');
      $this->db->bind('email', $email);
      
      $row = $this->db->single();
      
      if ($this->db->rowCount()>0) {
        return true;
      }else{
        return false;
      }
    }
    
    public function getreferences()
    {
      $this->db->query('select * from bane_db.bane_references');
      return $this->db->resultSet();
    }
    
    public function getnews()
    {
      $this->db->query('select * from bane_db.bane_news');
      return $this->db->resultSet();
    }
  }
  
