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
      $limit = 50;
      $minlengt = 3;

      $no = $_POST['no'];
      $no = strtoupper(trim($no));
      $na = $_POST['na'];
      $na = strtoupper(trim($na));

      if (strlen($no) >= $minlengt && strlen($na) >= $minlengt) {
         $data = $this->db(0)->get_where("rac_data", "UPPER(hp) LIKE UPPER('%" . $no . "%') AND UPPER(nama) LIKE '%" . $na . "%' LIMIT " . $limit);
      } elseif (strlen($no) >= $minlengt && strlen($na) < $minlengt) {
         $data = $this->db(0)->get_where("rac_data", "UPPER(hp) LIKE UPPER('%" . $no . "%') LIMIT " . $limit);
      } elseif (strlen($no) < $minlengt && strlen($na) >= $minlengt) {
         $data = $this->db(0)->get_where("rac_data", "UPPER(nama) LIKE UPPER('%" . $na . "%') LIMIT " . $limit);
      }
      $this->view($viewData, $data);
   }
}
