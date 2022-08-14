<?php

namespace App\Http\Controllers;
use App\Models\Plataform;
use Illuminate\Http\Request;

class PlataformsController extends Controller
{
    public function getPlataforms(){
        return Plataform::orderBy('name_plataform', 'ASC')->get();
    }
}
