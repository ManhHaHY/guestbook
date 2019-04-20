<?php
namespace App\Models;

use \PDO;

class Admin
{
    static private $_instance = NULL;

    protected $id;

    protected $slug;

    static function getInstance() {
        if (self::$_instance == NULL) {
            self::$_instance = new Admin();
        }
        return self::$_instance;
    }
    
    /**
     * Create a new Admin Instance
     */
    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, 'PDO::ERRMODE_EXCEPTION');
        } catch (\Exception $e) {
            echo "DB Error";
            die();
        }
    }

    /**
     * Get page by slug
     *
     * @param string $slug to look up in database
     *
     * @return array Returns the page as an associative array
     */
    public function checkAuthentication($email, $password)
    {
        try {
            $result = $this->db->prepare("SELECT * FROM admin WHERE email = ? and password = ?");
            $result->bindParam(1, $email);
            $result->bindParam(2, $password);
            $result->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $result->fetch(PDO::FETCH_ASSOC);
    }

}
