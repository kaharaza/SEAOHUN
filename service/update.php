<?php 
require_once './../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        $data = $_POST['payload'];
      
        if (isset($data['id'])) {
            $numId = $data['id'];
            $sql = "UPDATE `tbl_user` 
                    SET `fname`= ?,`lname`= ?,`phone`= ?,`createdAt`= ? 
                    WHERE id = ? ";
            $params = array(
                Helper::clean($data['fname']),
                Helper::clean($data['lname']),
                Helper::clean($data['phone']),
                date('Y-m-d H:m:s'),
                $numId,
            );
            $query = DB::query($sql, $params);
            if (!empty($query)) {
                Response::success("Update with ID: $numId", 200);
            }
        } else {
            Response::error(array(
                "message" => $e->getMessage(),
                "success" => false
            ), 400);
        }
    } catch (\Throwable $th) {
        Response::error(array(
            "message" => $e->getMessage(),
            "success" => false
        ), 500);
    }
} else {
    Response::error('REQUEST METHOD ERROR POST', 500);
}
?>