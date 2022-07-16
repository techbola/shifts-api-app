<?php 

namespace App\Lib;

class Request
{
    public $params;
    public $query_params;
    public $reqMethod;
    public $contentType;

    public function __construct($params = [], $query_params = [])
    {
        $this->params = $params;
        $this->query_params = $query_params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    public function getBody()
    {
        if ($this->reqMethod !== 'POST') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    // get the data that was sent in the request
    public function getJSON()
    {
        if ($this->reqMethod !== 'POST') {
            return [];
        }

        if (strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }

        // Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content);

        return $decoded;
    }
}