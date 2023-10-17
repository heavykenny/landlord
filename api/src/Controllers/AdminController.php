<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    private Admin $adminModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->adminModel = new Admin($this->db);
    }
}