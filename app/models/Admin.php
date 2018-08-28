<?php 
  class Admin{
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }
    
    public function getUsers()
    {
      $this->db->query("SELECT * FROM bane_db.bane_users ");
      
      $users = $this->db->resultSet();
      
      $this->db->query("SELECT * FROM bane_db.bane_category ");
        
      $categories = $this->db->resultSet();
      
      $this->db->query("SELECT * FROM bane_db.bane_orders ");
        
      $orders = $this->db->resultSet();
      
      $this->db->query("SELECT bane_users.first_name, bane_users.last_name, bane_qa.question, bane_qa.answer, bane_qa.created, bane_qa.hidden FROM bane_db.bane_qa, bane_db.bane_users WHERE bane_qa.user_id=bane_users.app_id");
        
      $qa = $this->db->resultSet();
      
      $this->db->query("SELECT * FROM bane_db.bane_products ");
        
      $products = $this->db->resultSet();
      
      $this->db->query("SELECT * FROM bane_db.bane_news ");
        
      $news = $this->db->resultSet();
      
      $result = array('Users'=>$users, 'News'=>$news, 'Categories'=>$categories, 'Orders'=>$orders, 'QA'=>$qa, 'Products'=>$products);
      
      return $result;
    }
    
    public function gettype($type)
    {
      if ($type == 'news') {
        return "bane_db.bane_news";
      }elseif ($type == 'category') {
        return "bane_db.bane_category";
      }elseif ($type == 'orders') {
        return "bane_db.bane_orders";
      }elseif ($type == 'products`') {
        return "bane_db.bane_producs";
      }elseif ($type == 'qa') {
        return "bane_db.bane_qa";
      }else {
        return "bane_db.bane_users";
      }
    }
    
    public function getcolumnsupdate($data)
    {
      $column = "";
      foreach ($data as $key => $value) {
        $column .= "`".$key."`='.$value.',";
      }
      $column=substr($column, 0, strlen($column)-1);
      
      return $result = array('column' => $column, 'columnValue' => $columnValue);
    }
    
    public function getcolumns($data)
    {
      $column = "";
      $columnValue = "";
      foreach ($data as $key => $value) {
        $column .= "`".$key."`,";
        $columnValue .= "'".$value."',";
      }
      $column=substr($column, 0, strlen($column)-1);
      $columnValue=substr($columnValue, 0, strlen($columnValue)-1);
      
      return $result = array('column' => $column, 'columnValue' => $columnValue);
    }
    
    public function insert($type, $data)
    {
      $table = $this->gettype($type);
      
      $dataColumn = $this->getcolumns($data);
      $column = $dataColumn['column'];
      $columnValue = $dataColumn['columnValue'];
      
      $this->db->query("INSERT INTO ".$table." (".$column.") VALUES (".$columnValue.")");
      return $this->db->execute();
    }
    
    public function delete($type, $data)
    {
      $table = $this->gettype($type);
      
      $dataColumn = $this->getcolumns($data);
      $column = $dataColumn['column'];
      $columnValue = $dataColumn['columnValue'];
      
      $this->db->query("DELETE FROM ".$table." WHERE ".$dataColumn);
      return $this->db->execute();
    }
    
    public function update($type, $data)
    {
      $table = $this->gettype($type);
      
      $dataColumn = $this->getcolumns($data);
      $column = $dataColumn['column'];
      $columnValue = $dataColumn['columnValue'];
      
      $this->db->query("UPDATE ".$table." SET answer=:answer WHERE created=:created;");
      $this->db->bind(':created', $data['created']);
      $this->db->bind(':answer', $data['answer']);
      return $this->db->execute();
    }
    
    public function a_q($data)
    {
      $this->db->query("UPDATE bane_db.bane_qa SET answer=:answer WHERE created=:created;");
      $this->db->bind(':created', $data['created']);
      $this->db->bind(':answer', $data['answer']);
      return $this->db->execute();
    }
    
    public function a_qHidden($data)
    {
      $this->db->query("UPDATE bane_db.bane_qa SET hidden = NOT hidden WHERE created=:created;");
      $this->db->bind(':created', $data['created']);
      return $this->db->execute();
    }
    
    public function removeuser($app_id)
    {
      $this->db->query("DELETE FROM bane_db.bane_users WHERE app_id=:app_id;");
      $this->db->bind(':app_id', $app_id);
      $this->db->execute();
    }
    
    public function insertcat($cat)
    {
      $this->db->query("INSERT INTO bane_db.bane_category (`name`) VALUES (:cat)");
      $this->db->bind(':cat', $cat);
      return $this->db->execute();
    }
    
    public function insertsub($cat, $sub)
    {
      $this->db->query("SELECT subcategory FROM bane_db.bane_category WHERE name = :cat;");
      $this->db->bind(':cat', $cat);
      $subactegories = $this->db->resultSet();
      $json = json_decode($subactegories[0]->subcategory);
      $json->$sub = "";
      $json_en = json_encode($json);      
      $this->db->query("UPDATE bane_db.bane_category SET `subcategory`=:sub WHERE `name`=:cat");
      $this->db->bind(':sub', $json_en);
      $this->db->bind(':cat', $cat);
      return $this->db->execute();
    }
    
    public function isAdmin($app_id)
    {
      if(isset($app_id)){
        $this->db->query('SELECT privlige FROM bane_db.bane_users WHERE app_id = :app_id');
        $this->db->bind(':app_id', $app_id);
      
        $res = $this->db->single();
        return $res;
      }else{
        return 0;
      }
    }
  }
