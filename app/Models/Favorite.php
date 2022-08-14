<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $primaryKey = "id_favorite"; 

    protected $table = "favorite";
    protected $fillable = ['id_car','id_user'];
}
