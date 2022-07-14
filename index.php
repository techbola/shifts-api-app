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
Router::get('/api/shifts', function () {
    $shiftController = new ShiftController();
    $shiftController->index();
});

// route to create shift
Router::post('/api/shifts', function () {
    $shiftController = new ShiftController();
    $shiftController->store();
});

// route to get single shift
// regex inside () is used to udentify params  
Router::get('/api/shifts/([0-9]*)', function (Request $request) {
    $shiftController = new ShiftController();
    $shiftController->single_shift($request->params[0]);
});

// route to delete all data stored in db
Router::delete('/api/delete/app-data', function () {
    $appController = new AppController();
    $appController->deleteData();
});

// route to get shifts for a location between start and end dates
// regex inside () is used to udentify params  
Router::get('/api/shifts/filter/location/([\w]+)/start/([\w\-+:]+)/end/([\w\-+:]+)', function (Request $request) {
    $shiftController = new ShiftController();
    $shiftController->location_shifts($request);
});