<?php
/**
 *
 */
class DBconnect
{
    private static $host = 'localhost';
    private static $dbName = 'youtubeTest';
    private static $user = 'root';
    private static $password = 'root';

    public function connect(){
        try {
            $host = self::$host;
                        $db = self::$dbName;
                        $user = self::$user;
                        $pass = self::$password;
                        $conn = new PDO("mysql:host=$host;dbname=$db", $user,$pass);
                     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        }
         catch (PDOException $e) {
            echo "DB error". $e->getMessage();
        }
}

}



 ?>
