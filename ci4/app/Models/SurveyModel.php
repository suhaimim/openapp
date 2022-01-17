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

    public function getSurveys()
    {
        return $this->db->table("surveys")
                        ->join('titles', 'surveys.title = titles.id')
                        ->get()->getResultArray();
    }


}