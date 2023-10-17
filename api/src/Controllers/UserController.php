<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Property;
use App\Models\User;

class UserController extends Controller
{
    private User $userModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->userModel = new User($this->db);
    }
}
