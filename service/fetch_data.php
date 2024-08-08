<?php
require_once './../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $sql = "SELECT * FROM `tbl_user`";
        $query = DB::query($sql);

        if (!empty($query) && is_array($query)) {
            // นับจำนวนคอลัมน์ในแถวแรก
            $columnCount = count($query);
            Response::success(array(
                "results" => $query,
                "success" => true,
                "count" => $columnCount
            ));
        } else {
            Response::error(array(
                "message" => "No results found or query failed.",
                "success" => false
            ));
        }
    } catch (\Throwable $e) {
        Response::error(array(
            "message" => $e->getMessage(),
            "success" => false
        ), 500);
    }
} else {
    Response::error('REQUEST METHOD ERROR GET', 500);
}
