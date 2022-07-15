<?php

require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

// import request and router libraries
use App\Lib\Router;
use App\Lib\Request;

// import controllers to be used by routes for a specific action
use App\Controller\ShiftController;
use App\Controller\AppController;

// route to get all shifts 
Router::get('/api/shifts', function (Request $request) {
    $limit = (count($request->query_params) > 0 && isset($request->query_params['limit'])) ? $request->query_params['limit'] : 10;
    $page = count($request->query_params) > 0 && isset($request->query_params['page']) ? $request->query_params['page'] : 1;
    $shiftController = new ShiftController();
    $shiftController->index($limit, $page);
});

// route to create shift
Router::post('/api/shifts', function () {
    $shiftController = new ShiftController();
    $shiftController->store();
});

// // route to get single shift
Router::get('/api/single-shift/([0-9]*)', function (Request $request) {
    $shiftController = new ShiftController();
    // $shiftController->single_shift($request->params ? $request->params['shift_id'] : null);
    $shiftController->single_shift($request->params[0]);
});

// route to delete all data stored in db
Router::delete('/api/delete/app-data', function () {
    $appController = new AppController();
    $appController->deleteData();
});

// // route to get shifts for a location between start and end dates
Router::get('/api/filter/shifts', function (Request $request) {
    $shiftController = new ShiftController();
    $limit = (count($request->query_params) > 0 && isset($request->query_params['limit'])) ? $request->query_params['limit'] : 10;
    $page = count($request->query_params) > 0 && isset($request->query_params['page']) ? $request->query_params['page'] : 1;
    $location = count($request->query_params) > 0 && isset($request->query_params['location']) ? $request->query_params['location'] : null;
    $start = count($request->query_params) > 0 && isset($request->query_params['start']) ? $request->query_params['start'] : null;
    $end = count($request->query_params) > 0 && isset($request->query_params['end']) ? $request->query_params['end'] : null;
    $shiftController->location_shifts($location, $start, $end, $limit, $page);
});