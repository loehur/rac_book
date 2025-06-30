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
      $query = "";
      $row = 0;
      $per_query = 0;
      $msg = ['No Data'];

      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               if (!isset($line[0]) && isset($line[1])) {
                  $msg = [
                     'status' => 'error',
                     'message' => 'fields error'
                  ];
                  break;
               }

               $hp = $line[0];
               $nama = $line[1];
               $update = "nama = '" . $nama . "'";

               $row += 1;
               $per_query += 1;
               if ($per_query == 5000) {
                  $this->db(0)->query($query);
                  $query = "";
                  $per_query = 0;

                  $msg = [
                     "status" => "success",
                     "last_data" => [
                        "hp" => $hp,
                        "nama" => $nama
                     ],
                     "total_row" => $row
                  ];
               } else {
                  $query .= "INSERT INTO rac_data VALUES('$hp','$nama') ON DUPLICATE KEY UPDATE $update;";
               }
            }

            if ($per_query != 5000) {
               $this->db(0)->query($query);
               $msg = [
                  "status" => "success",
                  "last_data" => [
                     "hp" => $hp,
                     "nama" => $nama
                  ],
                  "total_row" => $row
               ];
            }
            fclose($csvFile);
         } else {
            $msg = [
               'status' => 'error',
               'message' => 'fields error'
            ];
         }
      } else {
         $msg = [
            'status' => 'error',
            'message' => 'invalid file!'
         ];
      }

      echo json_encode($msg, JSON_PRETTY_PRINT);
   }
}
