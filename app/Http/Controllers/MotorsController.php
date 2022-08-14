<?php

namespace App\Http\Controllers;
use App\Models\Motor;
use Illuminate\Http\Request;

class MotorsController extends Controller
{
    public function getMotors(){
        return Motor::orderBy('name_motor', 'ASC')->get();
    }
}
