<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = [
        'menu_name','type','status ','icon','parent', 'menu_type', 'url','created_at','updated_at'
    ];
    
}
