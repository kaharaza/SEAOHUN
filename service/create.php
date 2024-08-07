<?php
require_once './../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user = $_POST['payload'];

        if ($user) {
            $sql = "INSERT INTO `tbl_user`(`fname`, `lname`, `phone`, `email`, `createdAt`) 
                VALUES (? ,? ,? ,? ,? )";
            $params = array(
                Helper::clean($user['fname']),
                Helper::clean($user['lname']),
                Helper::clean($user['phone']),
                Helper::clean($user['email']),
                DATE("Y-m-d H:m:s")
            );
            $query = DB::query($sql, $params);
            if (!empty($query)) {
                return Response::success('Success', 200);
            }
        } else {
            return Response::error('Not found', 404);
        }
    } catch (\Throwable $e) {
        Response::error($e, 500);
        return throw $e;
    }
} else {
    Response::error('REQUEST METHOD ERROR POST', 500);
}
