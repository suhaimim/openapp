<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'name',
        'description',
    ];   

    public function user(){
        return $this->belongsTo('App\Models\User');
    }    
        
    public function articles(){
        return $this->hasMany('App\Models\Article');
    }
        
}
