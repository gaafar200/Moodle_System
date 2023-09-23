<?php

class Assignments extends Model
{
    public description $description;
    public function __construct(){
        parent::__construct();
        $this->description = new description();
    }
    public function getAllAssignmentData($course_id):array | bool{
        $query = "SELECT * FROM assignment WHERE course_id = :course_id";
        $data  = $this->db->read($query,
        [
           "course_id"=>$course_id
        ]);
        if(is_array($data)){
            return $data;
        }
        return false;
    }

    public function addThisAssignment(array $data, $uploaded_file,$course_id):bool | array
    {
        if($uploaded_file["error"] != 0){
            return ["file"=>"Error Uploading This File"];
        }
        $file = new file();
        $check = $file->isValidFile($uploaded_file);
        if(!$check){
            return ["file"=>"file must be either pdf or image"];
        }
        $check = $this->checkForAssignmentData($data);
        if(is_array($check)){
            return $check;
        }
        $filePath = $this->addAssignmentFileToFileSystem($uploaded_file);
        if(is_array($filePath)){
            return $filePath;
        }
        return $this->addAssignmentToTheSystem($data,$filePath,$course_id);
    }

    private function checkForAssignmentData(array $data,):bool | array
    {
        $check = $this->isVaildAssignmentName($data["assignment_name"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildStartDate($data["start_date"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidEndDate($data["end_date"],$data["start_date"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidLastSubmisionDate($data["last_date"],$data["end_date"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildMarkValue($data["mark_value"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMaxAttempts($data["max_attempts"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }
    private function isValidMaxAttempts($max_attempts){
        if($max_attempts < 0){
            ["maxAttempts"=>"max attempts must be at least one"];
        }
        return true;
    }
    private function isVaildMarkValue($mark_value){
        if($mark_value <= 0){
            ["markValue"=>"Mark Value Must Be Greater Than Zero"];
        }
        return true;
    }
    private function isVaildAssignmentName($assignment_name):bool | array{
        if(!preg_match("/^[a-zA-Z 0-9 #]+$/",$assignment_name)){
            return ["assignment_name" => "name must only consist of characters and numbers."];
        }
        return true;
    }
    private function isVaildStartDate($date):bool | array
    {
        if(strtotime($date) <= strtotime(date(date('y-m-d')))){
            return ["date"=>"The start date must be in the future"];
        }
        return true;
    }
    private function isValidEndDate($end_time,$start_time){
        if(strtotime($end_time) < strtotime($start_time)){

            return ["end_date"=>"The end date for the quiz must be after the start date"];
        }
        return true;
    }
    private function isValidLastSubmisionDate($last_submistion_date,$start_time){
        if(strtotime($last_submistion_date) < strtotime($start_time)){
            return ["end_date"=>"The last submision date must be after the end_date"];
        }
        return true;
    }

    private function validateDate($start_date):bool | array
    {
        if(strtotime($start_date) <= strtotime(date(date('y-m-d h:i:s')))){
            return ["start_date"=>"The start date must be in the future"];
        }
        return true;
    }

    private function addAssignmentFileToFileSystem($file):string | array
    {
        $files = new File();
        return $files->uploadToFileSystem($file,"assignment");
    }

    private function addAssignmentToTheSystem($data,$file,$course_id):bool
    {
        $data["create_date"] = date("y-m-d h:i:s");
        $data["file"] = $file;
        $data["course_id"] = $course_id;
        $query = "INSERT INTO assignment (create_date,name,start_date,deadline,last_submition_date,max_attempts,description,assignment_material,course_id,mark_value) VALUES(:create_date,:assignment_name,:start_date,:end_date,:last_date,:max_attempts,:description,:file,:course_id,:mark_value)";
        return $this->db->write($query,$data);
    }

    public function deleteAssignment($assignment_id):bool
    {
        $query = "DELETE FROM assignment WHERE id = :assignment_id";
        return $this->db->write($query,
        [
           "assignment_id"=>$assignment_id
        ]);
    }
    public function getThisAssignmentData(int $assignment_id):bool | array
    {
        $query = "SELECT * FROM assignment WHERE id = :assignment_id LIMIT 1";
        return $this->db->read($query,
        [
            "assignment_id"=>$assignment_id
        ]);
    }

    public function editAssignmentData(int $assignment_id, array $data, mixed $files):bool | array
    {
        $check = $this->validateEditData($data);
        if(is_array($check)){
            return $check;
        }
        if(is_array($files)){
            $check = $this->editFiles($assignment_id,$files);
            if(is_array($check)){
                return $check;
            }
        }
        $query = "UPDATE assignment SET name = :assignment_name,start_date = :start_date,deadline = :end_date,last_submition_date = :last_date,max_attempts = :max_attempts,description = :description,mark_value = :mark_value";
        return $this->db->write($query,$data);
    }

    private function editFiles($assignment_id,$Files)
    {
        $file = new file();
        $path = $file->changeFile($assignment_id,$Files,"assignment");
        if(is_array($path)){
            return $path;
        }
        $this->editFileInDataBase($assignment_id,$path);
    }

    public function validateEditData($data){
        $check = $this->isVaildAssignmentName($data["assignment_name"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidEndDate($data["end_date"],$data["start_date"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidLastSubmisionDate($data["last_date"],$data["end_date"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildMarkValue($data["mark_value"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMaxAttempts($data["max_attempts"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    public function getAssignmentData($assignment_id){
        $query = "SELECT * FROM assignment WHERE id = :assignment_id";
        return $this->db->read($query,[
            "assignment_id"=>$assignment_id,
        ]);
    }

    public function editFileInDataBase($assignment_id,$path){
        $query = "UPDATE assignment SET assignment_material = :path WHERE id = :assignment_id";
        return $this->db->write($query,
        [
            "path"=>$path,
            "assignment_id"=>$assignment_id
        ]);
    }

    public function getAssignmentName($assignment_id){
        $query = "SELECT name FROM assignment WHERE id = :assignment_id";
        $data = $this->db->read($query,[
            "assignment_id"=>$assignment_id
        ]);
        if($data){
            return $data[0]->name;
        }
        return "";
    }


    public function getAssignmentDetails($assignment_id){
        $query = "SELECT * FROM assignment WHERE id = :assignment_id";
        return $this->db->read($query,
        [
            "assignment_id"=>$assignment_id
        ]);
    }


    public function canAddAssignment($user):bool{
        if($user->rank != "student"){
            return false;
        }
        return true;
    }

    public function getMaxAttemptFromAssignment($assignment_id){
        $query = "SELECT max_attempts FROM assignment WHERE id = :assignment_id";
        $result = $this->db->read($query,
        [
            "assignment_id"=> $assignment_id
        ]);
        if(!$result){
            return 0;
        }
        return $result[0]->max_attempts;
    }
    public function getCourseIdFromAssignmentId($assignment_id){
        $query = "SELECT course_id FROM assignment WHERE id = :assignment_id";
        $result = $this->db->read($query,
        [
            "assignment_id"=>$assignment_id
        ]);
        if($result){
            return $result[0]->course_id;
        }
        return -1;

    }
}