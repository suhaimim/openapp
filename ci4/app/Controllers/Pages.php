<?php

namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\TitleModel;
use App\Models\SurveyModel;
use App\Models\ResultModel;

class Pages extends Controller
{
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
        $surveyModel = new SurveyModel();
        $titleModel = new TitleModel();
        helper(['form']);
        $data['titles'] = $titleModel->orderBy('id', 'ASC')->findAll();
        $data['surveys'] = $surveyModel->orderBy('id', 'ASC')->findAll();
        return view('surveyForm',$data);
    }
    public function surveyFormSegment()
    {
        $surveyModel = new SurveyModel();
        $titleModel = new TitleModel();
        helper(['form']);
        $data['titles'] = $titleModel->orderBy('id', 'ASC')->findAll();
        $data['surveys'] = $surveyModel->orderBy('id', 'ASC')->findAll();
        $segmentID = $this->request->getPost('selectSegment');
        return view('surveyForm/'.$segmentID, $data);
        // return redirect()->to('pages/surveyForm/'.$segmentID, $data);
    }    
    public function addTitle()
    {
            $titleModel = new TitleModel();

            $data = [
                'name'   => $this->request->getPost('tn1'),
            ];

            $titleModel->save($data);

            return redirect()->to('pages/surveyForm');        
    }
    public function addSurvey()
    {
            $surveyModel = new SurveyModel();

            $data = [
                'title'     => $this->request->getPost('st1'),
                'question'  => $this->request->getPost('sq1'),
                'answer'    => $this->request->getPost('sa1'),
                'createdat' => date('U')
            ];

            $surveyModel->save($data);

            return redirect()->to('pages/surveyForm');        
    }
    public function addResult()
    {
        $resultModel    = new ResultModel();
        $surveyModel    = new SurveyModel();
        $titleModel     = new TitleModel();
        $dataTitles     = $titleModel->orderBy('id', 'ASC')->findAll();
        $dataSurveys    = $surveyModel->orderBy('id', 'ASC')->findAll();

        foreach($dataTitles as $titleNo){
            $iT = 1;
            foreach($dataSurveys as $surveyNo){
                $iS = 1;
                // Table Surveys, Column Title is saving Table Titles Id
                if($surveyNo['title'] == $titleNo['id']){
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

        $resultModel->save($data);

        return redirect()->to('pages/surveyForm');        
    }
    public function editTitle($id) {
        $tableName = new TitleModel();
        $dataEdit = [
            'name'   => $this->request->getPost('titleNAME'),
        ];
        $tableName->update($id, $dataEdit);
        return redirect()->to('pages/surveyForm'); 
    }    
    public function editSurvey($id) {
        $tableName = new SurveyModel();
        $dataEdit = [
            'title'   => $this->request->getPost('surveyTITLE'),
            'question'  => $this->request->getPost('surveyQUESTION'),
            'answer'    => $this->request->getPost('surveyANSWER'),
        ];
        $tableName->update($id, $dataEdit);
        return redirect()->to('pages/surveyForm'); 
    }    
   
    public function deleteTitle($id) {
        $tableName = new TitleModel();
        $tableName->where('id', $id)->delete($id);
        return redirect()->to('pages/surveyForm'); 
    }    
    public function deleteSurvey($id) {
        $tableName = new SurveyModel();
        $tableName->where('id', $id)->delete($id);
        return redirect()->to('pages/surveyForm'); 
    }    


}