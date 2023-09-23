<?php

class Assignment extends Controller
{
    public Assignments $assignment;
    public function __construct()
    {
        parent::__construct();
        $this->assignment = new Assignments();
    }
    public function index(int $course_id)
    {
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Assignments";
            $this->data["course_id"] = $course_id;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $this->assignment->deleteAssignment($_POST["assignment_id"]);
            }
            $this->data["assignment_data"] = $this->assignment->getAllAssignmentData($course_id);
            $this->view("assignment-list",$this->data);
        }
        else{
            $this->forbidden();
        }

    }
    public function set(int $course_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["old_data"] = array();
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $check = $this->assignment->addThisAssignment($_POST,$_FILES["file"],$course_id);
                if($check === true){
                    $this->redirect("Assignment/" . $course_id);
                }
                else{
                    $this->data["errors"] = $check;
                    $this->data["old_data"] = $_POST;
                }
            }
            $this->data["pageName"] = "Set Assignment";
            $this->view("set-assignment",$this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function edit(int $assignment_id,int $course_id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Edit lecturer";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $files = false;
                if($_FILES["file"]["name"] !== ""){
                    $files = $_FILES["file"];
                }
                $check = $this->assignment->editAssignmentData($assignment_id,$_POST,$files);
                if($check === true){
                    $this->redirect("assignment/" . $course_id);
                }
            }
            $this->data["assignment_data"] = $this->assignment->getThisAssignmentData($assignment_id);
            $this->view("edit-assignment",$this->data);
        }
        else{
            $this->forbidden();
        }
    }

    


}