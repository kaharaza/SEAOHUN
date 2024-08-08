<?php 
 require_once './../config/connect.php';

 if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    try {
        parse_str(file_get_contents("php://input"), $deleteData);
        // $deleteData = $_POST['id'];
        if (isset($deleteData)) {
            $numId = $deleteData['id'];

            $sql = "DELETE FROM `tbl_user` WHERE id = ?";
            $params = array($numId);
            $query = DB::query($sql, $params);

            if (!empty($query)) {
                Response::success("Deleted member with ID: $numId", 200);
            } else {
                Response::error('Failed to delete member id', 400);
            }
        } else {
            Response::error(array(
                "message" => "No id failed.",
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
    Response::error('REQUEST METHOD ERROR POST', 500);
 }
?>