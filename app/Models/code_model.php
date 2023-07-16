<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class code_model extends Model
{
    use HasFactory;
    protected $fillable =[
        'phone',
        'code',
        'time',
    ];
    public $timestamps=false;
    protected $table='code';
}
