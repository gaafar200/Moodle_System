<?php

class Quizes extends model
{
    public description $description;
    public function __construct(){
        parent::__construct();
        $this->description = new description();
    }
    public function setQuiz(array $data,int $id)
    {
        $check = $this->validateQuizData($data);
        if(is_array($check)){
            return $check;
        }
        $data = $this->setDataReadyForTheQuery($data,$id);
        $query = "INSERT INTO quiz(name,created_date,quiz_date,end_time,start_time,description,is_auto_correct,number_of_questions,max_attempts,time,course_id,status,is_shuffled,is_recursive,is_disclosed,mark_value)
                   VALUES(:quiz_name,:created_date,:date,:end_time,:start_time,:description,:is_auto_correct,:number_of_questions,:max_attempts,:time,:course_id,:status,:is_shuffled,:is_recursive,:is_disclosed,:mark_value)";
        return $this->db->write($query,$data);
    }

    private function validateQuizData(array $data,bool $is_edit = false) :bool | array
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->validateQuizName($quiz_name);
        if(is_array($check)){
            return $check;
        }
        if(!$is_edit){
            $check = $this->validateDate($date);
            if(is_array($check)){
                return $check;
            }
        }
        $check = $this->validateEndTime($start_time,$end_time);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateNumberOfQuestions($number_of_questions);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateQuizTime($time);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateQuizMark($mark_value);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateNumberOfAttempts($max_attempts);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_recursive,"recursive");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_auto_correct,"auto_correct");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_shuffled,"is_shuffled");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_disclosed,"is_disclosed");
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($description);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    private function validateQuizName($name):bool | array
    {
        if(strlen($name) < 3 || strlen($name) > 25){
            return ["quiz_name"=>"quiz name length must be between 3 and 25 characters"];
        }
        if(!preg_match("/^[a-zA-Z1-9 #]+$/",$name)){
            return ["quiz_name"=>"quiz name only consist of numbers,characters and ampersand"];
        }
        return true;
    }
    private function validateEndTime(string $start_time, string $end_time): bool | array
    {
        if(strtotime($end_time) < strtotime("+15 minutes", strtotime($start_time))){
            return ["endTime"=>"The time available for the quiz must be at least 15 minutes"];
        }
        return true;
    }

    private function validateNumberOfQuestions($number_of_questions): bool | array
    {
        if($number_of_questions <= 0){
            return ["number_of_question"=>"The number of question must be greater than 0"];
        }
        return true;
    }
    private function validateDate($date):bool | array
    {
        if(strtotime($date) <= strtotime(date(date('y-m-d h:i:s')))){
            return ["date"=>"The start date must be in the future"];
        }
        return true;
    }

    private function validateQuizTime($time):bool | array
    {
        if($time < 15){
            return ["number_of_question"=>"The Quiz Time must be greater than or equal to 15 minutes"];
        }
        return true;
    }

    private function validateNumberOfAttempts($number_of_attempts):bool | array
    {
        if($number_of_attempts <= 0 || $number_of_attempts > 5){
            return ["numberOfAttempts"=>"number of attempts must be between 1 and 5"];
        }
        return true;

    }

    private function validateBooleanField($is_recursive,$name):bool | array
    {
        $array = ["yes","no"];
        if(in_array($is_recursive,$array)){
            return true;
        }
        return [$name=>"value must be either true or false"];
    }

    private function setDataReadyForTheQuery(array $data,int $id):array
    {
        $data["created_date"] = date('y-m-d h:i');
        $data["course_id"] = $id;
        $data["status"] = "inactive";
        return $data;
    }

    private function validateQuizMark($mark_value):bool | array
    {
        if($mark_value <= 0){
            return ["mark_value"=>"mark value must be greater than 0"];
        }
        return true;
    }

    public function getAllQuizes(int $id)
    {
        $query = "SELECT id,name,quiz_date as date,time,mark_value as mark,status FROM quiz where course_id = :id ORDER BY id DESC";
        return $this->db->read($query,
        [
           "id"=>$id
        ]);

    }

    public function deleteQuiz(int $id):void
    {
        $this->deleteAllRelatedQuestions($id);
        $query = "DELETE FROM quiz WHERE id = :id";
        $this->db->write($query,
        [
            "id"=>$id
        ]);
    }

    private function deleteAllRelatedQuestions(int $id):void
    {
        $query = "DELETE FROM quiz_questions WHERE quiz_id = :id";
        $this->db->write($query,
        [
           "id"=>$id
        ]);
    }

    public function getQuizData(int $id):array | bool
    {
        $query = "SELECT * FROM quiz WHERE id = :id";
        return $this->db->read($query,
        [
           "id"=>$id
        ]);

    }

    public function editQuiz(array $data, int $id):bool | array
    {
        $result = $this->validateQuizData($data,True);
        if(is_array($result)){
            return $result;
        }
        $result = $this->checkIfQuizHaveEssayQuestion($id);
        if($result){
            $data["is_auto_correct"] = "no";
        }
        $sql = "UPDATE quiz SET name = :quiz_name,quiz_date = :date,start_time = :start_time,end_time = :end_time,number_of_questions = :number_of_questions,time = :time,mark_value = :mark_value,max_attempts = :max_attempts,is_recursive = :is_recursive,is_auto_correct = :is_auto_correct,is_shuffled = :is_shuffled,is_disclosed = :is_disclosed,description = :description WHERE id = :id";
        $data["id"] = $id;
        return $this->db->write($sql,$data);
    }
    public function checkQuizReady(int $quiz_id){
        $quiz_data = $this->getQuizQuestionsData($quiz_id);
        $quiz_actual_data = $this->getQuizActualQuestionData($quiz_id);
        if($quiz_data[0]->number_of_questions == $quiz_actual_data[0]->number_of_questions
            && $quiz_data[0]->sumOfMarks == $quiz_actual_data[0]->mark_value){
            return true;
        }
        return false;
    }

    public function checkQuizStatus(int $quiz_id,string $status = "add"):void
    {
        if($status == "add" && $this->checkQuizReady($quiz_id)){
            $this->setQuizStatus($quiz_id,"active");
        }
        else if($status == "delete" && !$this->checkQuizReady($quiz_id)){
            $this->setQuizStatus($quiz_id,"inactive");
        }
    }

    private function getQuizQuestionsData($quiz_id):array | bool
    {
        $query = "SELECT count(question_id) as number_of_questions,sum(mark_value) as sumOfMarks FROM quiz_questions INNER JOIN  question ON (id = question_id) WHERE quiz_id = :quiz_id";
        return $this->db->read($query,[
           "quiz_id"=>$quiz_id
        ]);
    }

    private function getQuizActualQuestionData(int $quiz_id):bool | array
    {
        $query = "SELECT mark_value, number_of_questions FROM quiz WHERE id = :quiz_id LIMIT 1";
        return $this->db->read($query,
        [
            "quiz_id"=>$quiz_id
        ]);
    }

    private function setQuizStatus(int $quiz_id,$status):void
    {
        $query = "UPDATE quiz SET status = :status WHERE id = :quiz_id LIMIT 1";
        $this->db->write($query,
        [
            "quiz_id"=>$quiz_id,
            "status"=>$status
        ]);
    }
    public function activateQuiz(int $quiz_id){
        if($this->checkQuizReady($quiz_id)){
            $this->setQuizStatus($quiz_id,"ready");
        }
    }
    public function deactivateQuiz(int $quiz_id){
        if($this->checkQuizReady($quiz_id)){
            $this->setQuizStatus($quiz_id,"active");
        }
    }

    public function getQuizDisplayData($quiz_id): stdClass
    {
        $query = "SELECT name,quiz_date,start_time,end_time,description,max_attempts,time,mark_value FROM quiz WHERE id = :quiz_id LIMIT 1";
        $data =  $this->db->read($query,
        [
            "quiz_id"=>$quiz_id
        ]);
        return $data[0];
    }
    public function getMaxAttempts($quiz_id):int | bool{
        $query = "SELECT max_attempts FROM quiz WHERE id = :quiz_id";
        $data = $this->db->read($query,
            [
                "quiz_id"=>$quiz_id
            ]);
        if($data){
            return $data[0]->max_attempts;
        }
        return false;
    }

    public function isRandom(int $quiz_id):bool
    {
        $query = "SELECT is_shuffled FROM quiz WHERE id = :quiz_id LIMIT 1";
        $data = $this->db->read($query,
        [
           "quiz_id"=>$quiz_id
        ]);
        if($data && $data[0]->is_shuffled == "yes"){
            return true;
        }
        return false;
    }
    public function getNumberOfQuestions(int $quiz_id){
        $query = "SELECT number_of_questions FROM quiz WHERE id = :quiz_id LIMIT 1";
        $data = $this->db->read($query,
        [
           "quiz_id"=>$quiz_id
        ]);
        return $data[0]->number_of_questions;
    }

    public function isRecursive(int $quiz_id)
    {
        $query = "SELECT is_recursive FROM quiz WHERE id = :quiz_id";
        $data = $this->db->read($query,
        [
           "quiz_id"=>$quiz_id
        ]);
        if($data[0]->is_recursive == "yes"){
            return true;
        }
        return false;
    }

    public function getCourseDataForQuiz(int $course_id):string
    {
        $course = new Courses();
        return $course->getCourseName($course_id);
    }
    public function getDateInfo($quiz_id){
        $query = "SELECT quiz_date,start_time,end_time FROM quiz WHERE id = :quiz_id";
        return $this->db->read($query,
        [
            "quiz_id"=>$quiz_id
        ]);
    }

    public function checkQuizTime($quiz_id):string
    {
        $data = $this->getDateInfo($quiz_id);
        $date = $data[0]->quiz_date;
        $start = $data[0]->start_time;
        $end = $data[0]->end_time;

        $startQuizTime = date('Y-m-d H:i:s', strtotime("$date $start"));
        $endQuizTime = date('Y-m-d H:i:s', strtotime("$date $end"));
        $currentDate = date("Y-m-d H:i:s");
        if($currentDate < $startQuizTime){
            return "closed";
        }
        else if($currentDate <=  $endQuizTime){
            return "available";
        }
        else{
            return "finished";
        }
    }
    public function quizGetStartTimeFormatted($quiz_id):string{
        $data = $this->getDateInfo($quiz_id);
        $date = $data[0]->quiz_date;
        $start = $data[0]->start_time;
        return $this->getTimeFormattedNicely($date,$start);
    }
    public function quizGetEndTimeFormatted($quiz_id):string{
        $data = $this->getDateInfo($quiz_id);
        $date = $data[0]->quiz_date;
        $end = $data[0]->end_time;
        return $this->getTimeFormattedNicely($date,$end);
    }
    public function getTimeFormattedNicely($date,$time = ""):string{
        if($time == ""){
            return date('l, d F h:i A', strtotime("$date"));
        }
        return date('l, d F h:i A', strtotime("$date $time"));
    }

    public function getQuizDuration(int $quiz_id)
    {
        $query = "SELECT time FROM quiz WHERE id = :quiz_id";
        $data = $this->db->read($query,
        [
            "quiz_id"=>$quiz_id
        ]);
        return $data[0]->time;
    }

    public function getCourseId(int $quiz_id)
    {
        $query = "SELECT course_id FROM quiz WHERE id = :quiz_id";
        $data = $this->db->read($query,
        [
           "quiz_id"=>$quiz_id
        ]);
        return $data[0]->course_id;
    }

    public function makeQuizNotAutoCorrect(int $quiz_id)
    {
        $query = "UPDATE quiz SET is_auto_correct = 'no' WHERE id = :quiz_id";
        $this->db->write($query,
        [
            "quiz_id"=>$quiz_id
        ]);
    }

    public function checkIfQuizHaveEssayQuestion(int $id):bool
    {
        $query = "SELECT question_id FROM quiz_questions qq JOIN question q ON(qq.question_id = q.id) WHERE qq.quiz_id = :quiz_id and q.question_type = 'essayQuestion' LIMIT 1";
        $result = $this->db->read($query,
        [
            "quiz_id"=>$id
        ]);
        if($result){
            return true;
        }
        return false;
    }

    public function isMarksDisclosed($quiz_id){
        $query = "SELECT is_disclosed FROM quiz WHERE id = :id";
        $data = $this->db->read($query,
        [
            "id"=>$quiz_id
        ]);
        if($data[0]->is_disclosed == "no"){
            return false;
        }
        return true;
    }


}