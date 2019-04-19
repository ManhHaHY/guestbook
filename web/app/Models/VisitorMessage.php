<?php
namespace App\Models;

use \PDO;

class VisitorMessage
{

    static private $_instance = NULL;

    protected $id;

    protected $slug;

    static function getInstance() {
        if (self::$_instance == NULL) {
            self::$_instance = new VisitorMessage();
        }
        return self::$_instance;
    }
    
    /**
     * Create a new VisitorMessage Instance
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
    public function getMessages($page = 1, $items = 6)
    {
        try {
            $results = $this->db->prepare("SELECT * FROM visitor_message order by id limit $page, $items");
            $results->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countPagenumber()
    {
        try {
            $results = $this->db->prepare("SELECT id FROM visitor_message");
            $results->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $results->rowCount();
    }

    /**
     * Create new page
     *
     * @param array $data information to create page with
     *
     * @return null
     */
    public function create(array $data)
    {
        try {
            // insert data to databse
            $sql = $this->db->prepare(
                "INSERT INTO visitor_message (message, visitor_name, created_at) 
                 VALUES (:message, :visitor_name, :created_at)"
            );
            $sql->bindParam(':message', $data['message']);
            $sql->bindParam(':visitor_name', $data['visitorName']);
            $sql->bindParam(':created_at', date('Y-m-d G:i:s'));
            $sql->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function delete($id)
    {
        try{
            $sql = $this->db->prepare("DELETE FROM visitor_message WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
