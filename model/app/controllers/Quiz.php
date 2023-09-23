<?php

class Quiz extends Controller
{
    public Quizes $quiz;
    public IQuestionFactory $questionFactory;
    public Questions $question;
    public function __construct()
    {
        parent::__construct();
        $this->questionFactory = new NormalQuestionFactory();
        $this->question = $this->questionFactory->getQuestion();
        $this->quiz = new Quizes();
    }

    public function index(int $course_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Quizes";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->quiz->deleteQuiz($_POST["quiz_id"]);
            }
            $this->data["course_id"] = $course_id;
            $this->data["quizes_data"] = $this->quiz->getAllQuizes($course_id);
            $this->view("quizzes-list", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function set(int $id){
        if($this->data["user"]->rank == "lecturer"){
            $this->data["pageName"] = "Set Quiz";
            $this->data["old_data"] = array();
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $result = $this->quiz->setQuiz($_POST,$id);
                if($result === true){
                    $this->redirect("Quiz/" . $id);
                }
                $this->data["errors"] = $result;
                $this->data["old_data"] = $_POST;
            }
            #show($this->data);die;
            $this->view("set-quiz",$this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function edit(int $quiz_id,int $courseId){
        if($this->data["user"]->rank == "lecturer"){
            $this->data["pageName"] = "Edit Quiz";
            $this->data["canEditAutoCorrection"] = $this->quiz->checkIfQuizHaveEssayQuestion($quiz_id);
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $result = $this->quiz->editQuiz($_POST,$quiz_id);
                if($result === true){
                    $this->redirect("Quiz/" . $courseId);
                }
                $this->data["errors"] = $result;
             }
            $this->data["quiz_date"] = $this->quiz->getQuizData($quiz_id);
            $this->data["quiz_id"] = $quiz_id;
            $this->view("edit-quiz",$this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function activate(int $quiz_id,int $course_id){
        if($this->data["user"]->rank == "lecturer"){
            $this->quiz->activateQuiz($quiz_id);
            $this->redirect("Quiz/"  . $course_id);
        }
        else{
            $this->forbidden();
        }

    }
    public function deactivate(int $quiz_id,int $course_id){
        if($this->data["user"]->rank == "lecturer"){
            $this->quiz->deactivateQuiz($quiz_id);
            $this->redirect("Quiz/"  . $course_id);
        }
        else{
            $this->forbidden();
        }

    }
    public function quizDisplay(int $course_id,int $quiz_id){
        $this->data["course_id"] = $course_id;
        $this->data["quiz_id"] = $quiz_id;
        if($this->Auth->checkCanDisplayCourseMaterials($course_id)){
            $this->data["quiz_display"] = $this->quiz->getQuizDisplayData($quiz_id);
            if($this->data["quiz_display"]) {
                $studQuizes = new studQuizes();
                $this->data["quiz_display"]->canPerformQuiz = $studQuizes->checkStudentCanPerformQuiz($this->data["user"],$quiz_id,$course_id);
                $this->data["quiz_status"] = $this->quiz->checkQuizTime($quiz_id);
                $this->data["quiz_display"]->quizStartDate = $this->quiz->quizGetStartTimeFormatted($quiz_id);
                $this->data["quiz_display"]->quizendDate = $this->quiz->quizGetEndTimeFormatted($quiz_id);
                $this->data["pageName"] = $this->data["quiz_display"]->name;
                $this->data["course_name"] = $this->quiz->getCourseDataForQuiz($course_id);
                $this->data["quiz_attempts"] = $studQuizes->getAllStudentAttempts($this->data["user"]->id,$quiz_id);
                $this->data["canContinueQuiz"] = $studQuizes->checkQuizContinue($this->data["user"]->id,$this->data["quiz_id"]);
                $this->view("quizzes-details", $this->data);
            }
        }
        else{
            $this->forbidden();
        }
    }



}