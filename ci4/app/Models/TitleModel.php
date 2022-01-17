<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class TitleModel extends Model{

    protected $table = 'titles';
    
    protected $allowedFields = [
        'name'
    ];


    public function getTitles()
    {
        # code...
    }


}