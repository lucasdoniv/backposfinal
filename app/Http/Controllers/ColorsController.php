<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function getColors(){
        return Color::orderBy('name_color', 'ASC')->get();
    }
}
