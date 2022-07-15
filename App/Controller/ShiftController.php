<?php 

namespace App\Controller;

use App\Lib\Request;
use App\Lib\Response;
use App\Repository\ShiftRepository;

class ShiftController
{

    private $shiftRepository;

    public function __construct()
    {
        $this->shiftRepository = new ShiftRepository();
        $this->request = new Request();
        $this->response = new Response();
    }

    // Get all shifts data
    public function index($limit, $page)
    { 
        $shifts = $this->shiftRepository->findAll($limit, $page);
        return $this->response->toJSON($shifts);
    }

    // Get single shift data
    public function single_shift($id)
    { 
        $shift = $this->shiftRepository->find($id);
        if ($shift) {
            return $this->response->toJSON($shift);
        } else {
            return $this->response->status(404)->toJSON(['error' => "Not Found"]);
        }
    }

    // store a shift record in db
    public function store()
    {
        $requestData = $this->request->getJSON();

        if (count($requestData) > 0) {
            $allShifts = [];
            foreach ($requestData as $data) {
                // validate request data
                if (!isset($data->type) || empty($data->type)) {
                    return $this->response->status(400)->toJSON(['error' => "Type field is required"]);
                }
                if (!isset($data->start) || empty($data->start)) {
                    return $this->response->status(400)->toJSON(['error' => "Start field is required"]);
                }
                if (!isset($data->end) || empty($data->end)) {
                    return $this->response->status(400)->toJSON(['error' => "End field is required"]);
                }
                if (!isset($data->location_id) || empty($data->location_id) || !is_int($data->location_id)) {
                    return $this->response->status(400)->toJSON(['error' => "Location field is required and has type integer"]);
                }
                if (!isset($data->user_id) || empty($data->user_id) || !is_int($data->user_id)) {
                    return $this->response->status(400)->toJSON(['error' => "User field is required and has type integer"]);
                }

                $shift = $this->shiftRepository->insert((array) $data);
                array_push($allShifts, $shift);
            }

            if (count($allShifts) > 0) {
                return $this->response->status(201)->toJSON([
                    'message' => 'Shift created successfully',
                    'data' => $allShifts
                ]);
            } else {
                return $this->response->status(200)->toJSON("No data available");
            }

        } else {
            return $this->response->status(400)->toJSON(['error' => "No request data provided"]);
        }
        
    }

    // get shifts for a location between start and end dates
    public function location_shifts($location, $start, $end, $limit, $page)
    { 

        if (!$location) {
            return $this->response->status(400)->toJSON(['error' => "Location field is required"]);
        }
        if (!$start) {
            return $this->response->status(400)->toJSON(['error' => "Start field is required"]);
        }
        if (!$end) {
            return $this->response->status(400)->toJSON(['error' => "End field is required"]);
        }

        $shifts = $this->shiftRepository->getShiftsByLocation($location, $start, $end, $limit, $page);
        return $this->response->status(200)->toJSON($shifts);
    }

}