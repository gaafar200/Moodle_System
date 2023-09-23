<?php

class Student extends Controller
{
    public Stud $student;
    public function __construct(){
        parent::__construct();
        $this->student = new Stud();
    }
    public function index(){
        $this->data["pageName"] = "All Students";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->data["students"] = $this->student->searchForStudents($_POST["search"]);
        }
        else{
            $this->data["students"] = $this->student->getAllStudent($this->data["user"]->username);
        }
        $this->view("all-students",$this->data);
    }
    public function edit($username = ""){
        if($this->Auth->hasRightPrivilege("technical")){
            $this->data["pageName"] = "Edit Student";
            if($username != ""){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if($_FILES["image"]["tmp_name"] !== ""){
                        $isPhotoChanged = $this->student->image->changePhoto($username,$_FILES);
                        if($isPhotoChanged !== true){
                            $this->data["errors"] = $isPhotoChanged;
                        }
                    }
                    $check =  $this->student->validateEditBaseData($_POST);
                    if($check === true){
                        $isEdited = $this->student->editUserData($_POST);
                        if($isEdited){
                            $this->redirect("student");
                        }
                    }
                    else{
                        $this->data["errors"] = $check;
                    }
                }
                $this->data["studData"] = $this->student->getUserDataFromUsername($username);
            }

            $this->view("edit-student",$this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function profile($username = ""){
        $this->data["pageName"] = "Student Profile";
        $this->data["studProfile"] = $this->student->getUserDataFromUsername($username);
        $this->view("student-profile",$this->data);
    }
    public function add(){
        if($this->Auth->hasRightPrivilege("technical")){
            $this->data["old_data"] = array();
            $this->data["pageName"] = "Add Student";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $isValidData = $this->student->validateStudentData($_POST, $_FILES);
                if ($isValidData === true) {
                    $isCreatedSuccessfully = $this->student->registerUser($_POST, $_FILES);
                    $this->redirect("Student");
                } else {
                    $this->data["errors"] = $isValidData;
                    $this->data["old_data"] = $_POST;
                }
            }
            $this->view("add-student", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function delete($username = ""){
        if($this->Auth->hasRightPrivilege("technical")){
            $this->data["pageName"] = "All Students";
            if ($username != "") {
                $data = $this->student->getUserDataFromUsername($username);
                if ($data[0]->rank === "student") {
                    $this->student->deleteUser($username);
                }
            }
            $this->data["students"] = $this->student->getAllStudent($this->data["user"]->username);
            $this->view("all-students", $this->data);
        }
        else{
            $this->forbidden();
        }
    }




}