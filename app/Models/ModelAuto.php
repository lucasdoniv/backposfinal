<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAuto extends Model
{
    protected $primaryKey = 'id_model'; 

    protected $fillable = ['name_model','id_brand'];
}
