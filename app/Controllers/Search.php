<?php

class Search extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->operating_data();
   }

   public function index()
   {
      $layout = ['title' => 'Search'];
      $data['ref'] = [];

      $data['order'] = [];
      $data['total'] = [];

      $this->view('layout', $layout);
      $this->view(__CLASS__ . "/main", $data);
   }

   public function cek($se = "")
   {
      $viewData = __CLASS__ . '/data';
      $data = [];
      $se = trim($se);
      $data = $this->db(0)->get_where_row("rac_data", "UPPER(hp) LIKE UPPER('%" . $se . "%') OR nama LIKE '%" . $se . "%' LIMIT 1");
      $this->view($viewData, $data);
   }
}
