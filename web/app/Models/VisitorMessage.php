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
     * Get all messages
     *
     * @param string $page to look up in database
     * @param int $items to look up in database
     *
     * @return array Returns the messages as an associative array
     */
    public function getMessages($page = 1, $items = 6)
    {
        try {
            $results = $this->db->prepare("SELECT * FROM visitor_message order by id desc limit $page, $items");
            $results->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get message by id
     *
     * @param int $id to look up in database
     *
     * @return array Returns the message as an associative array
     */
    public function getMessage($id)
    {
        try {
            $result = $this->db->prepare("SELECT * FROM visitor_message where id = :id  LIMIT 1");
            $result->bindParam(':id', $id);
            $result->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $result->fetch(PDO::FETCH_ASSOC);
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
     * Create new message
     *
     * @param array $data information to create message with
     *
     * @return int lastInsertId
     */
    public function create(array $data)
    {
        try {
            // insert data to databse
            $sql = $this->db->prepare(
                "INSERT INTO visitor_message (message, visitor_name, created_at) 
                 VALUES (:message, :visitor_name, now())"
            );
            $sql->bindParam(':message', $data['message']);
            $sql->bindParam(':visitor_name', $data['visitorName']);
            $sql->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
        $lastId = $this->db->lastInsertId();
        return $lastId;
    }

    public function update($id, array $data)
    {
        try {
            // update data to databse
            $sql = $this->db->prepare(
                "UPDATE visitor_message SET message=:message, visitor_name=:visitor_name WHERE id=:id"
            );
            $sql->bindParam(':id', $id);
            $sql->bindParam(':message', $data['message']);
            $sql->bindParam(':visitor_name', $data['visitor_name']);
            $sql->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
        return true;
    }

    /**
    * function remove an message by id
    *
    * @param int $id
    */
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
