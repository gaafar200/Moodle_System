<?php
class StudentAssignments extends Controller{
    public studentAssignment $studentAssignment;
    public function __construct(){
        parent::__construct();
        $this->studentAssignment = new studentAssignment();
    }
    public function index($assignment_id,$course_id){
        $this->data["pageName"] = "Assignment Marks";
        $this->data["AssignmentMarks"] = $this->studentAssignment->getStudnetAssignmentMarks($assignment_id);
        $this->data["assignment_id"] = $assignment_id;
        $this->data["course_id"] = $course_id;
        $this->view("student-assignments-marks",$this->data);
    }

    public function mark($student_assignment_id){
        $course = new Courses();
        $assignment = new Assignments();
        $course_id = $this->studentAssignment->getCourseIdFromStudnetAssignmentId($student_assignment_id);
        $assignment_id = $this->studentAssignment->getAssignmentIdFromStudentAssignmentId($student_assignment_id);
        $this->data["course_name"] = $course->getCourseName($course_id);
        $this->data["assignmentDetails"] = $assignment->getAssignmentDetails($assignment_id);
        $this->data["pageName"] = $assignment->getAssignmentName($assignment_id);
        $this->data["studnetAssignmentDetails"] = $this->studentAssignment->getAllAssignmentStudentDetails($assignment_id,$this->data["user"]->id);
        $this->data["student_attempt"] = $this->studentAssignment->getStudentAssignment($student_assignment_id);
        $this->data["course_id"] = $course_id;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $check = $this->studentAssignment->manuaAssignmentlMark($_POST);
            if($check === true){
                $this->redirect("StudentAssignments/" . $assignment_id . "/" . $course_id);
            }
            else{
                $this->data["errors"] = $check;
            }
        }
        $this->view("mark-assignment",$this->data);
    }

    public function assignmentDisplay($course_id,$assignment_id){
        $assignment = new Assignments();
        $this->data["pageName"] = $assignment->getAssignmentName($assignment_id);
        $course = new Courses();
        $this->data["course_name"] = $course->getCourseName($course_id);
        $this->data["assignmentDetails"] = $assignment->getAssignmentDetails($assignment_id);
        $this->data["studnetAssignmentDetails"] = $this->studentAssignment->getAllAssignmentStudentDetails($assignment_id,$this->data["user"]->id);
        $this->data["last_attempt"] = false;
        $this->data["course_id"] = $course_id;
        if($this->data["studnetAssignmentDetails"][0]->last_attempt != ""){
            $this->data["last_attempt"] = $this->studentAssignment->getStudentAttempt($this->data["studnetAssignmentDetails"][0]->last_attempt_id);
        }
        $this->view("assignment-details",$this->data);
    }

    public function add($assignment_id,$course_id){
        $this->data["pageName"] = "add Assignment";
        $this->data["course_id"] = $course_id;
        if($this->studentAssignment->checkCanPerformAddAssignment($assignment_id,$this->data["user"]->id)){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->studentAssignment->addStudentAssignment($assignment_id, $this->data["user"]->id, $_FILES["file"]);
                if ($result === true) {
                    $this->redirect("studentAssignments/assignmentDisplay/" . $course_id . "/" . $assignment_id);
                }
            }
            $course = new Courses();
            $this->data["course_name"] = $course->getCourseName($course_id);
            $assignment = new Assignments();
            $this->data["assignmentDetails"] = $assignment->getAssignmentDetails($assignment_id);
            $this->view("assignment-submision", $this->data);
        }
        else{
            $this->forbidden();
        }
        
    }

    public function download(string $filename,string $file){
        $storagePath = ASSETS . "data/assignment/" . $filename;
        header("Content-Type: application/pdf");
        header('Content-Disposition:attachment;filename=download.png');
        readfile($storagePath);
    }


    
}