<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ResultModel extends Model{

    protected $table = 'results';
    
    protected $allowedFields = [
        'title_no',
        'question_no',
        'answer_no',
        'answer_other',
        'created_at'
    ];

}