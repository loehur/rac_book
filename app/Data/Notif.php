<?php

class Notif extends Controller
{
    function insertOTP($res, $today, $hp, $otp)
    {
        //SAVE DB NOTIF
        $cols =  'insertTime, no_ref, phone, text, tipe, id_api, proses';
        $status = $res['data']['status'];
        $vals =  "'" . date('Y-m-d H:i:s') . "','" . $today . "','" . $hp . "','" . $otp . "',6,'" . $res['data']['id'] . "','" . $status . "'";
        $do = $this->db(0)->insertCols('notif', $cols, $vals);
        return $do;
    }

    function cek_deliver($hp, $date)
    {
        $where = "phone = '" . $hp . "' AND no_ref = '" . $date . "' AND state NOT IN ('delivered','read') AND id_api_2 = ''";

        $cek = $this->db(0)->get_where_row('notif', $where);
        if (isset($cek['text'])) {
            return $cek;
        }
        return $cek;
    }
}
