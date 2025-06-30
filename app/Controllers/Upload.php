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
      $upStatus = "Error Function";
      $succCount = 0;
      $failedCount = 0;
      $skipCount = 0;
      $updateCount = 0;
      $list_updated = "";
      $list_skipped = "";
      $list_failed = "";
      $msg = $upStatus . " - [" . $succCount . "] OK, [" . $succCount . "] Failed.";
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $hp = $line[0];
               if (strlen($hp) > 0) {
                  $nama = $line[1];
                  $update = "nama = '" . $nama . "'";
                  $vals =  "'" . $hp . "','" . $nama . "'";

                  $query = $this->db(0)->insert('rac_data', $vals, $update);
                  if ($query['errno'] == 0) {
                     $succCount++;
                  } else {
                     $failedCount++;
                     $list_failed = $list_failed . "[" . $hp . "] " . $query['error'];
                  }
               }
            }
            fclose($csvFile);
            $upStatus = 'Import Complete!<hr>';
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "[" . $succCount . "] Success,<hr> 
      [" . $updateCount . "] Updated,<br>" . $list_updated . "<hr>
      [" . $skipCount . "] Skipped,<br>" . $list_skipped . "<hr>
      [" . $failedCount . "] Failed.<br>" . $list_failed;
      echo $msg;
   }
}
