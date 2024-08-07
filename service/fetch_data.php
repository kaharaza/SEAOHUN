<?php 
    require_once './../config/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
           
            $sql = "SELECT * FROM `tbl_user`";
            $query = DB::query($sql);
            Response::success($query, 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    } else {
        Response::error('REQUEST METHOD ERROR GET', 500);
    }
?>