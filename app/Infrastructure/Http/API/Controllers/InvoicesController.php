<?php

namespace App\Infrastructure\Http\API\Controllers;

use Illuminate\Http\Request;
use App\Infrastructure\Controller;

class InvoicesController extends Controller {

    public function __construct() 
    {

    }

    public function index() 
    {
        return "test1";
    }
}