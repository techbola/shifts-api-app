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
    }

    // delete all data stored in db
    public function deleteData()
    { 
        if ($this->appRepository->deleteData()) {
            return (new Response)->status(200)->toJSON(['message' => "App Data Deleted"]);
        } else {
            return (new Response)->status(400)->toJSON(['error' => "Something went wrong"]);
        }
    }
}