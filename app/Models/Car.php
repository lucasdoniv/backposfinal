<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'id_car'; 
    protected $table = "car";
    protected $fillable = [
    'id_model',
    'id_plataform',
    'url_car',
    'price',
    'km',
    'year',
    'id_color',
    'id_fuel',
    'id_motor',
    'url_picture'];
}
