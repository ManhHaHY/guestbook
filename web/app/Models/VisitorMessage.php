<?php
namespace App\Models;

use \PDO;

class VisitorMessage
{
    protected $id;

    protected $slug;
    
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
    public function getMessages($page = 1, $limit = 6)
    {
        try {
            $results = $this->db->prepare("SELECT * FROM visitor_message limit $limit");
            //$results->bindParam(1, $limit);
            $results->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        return $results->fetchAll(PDO::FETCH_ASSOC);
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
            $sql = $this->db->prepare(
                "INSERT INTO PAGES (title, slug, description, content) 
                 VALUES (:title, :slug, :description, :content)"
            );
            $sql->bindParam(':title', $data['title']);
            $sql->bindParam(':slug', $data['slug']);
            $sql->bindParam(':description', $data['description']);
            $sql->bindParam(':content', $data['content']);
            $sql->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
