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

   public function cek()
   {
      $viewData = __CLASS__ . '/data';
      $data = [];

      $no = $_POST['no'];
      $no = strtoupper(trim($no));
      $na = $_POST['na'];
      $na = strtoupper(trim($na));

      if (strlen($no) > 0 && strlen($na) > 0) {
         $data = $this->db(0)->get_where_row("rac_data", "UPPER(hp) LIKE UPPER('%" . $no . "%') AND UPPER(nama) LIKE '%" . $na . "%' LIMIT 1");
      } elseif (strlen($no) > 0 && strlen($na) == 0) {
         $data = $this->db(0)->get_where_row("rac_data", "UPPER(hp) LIKE UPPER('%" . $no . "%') LIMIT 1");
      } else {
         $data = $this->db(0)->get_where_row("rac_data", "UPPER(nama) LIKE UPPER('%" . $na . "%') LIMIT 1");
      }
      $this->view($viewData, $data);
   }
}
