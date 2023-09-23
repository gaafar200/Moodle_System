<?php

class Question extends SQuestion
{
    public function index(int $course_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->question = $this->getQuestion();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->question->deleteQuestion($course_id, $_POST["deleteQuestion"]);
            }
            $this->data["course_id"] = $course_id;
            $this->data["pageName"] = "add Questions";
            $this->data["questions"] = $this->question->getAllQuestions($course_id);
            $this->view("questions-list", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function set(int $course_id){
        if($this->data["user"]->rank == "lecturer"){
            $this->data["errors"] = array();
            $this->data["pageName"] = "Set Question";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $this->question = $this->getQuestion($_POST["question_type"]);
                $result = $this->question->addQuestion($_POST,$course_id,$_FILES);
                if($result === true){
                    $this->redirect("Question/". $course_id);
                }
                else{
                    $this->data["errors"] = $result;
                    $this->data["old_data"] = $_POST;
                }
            }
            $this->view("add-question",$this->data);
        }
        else {
            $this->forbidden();
        }
    }
    public function edit(int $course_id,int $question_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Edit Question";
            $this->question = $this->getQuestion();
            $this->data["question_data"] = $this->question->getQuestionData($question_id, $course_id);
            $this->data["question_choice"] = $this->question->getQuestionChoices($question_id);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->question = $this->getQuestion($_POST["question_type"]);
                $result = $this->question->editQuestion($course_id, $question_id, $_POST);
                if ($result === true) {
                    $this->redirect("Question/" . $course_id);
                }
            }
            $this->view("edit-question", $this->data);
        }
        else{
            $this->forbidden();
        }
    }




}