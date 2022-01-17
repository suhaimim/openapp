<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyApp extends Model
{
    use HasFactory;

    public $table = 'myapps';

     protected $fillable = [
        'user_id',
        'name',
        'description',
    ];   

    public function user(){
        return $this->belongsTo('App\Models\User');
    }    
        
        
}
