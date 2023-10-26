<?php

namespace App\Core;

use PDO;

class Controller
{
    protected PDO $db;
    protected $request;

    public function __construct($config)
    {
        $this->connectDatabase($config);
        $this->request = json_decode(file_get_contents("php://input"), true);

        // log to file
        $log = date("Y-m-d H:i:s") . " " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'] . " " . json_encode($this->request) . "\n";
        file_put_contents(__DIR__ . "/api.log", $log, FILE_APPEND);
    }

    protected function connectDatabase($config)
    {
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
        $options = $config['options'];
        $this->db = new PDO($dsn, $config['username'], $config['password'], $options);
    }
}
