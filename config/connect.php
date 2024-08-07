<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
header('Content-Type: application/json');


class DB
{

    private static $DB_HOST = 'localhost';
    private static $DB_USERNAME = 'root';
    private static $DB_PASSWORD = 'root';
    private static $DB_NAME = 'seahundb';


    private static $connect = null;
    private static $response = true;

    public static function connect()
    {
        try {
            self::$connect = new PDO(
                'mysql:host=' . self::$DB_HOST . ';
                                    dbname=' . self::$DB_NAME . ';
                                    charset=utf8',
                self::$DB_USERNAME,
                self::$DB_PASSWORD
            );
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // echo "Success connect Database";
            return self::$connect;
        } catch (PDOException $e) {
            echo "Database could not be connected: " . $e->getMessage();
            exit();
        }
    }
    public static function getConnection()
    {
        return self::connect();
    }
    public static function getResponse()
    {
        return self::$response;
    }
    public static function query($query = null, $params = array())
    {
        if (self::$connect instanceof PDO) {
            try {
                $statement = self::$connect->prepare($query);
                $statement->execute($params);
                $command = strtoupper(explode(' ', $query)[0]);
                if ($command === 'SELECT') {
                    self::$response = $statement->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    self::$response = $statement->rowCount();
                }
                return self::$response;
            } catch (Throwable $e) {
                http_response_code(500);
                echo "การประมวลผลข้อมูลล้มเหลว: " . $e->getMessage();
                exit();
            }
        } else {
            http_response_code(500);
            echo "โปรดเปิดการเชื่อมต่อฐานข้อมูล";
            exit();
        }
    }
}
DB::connect();


class Helper
{
    /** Method สำหรับการเช็ครูปภาพ Mime Image */
    public static function isMimeValid($tmp_name)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $tmp_name);
        if (strpos($mtype, 'image/') !== false) {
            return true;
        }
        finfo_close($finfo);
        return false;
    }

    /** clean */
    public static function clean($input)
    {
        /** เปลี่ยน predefined characters เป็น HTML entities ด้วยฟังก์ชัน htmlspecialchars() */
        $data = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}

class Response
{
    /** Method สำหรับการจัดการ Response Success */
    public static function success($response = [], $message = "success", $code = 200)
    {
        /** สร้าง array เพื่อเก็บข้อมูลการ Response */
        $response = array(
            'status' => true,
            /** กำหนด status เป็น true */
            'response' => $response,
            /** กำหนดข้อมูลที่จะตอบกลับ */
            'message' => $message
            /** กำหนดข้อความที่จะตอบกลับ */
        );
        http_response_code($code);
        /** กำหนด http status code */
        echo json_encode($response);
        /** ตอบกลับข้อมูลให้ Client */
    }

    /** Method สำหรับการจัดการ Response Error */
    public static function error($errorMessage = "error", $code = 404)
    {
        /** สร้าง array เพื่อเก็บข้อมูลการ Response */
        $response = array(
            'status' => false,
            /** กำหนด status เป็น false */
            'message' => $errorMessage
            /** กำหนดข้อความที่จะตอบกลับ */
        );
        http_response_code($code);
        /** กำหนด http status code */
        echo json_encode($response);
        /** ตอบกลับข้อมูลให้ Client */
    }
}
