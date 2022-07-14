<?php
namespace App\Repository; 

use App\System\DatabaseConnector;

class AppRepository {

    private $db;

    public function __construct()
    {
        $this->db = (new DatabaseConnector())->getConnection();
    }

    // query execution to delete all data stored in db
    public function deleteData()
    {
        $statement = 'SHOW TABLES';

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            while ($row = $statement->fetchAll(\PDO::FETCH_ASSOC)) {
                var_dump($row);
                foreach($row as $table) {
                    $this->db->prepare("DELETE from ". $table['Tables_in_shift_app'])->execute();
                }
            }
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
}