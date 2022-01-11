<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class SurveyModel extends Model{

    protected $table = 'surveys';
    
    protected $allowedFields = [
        'title',
        'question',
        'answer',
        'createdat'
    ];

}