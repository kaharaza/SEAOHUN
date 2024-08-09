<?php
require_once './../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        $fname = $_POST['payload']['fname'];
        $lname = $_POST['payload']['lname'];
        $checkDate = Date('Y-m-d');
        $time = Date('H:m:s');
        $fullname = $fname . ' ' . $lname;

        $sql = "SELECT * FROM tbl_checkin WHERE `name` = ? AND `date` = ?";
        $params = array($fullname, $checkDate);
        $query = DB::query($sql, $params);

        if (!empty($query)) {
            Response::error('fail', 405);
        } else {
            // 
            $sql_search = "SELECT * FROM `tbl_name` WHERE fname = ? AND lname = ?";
            $params_search = array($fname, $lname);
            $query_search = DB::query($sql_search, $params_search);


            if ($query_search[0]['status'] === "TRUE") {
                $user = $query_search[0];

                // Insert new data into tbl_checkin
                $sql_insert = "INSERT INTO `tbl_checkin`(`name`, `email`, `date`, `time`, `esigin`) 
                       VALUES (?, ?, ?, ?, ?)";
                $params_insert = array(
                    $fullname,
                    $user['email'],
                    $checkDate,
                    $time,
                    $fullname
                );
                $query_insert = DB::query($sql_insert, $params_insert);

                if (!empty($query_insert)) {
                    return Response::success($user['id'], 200);
                }
            } else if ($query_search[0]['status'] === "FALSE")  {
                return Response::error(array(
                    "message" => 'Status false',
                    "success" => false
                ), 405);
            } else {
                return Response::error(array(
                    "message" => 'Not found',
                    "success" => false
                ), 404);
            }
        }
    } catch (\Throwable $e) {
        Response::error(array(
            "message" => $e->getMessage(),
            "success" => false
        ), 500);
    }
} else {
    Response::error('REQUEST METHOD ERROR POST', 500);
}
