<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function getBrands(){
        return Brand::orderBy('name_brand', 'ASC')->get();
    }
}
