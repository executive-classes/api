<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\EmployeePosition\EmployeePositionCollection;
use App\Models\Billing\EmployeePosition;

class EmployeePositionController extends Controller
{
    public function index()
    {
        return new EmployeePositionCollection(EmployeePosition::all());
    }
}