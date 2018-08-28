<?php

class Index extends Controller
{
  public function __construct(){
    $this->smarty('index');
  }
  
  public function index(){
    $this->smarty('index/index');
  }
}
