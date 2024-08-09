<?php 
require_once './../config/connect.php';

if($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $sql = "SELECT * FROM tbl_checkin ";
        $query = DB::query($sql);

        if (!empty($query)) {
            Response::success($query, 200);
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

?>