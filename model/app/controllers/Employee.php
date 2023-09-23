<?php

class Employee extends Controller
{
    public Employees $employee;
    public function __construct(){
        parent::__construct();
        $this->employee = new Employees();
    }
    public function index(){
        $this->data["pageName"] = "All Employees";
        $this->data["technicals"] = $this->employee->getAllTechnicals($this->data["user"]->username);
        $this->view("all-employees",$this->data);
    }
    public function add(){
        if($this->Auth->hasRightPrivilege("admin")){
            $this->data["pageName"] = "Add Employee";
            $this->data["old_data"] = array();
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $check = $this->employee->ValidateData($_POST,$_FILES);
                if($check === true){
                    $result = $this->employee->registerUser($_POST,$_FILES);
                    if($result){
                        $this->redirect("Employee");
                    }
                }
                else{
                    $this->data["errors"] = $check;
                    $this->data["old_data"] = $_POST;
                }
            }
            $this->view("add-employee",$this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function edit($username = ""){
        if($this->Auth->hasRightPrivilege("admin")){
            if($username != ""){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if($_FILES["image"]["tmp_name"] !== ""){
                        $isPhotoChanged = $this->employee->image->changePhoto($username,$_FILES);
                        if($isPhotoChanged !== true){
                            $this->data["errors"] = $isPhotoChanged;
                        }
                    }
                    $check = $this->employee->validateEditBaseData($_POST);
                    if($check === true){
                        $isEdited = $this->employee->editUserData($_POST);
                        if($isEdited){
                            $this->redirect("Employee");
                        }
                    }
                    else{
                        $this->data["errors"] = $check;
                    }
                }
            }
            $this->data["EmployeeData"] = $this->employee->getUserDataFromUsername($username);
            $this->data["pageName"] = "Edit Employee";
            $this->view("edit-employee",$this->data);
        }
        else{
            $this->forbidden();
        }
    }

    public function delete($username = ""){
        if($this->Auth->hasRightPrivilege("admin")){
            $this->data["pageName"] = "All Employees";
            if($username != ""){
                $result = $this->employee->deleteUser($username);
                if($result === true){
                    $this->data["success"] = ["Employee"=> "employee Deleted Successfully"];
                }
            }
            $this->data["technicals"] = $this->employee->getAllTechnicals($this->data["user"]->username);
            $this->view("all-employees",$this->data);
        }
        else{
            $this->forbidden();
        }

    }
    public function profile($username){
        $this->data["EmployeeData"] = $this->employee->getUserDataFromUsername($username);
        $this->data["pageName"] = "Employee Profile";
        $this->view("employee-profile",$this->data);
    }

}