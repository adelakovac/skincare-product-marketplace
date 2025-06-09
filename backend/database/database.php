
<?php
class Database {
    private static $host = 'localhost';
    private static $db_name = 'skincare_marketplace'; 
    private static $username = 'root';       
    private static $password = '';           
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=".self::$host.";dbname=".self::$db_name.";charset=utf8",
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>
