<?php

namespace App\Controllers;

use App\Models\AdminActivity;

class AdminActivityController extends AdminController
{

    private $Activity;

    public function __construct()
    {
        $this->Activity = new AdminActivity();
        parent::__construct();
    }
}
