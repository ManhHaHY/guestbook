<?php
namespace App\Models;

use \PDO;

class Admin
{
    protected $id;

    protected $slug;
    
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
            $results = $this->db->prepare("SELECT * FROM admin WHERE email = ? and password = ?");
            $results->bindParam(1, $email);
            $results->bindParam(2, $password);
            $results->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        $page = $results->fetch(PDO::FETCH_ASSOC);

        return $page;
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
