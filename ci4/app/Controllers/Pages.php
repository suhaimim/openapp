<?php

namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\TitleModel;
use App\Models\SurveyModel;
use App\Models\ResultModel;

<<<<<<< HEAD
use function PHPUnit\Framework\isEmpty;

=======
>>>>>>> master
class Pages extends Controller
{
    private $db;
    protected $surveyModel, $titleModel, $resultModel;

    public function __construct()
    {
        $this->surveyModel  = new SurveyModel();
        $this->titleModel   = new TitleModel();
        $this->resultModel  = new ResultModel();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }


    public function surveyForm()
    {
        $data['joinSurveyTitle'] = $this->surveyModel->getSurveys();
        $data['titles'] = $this->titleModel->orderBy('id', 'ASC')->findAll();
        $data['surveys'] = $this->surveyModel->orderBy('id', 'ASC')->findAll();
        return view('surveyForm',$data);
    }  
    public function addTitle()
    {
            $data = [
                'name'   => $this->request->getPost('tn1'),
            ];
            $this->titleModel->save($data);
            return redirect()->to('pages/surveyForm');        
    }
    public function addSurvey()
    {
            $data = [
                'title'     => $this->request->getPost('st1'),
                'question'  => $this->request->getPost('sq1'),
                'answer'    => $this->request->getPost('sa1'),
                'createdat' => date('U')
            ];
            $this->surveyModel->save($data);
            return redirect()->to('pages/surveyForm');        
    }
    public function addResult()
    {
        $dataTitles     = $this->titleModel->orderBy('id', 'ASC')->findAll();
        $dataSurveys    = $this->surveyModel->orderBy('id', 'ASC')->findAll();

        foreach($dataTitles as $titleNo){
            $iT = 1;
            foreach($dataSurveys as $surveyNo){
                $iS = 1;
                // Table Surveys, Column Title is saving Table Titles Id
                if($surveyNo['title'] == $titleNo['id']){
<<<<<<< HEAD
                    $optionNameRadio = "ansOpt-t".$titleNo['id']."s".$surveyNo['id'];
                    $optionNameCheck = $titleNo['id']."s".$surveyNo['id']."[]";
                    if($this->request->getPost('optNameRadio') == $optionNameRadio){
                        $optionValue = $this->request->getPost($optionNameRadio);
                    }elseif($this->request->getPost('optNameCheck') == $optionNameCheck){
                        $valueArray = $this->request->getPost($optionNameCheck);
                        $optionValue = implode(',', $valueArray);
                    }else{
                        // 999 is representing Other input option with below answer into answer_other column
                        $optionValue = 999; 
                        $otherOptionRadio = $this->request->getPost('ansOptOtherRadio');
                        $otherOptionCheck = $this->request->getPost('ansOptOtherCheck');
                        if(isEmpty($otherOptionRadio)){
                            $otherOption = $otherOptionCheck;
                        }
                        if(isEmpty($otherOptionCheck)){
                            $otherOption = $otherOptionRadio;
                        }
                    }
                }
            }
            $data = [
                'title_no'      => $this->request->getPost('titleNo'),
                'question_no'   => $this->request->getPost('surveyNo'),
                'answer_no'     => $optionValue,
                'answer_other'  => $otherOption,
                'created_at'    => date('U')
            ];
            $this->resultModel->save($data);
        }
=======
                    $optionName = "ansOpt-t".$titleNo['id']."s".$surveyNo['id'];
                    if($optionName == $this->request->getPost('optName')){
                        $optionValue = $this->request->getPost($optionName);
                        // $otherOption = $this->request->getPost('otherAns');
                    }else{
                        $optionValue = $this->request->getPost($optionName);
                        $otherOption = $this->request->getPost('ansOptOther');
                    };
                }
            }
        }

        $data = [
            'title_no'      => $this->request->getPost('titleNo'),
            'question_no'   => $this->request->getPost('surveyNo'),
            'answer_no'     => $optionValue,
            'answer_other'  => $otherOption,
            'created_at'    => date('U')
        ];
        $this->resultModel->save($data);
>>>>>>> master
        return redirect()->to('pages/surveyForm');        
    }
    public function editTitle($id) {
        $dataEdit = [
            'name'   => $this->request->getPost('titleNAME'),
        ];
        $this->titleModel->update($id, $dataEdit);
        return redirect()->to('pages/surveyForm'); 
    }    
    public function editSurvey($id) {
        $dataEdit = [
            'title'   => $this->request->getPost('surveyTITLE'),
            'question'  => $this->request->getPost('surveyQUESTION'),
            'answer'    => $this->request->getPost('surveyANSWER'),
        ];
        $this->surveyModel->update($id, $dataEdit);
        return redirect()->to('pages/surveyForm'); 
    }    
   
    public function deleteTitle($id) {
        $this->titleModel->where('id', $id)->delete($id);
        return redirect()->to('pages/surveyForm'); 
    }    
    public function deleteSurvey($id) {
        $this->surveyModel->where('id', $id)->delete($id);
        return redirect()->to('pages/surveyForm'); 
    }    


}