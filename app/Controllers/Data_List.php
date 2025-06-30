<?php

class Data_List extends Controller
{
   public function __construct()
   {
      $this->operating_data();
   }

   public function insert($page)
   {
      $table  = $page;
      switch ($page) {
         case "user":
            $this->session_cek(1);
            $privilege = $_POST['f4'];
            if ($privilege == 100) {
               exit();
            }
            $cols = 'username, no_user, nama_user, id_privilege';
            $no_user = $_POST['f5'];
            $username = $this->model("Enc")->username($no_user);
            $vals = "'" . $username . "','" . $no_user . "','" . $_POST['f1'] . "'," . $privilege;
            $do = $this->db(0)->insertCols($table, $cols, $vals);
            if ($do['errno'] == 0) {
               echo 0;
            } else {
               echo $do['error'];
            }
            break;
      }
   }

   public function updateCell($page)
   {
      $table  = $page;
      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      switch ($page) {
         case "user":
            $this->session_cek(1);
            $table  = $page;
            $id = $_POST['id'];
            $value = $_POST['value'];
            $mode = $_POST['mode'];

            switch ($mode) {
               case "2":
                  $col = "nama_user";
                  break;
               case "4":
                  $col = "id_cabang";
                  break;
               case "5":
                  $col = "id_privilege";
                  break;
               case "6":
                  $col = "no_user";
                  break;
            }
            $where = "id_user = $id";
            break;
      }


      if ($page == "user" && $col == "id_privilege") {
         if ($value == 100) {
            exit();
         }
      }

      $set = $col . " = '" . $value . "'";
      $up = $this->db(0)->update($table, $set, $where);
      echo $up['errno'] == 0 ? 0 : $up['error'];

      if ($page == "user" && $col == "no_user") {
         $username = $this->model("Enc")->username($value);
         $set = "username = '" . $username . "', otp_active = ''";
         $this->db(0)->update($table, $set, $where);
      }
   }

   public function synchrone()
   {
      $this->dataSynchrone($_SESSION['resto_user']['id_user']);
   }
}
