<?php
namespace App\Repository; 

use App\System\DatabaseConnector;

class ShiftRepository {

    private $db;
    private $table = 'shifts';

    public function __construct()
    {
        $this->db = (new DatabaseConnector())->getConnection();
    }

    // query execution to get all shift data
    public function findAll()
    {
        $statement = "SELECT
            s.id,
            s.type,
            s.start,
            s.end,
            u.name as user_name,
            u.email as user_email,
            l.name as location,
            JSON_OBJECT('name', e.name, 'start', e.start, 'end', e.end) as event,
            e.name as event_name,
            s.event_id,
            s.rate,
            s.charge,
            s.area
            FROM
            " .$this->table . " s 
            LEFT JOIN 
                users u ON s.user_id = u.id
            LEFT JOIN 
                locations l ON s.location_id = l.id
            LEFT JOIN 
                events e ON s.event_id = e.id
            ORDER BY s.created_at DESC";

        try {
            $statement = $this->db->query($statement);
            $result = [];
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {

                // decode json string for shift event(it is json encoded)
                $row['event'] = json_decode($row['event'], true );
                $row['departments'] = [];

                // format start and end dates
                $row['start'] = $this->formatDateTime($row['start']);
                $row['end'] = $this->formatDateTime($row['end']);
        
                //get shift departments
                $departments = $this->getShiftDepartments($row['id']);
                if (count($departments) > 0) {
                    foreach ($departments as $department) {
                        array_push($row['departments'], $department['name']);
                    }
                }

                array_push($result, $row);
            }

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    
    // query execution to get single shift data
    public function find($id)
    {
        $statement = 'SELECT
            s.id,
            s.type,
            s.start,
            s.end,
            u.name as user_name,
            u.email as user_email,
            l.name as location,
            s.event_id,
            s.rate,
            s.charge,
            s.area
            FROM
            ' .$this->table . ' s 
            LEFT JOIN 
                users u ON s.user_id = u.id
            LEFT JOIN 
                locations l ON s.location_id = l.id
            WHERE s.id = ? LIMIT 1';

        try {
            $statement = $this->db->prepare($statement);
            //binding param
            $statement->bindParam(1, $id);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            $row['departments'] = [];

            // format start and end dates
            $row['start'] = $this->formatDateTime($row['start']);
            $row['end'] = $this->formatDateTime($row['end']);
        
            //get shift departments
            $departments = $this->getShiftDepartments($row['id']);
            if (count($departments) > 0) {
                foreach ($departments as $department) {
                    array_push($row['departments'], $department['name']);
                }
            }

            return $row;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    // query execution to create new shift data
    public function insert(Array $input)
    {
        $data = array(
            'type' => $input['type'],
            'start'  => $input['start'],
            'end'  => $input['end'],
            'rate'  => $input['rate'],
            'charge'  => $input['charge'],
            'area'  => $input['area'],
            'created_at'  => date('Y-m-d H:i:s'),
            'user_id' => $input['user_id'],
            'location_id' => $input['location_id'],
            'event_id' => $input['event_id'],
            'created_at' => date('Y-m-d H:i:s')
        );

        $statement = 'INSERT INTO ' . $this->table . ' 
            (type, start, end, rate, charge, area, created_at, user_id, location_id, event_id)
            VALUES
            (:type, :start, :end, :rate, :charge, :area, :created_at, :user_id, :location_id, :event_id)';

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute($data);
            $shiftId = $this->db->lastInsertId();
            if ($statement->rowCount()) {
                $departments = $input['departments'];
                //store department and shift
                $this->storeShiftDepartments($departments, $shiftId);
                return $this->find($shiftId);
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    // query execution to create departments for a shift
    public function storeShiftDepartments($departments, $shiftId) {
        $statement = "INSERT INTO department_shift (department_id, shift_id, created_at) VALUES (:department_id, :shift_id, :created_at)";

        try {
            $statement = $this->db->prepare($statement);
            foreach ($departments as $department) {
                $data = array(
                    'department_id' => $department,
                    'shift_id'  => $shiftId,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $statement->execute($data);
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    // query execution to get departments that belongs to a shift
    public function getShiftDepartments($shiftId)
    {
        $statement = 'SELECT 
            d.name FROM department_shift ds 
            INNER JOIN departments d ON ds.department_id = d.id 
            WHERE ds.shift_id = ?';

        try {
            $statement = $this->db->prepare($statement);
            //binding param
            $statement->bindParam(1, $shiftId);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    // query execution to get shifts for a location between start and end dates
    public function getShiftsByLocation($location, $startDate, $endDate)
    {
        $allShifts = $this->findAll();

        $filteredShifts = [];

        foreach($allShifts as $shift) {

            if ($shift['location'] === $location && date($shift['start']) >= date($startDate) && date($shift['end']) <= date($endDate)) {
                array_push($filteredShifts, $shift);
            }
        }

        return $filteredShifts;  
    }

    // format datetime to ISO 8601 date
    public function formatDateTime($datetime) {
        return date_format(date_create($datetime), 'c');;
    }
}