<?php
class QuizQuestions extends SQuestion{
    public Questions $question;
    public function index(int $course_id,int $quiz_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Quiz Questions";
            $this->question = $this->getQuestion();
            $this->data["quiz_id"] = $quiz_id;
            $this->data["course_id"] = $course_id;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->question->addQuestionToTheQuiz($_POST["question_id"], $quiz_id);
            }
            $this->getDataReady($quiz_id);
            $this->data["questions"] = $this->question->getAllQuestionsNotInTheQuiz($course_id, $quiz_id);
            $this->view("quiz-questions", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function enrolledQuestions(int $course_id,int $quiz_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Quiz Questions";
            $this->data["quiz_id"] = $quiz_id;
            $this->data["course_id"] = $course_id;
            $this->question = $this->getQuestion();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->question->removeQuestionFromQuiz($_POST["question_id"], $quiz_id);
            }
            $this->getDataReady($quiz_id);
            $this->data["questions"] = $this->question->getAllQuestionsInTheQuiz($course_id, $quiz_id);
            $this->view("quiz-enrolled-questions", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function getDataReady($quiz_id):void{
        $this->data["numberOfQuestionsLeft"] = $this->question->getNumberOfQuestionsLeft($quiz_id);
        $this->data["numberOfMarksLeft"] = $this->question->getNumberOfMarksLeft($quiz_id);
    }
}