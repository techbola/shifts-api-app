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
    }

    // Get all shifts data
    public function index()
    { 
        $shifts = $this->shiftRepository->findAll();
        return (new Response)->toJSON($shifts);
    }

    // Get single shift data
    public function single_shift($id)
    { 
        $shift = $this->shiftRepository->find($id);
        if ($shift) {
            return (new Response)->toJSON($shift);
        } else {
            return (new Response)->status(404)->toJSON(['error' => "Not Found"]);
        }
    }

    // store a shift record in db
    public function store()
    {
        $requestData = (new Request)->getJSON();

        if (count($requestData) > 0) {
            $allShifts = [];
            foreach ($requestData as $data) {
                // validate request data
                if (!isset($data->type) || empty($data->type)) {
                    return (new Response)->status(400)->toJSON(['error' => "Type field is required"]);
                }
                if (!isset($data->start) || empty($data->start)) {
                    return (new Response)->status(400)->toJSON(['error' => "Start field is required"]);
                }
                if (!isset($data->end) || empty($data->end)) {
                    return (new Response)->status(400)->toJSON(['error' => "End field is required"]);
                }
                if (!isset($data->location_id) || empty($data->location_id) || !is_int($data->location_id)) {
                    return (new Response)->status(400)->toJSON(['error' => "Location field is required and has type integer"]);
                }
                if (!isset($data->user_id) || empty($data->user_id) || !is_int($data->user_id)) {
                    return (new Response)->status(400)->toJSON(['error' => "User field is required and has type integer"]);
                }

                $shift = $this->shiftRepository->insert((array) $data);
                array_push($allShifts, $shift);
            }

            if (count($allShifts) > 0) {
                return (new Response)->status(201)->toJSON($allShifts);
            } else {
                return (new Response)->status(200)->toJSON("No data available");
            }

        } else {
            return (new Response)->status(400)->toJSON(['error' => "No request data provided"]);
        }
        
    }

    // get shifts for a location between start and end dates
    public function location_shifts($request)
    { 
        // get location, start, and end query params
        $location = $request->params[0];
        $start = $request->params[1];
        $end = $request->params[2];

        if (!isset($location)) {
            return (new Response)->status(400)->toJSON(['error' => "Location field is required"]);
        }
        if (!isset($start)) {
            return (new Response)->status(400)->toJSON(['error' => "Start field is required"]);
        }
        if (!isset($end)) {
            return (new Response)->status(400)->toJSON(['error' => "End field is required"]);
        }

        $shifts = $this->shiftRepository->getShiftsByLocation($location, $start, $end);
        return (new Response)->status(200)->toJSON($shifts);
    }

}