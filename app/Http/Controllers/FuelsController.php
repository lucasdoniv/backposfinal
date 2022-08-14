<?php

namespace App\Http\Controllers;
use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelsController extends Controller
{
    public function getFuels(){
        return Fuel::orderBy('name_fuel', 'ASC')->get();
    }
}
