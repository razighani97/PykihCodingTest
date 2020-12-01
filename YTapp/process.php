<?php
/**
 *
 */
class DBconnect
{
    private $host = 'localhost';
    private $dbName = 'youtubeTest';
    private $user = 'root';
    private $password = 'root';

    public function connect(){
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db",  $user,$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "DB error". $e->getMessage;
        }
}

}



 ?>
