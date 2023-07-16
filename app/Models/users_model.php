<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_model extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone',
        'level',
        'token',
        'grade',
        'image_access',
    ];
    protected $table="users";
    static public function detect_exist_account_with_phone($phone){
        return self::where('phone',$phone)->exists();
    }
    static public function find_user_with_token($token){
        return self::where('token',$token)->get();
    }
}
