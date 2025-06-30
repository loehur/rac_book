<?php

class Upload extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->operating_data();
   }

   public function index()
   {
      $layout = ['title' => 'Upload'];
      $data['ref'] = [];

      $data['order'] = [];
      $data['total'] = [];

      $this->view('layout', $layout);
      $this->view(__CLASS__ . "/main", $data);
   }

   public function cek($ref = 0)
   {
      $viewData = __CLASS__ . '/data';
      $data = [];
      $this->view($viewData, $data);
   }

   public function up_data()
   {
      $target_dir = "files/csv/";
      if (!file_exists($target_dir)) {
         mkdir($target_dir, 0777, TRUE);
      }

      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


      if ($_FILES["file"]["size"] > 10000000) {
         echo "Max 10mb";
         exit();
      }

      if ($imageFileType != "csv") {
         echo "Hanya boleh CSV";
         exit();
      }

      if (file_exists($target_file)) {
         echo "Uploaded. <span id='target'>" . $target_file . "</span>&nbsp; <span class='btn btn-success import'>Import</span>";
         exit();
      } else {
         if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "Uploaded. <span id='target'>" . $target_file . "</span>&nbsp; <span class='btn btn-success import'>Import</span>";
         } else {
            echo "Maaf terjadi kesalahan teknis";
         }
      }
   }

   function import()
   {
      $p = $_POST;
      $path = $p['path'];

      $sql = "LOAD DATA LOCAL INFILE '$path'
		INTO TABLE rac_data
		FIELDS TERMINATED BY ','
		ESCAPED BY '\'
		IGNORE 1 LINES";

      $load = $this->db(0)->query($sql);
      if ($load['errno'] == 0) {
         echo "IMPORT SUCCESS";
      } else {
         echo $load['error'];
      }
   }
}
