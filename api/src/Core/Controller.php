<?php

namespace App\Core;

use PDO;

class Controller
{
    protected PDO $db;
    
    public function __construct($config)
    {
        $this->connectDatabase($config);
    }

    protected function connectDatabase($config)
    {
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
        $options = $config['options'];
        $this->db = new PDO($dsn, $config['username'], $config['password'], $options);
    }
}
