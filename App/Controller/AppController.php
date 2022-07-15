<?php 

namespace App\Controller;

use App\Lib\Request;
use App\Lib\Response;
use App\Repository\AppRepository;

class AppController
{

    private $appRepository;

    public function __construct()
    {
        $this->appRepository = new AppRepository();
        $this->request = new Request();
        $this->response = new Response();
    }

    // delete all data stored in db
    public function deleteData()
    { 
        if ($this->appRepository->deleteData()) {
            return $this->response->status(200)->toJSON(['message' => "App Data Deleted"]);
        } else {
            return $this->response->status(400)->toJSON(['error' => "Something went wrong"]);
        }
    }
}