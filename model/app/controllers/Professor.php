<?php

class Professor extends Controller
{
    public lecturer $prof;
    public array $messages;
    public function __construct(){
        parent::__construct();
        $this->prof = new lecturer();
    }
    public function index(){
        $this->data["pageName"] = "All Professors";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->data["lecturers"] = $this->prof->searchForProfessors($_POST["search"]);
        }
        else{
            $this->getMissingData();
        }

        $this->view("all-professors",$this->data);
    }
    public function edit($username = ""){
        if($this->Auth->hasRightPrivilege("technical")){
            $this->data["pageName"] = "edit Professor";
            $this->data["errors"] = array();
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_FILES["image"]["tmp_name"] !== "") {
                    $imageChangedSuccessfully = $this->prof->image->changePhoto($username, $_FILES);
                    if ($imageChangedSuccessfully !== true) {
                        $this->data["errors"] = $imageChangedSuccessfully;
                    }

                }
                $check = $this->prof->validateEditBaseData($_POST);
                if ($check !== true) {
                    $this->data["errors"] = $check;
                }
                if (!isset($this->data["errors"]) || empty($this->data["errors"])) {
                    if ($this->prof->EditProfessorData($_POST)) {
                        $this->redirect("Professor");
                    }
                }
            }
            $this->data["lectData"] = false;
            if ($username !== "") {
                $this->data["lectData"] = $this->prof->getUserDataFromUsername($username);
            }
            $this->view("edit-professor", $this->data);
        } 
        else {
            $this->forbidden();
        }

    }
    public function profile($username = ""){
        $this->data["pageName"] = "Professor Profile";
        $this->data["ProfProfile"] = $this->prof->getUserDataFromUsername($username);
        $this->view("professor-profile",$this->data);
    }
    public function add(){
        if($this->Auth->hasRightPrivilege("technical")) {
            $this->data["old_data"] = array();
            $this->data["pageName"] = "add Professor";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->prof->validateProfData($_POST, $_FILES);
                if ($result === true) {
                    $result = $this->prof->registerUser($_POST, $_FILES);
                    $this->redirect("Professor");
                } else {
                    $this->data["errors"] = $result;
                    $this->data["old_data"] = $_POST;
                }
            }
            $this->view("add-professor", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function delete($username = ""){
        if($this->Auth->hasRightPrivilege("technical")) {
            $this->data["pageName"] = "All Professors";
            if ($username != "") {
                $result = $this->prof->deleteUser($username);
                if ($result === true) {
                    $this->data["success"] = ["lecturer" => "Lecturer Deleted Successfully"];
                }
            }
            $this->getMissingData();
            $this->view("all-professors", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function getMissingData(){
        $lecturers = $this->prof->getAllLecturers($this->data["user"]->username);
        $this->data["lecturers"] = $lecturers;
    }
}