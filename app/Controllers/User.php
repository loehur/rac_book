<?php

class User extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->operating_data();
   }

   public function index()
   {
      $layout = ['title' => "User"];
      $where = "en = 1";
      $data = $this->db(0)->get_where("user", $where);
      $this->view('layout', $layout);
      $this->view(__CLASS__ . "/main", $data);
   }

   function insert() {}

   function updateCell() {}
}
