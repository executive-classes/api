<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\EmployeePosition\EmployeePositionCollection;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;

class EmployeePositionController extends Controller
{
    public function index()
    {
        return new EmployeePositionCollection(EmployeePosition::all());
    }
}