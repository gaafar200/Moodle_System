<?php
class Course extends Controller
{
    public courses $course;
    public $errors;
    public function __construct()
    {
        parent::__construct();
        $this->course = new courses();
    }

    public function index(){
        $this->data["pageName"] = "All Courses";
        $this->data["coursesData"] = $this->course->getCoursesData($this->data["user"]->id,$this->data["user"]->rank);
        $this->view("all-courses",$this->data);
    }
    public function edit($id){
        if($this->Auth->hasRightPrivilege("technical")) {
            $this->data["pageName"] = "Edit Course";
            $check = $this->course->DoesCourseExists($id);
            if ($check) {
                $this->data["CourseData"] = $this->course->getCourseData($id);
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ($_FILES["image"]["tmp_name"] !== "") {
                        $isPhotoChanged = $this->course->image->changePhoto($id, $_FILES, "course");
                        if ($isPhotoChanged !== true) {
                            $this->data["errors"] = $isPhotoChanged;
                        }
                    }
                    $check = $this->course->editCourseData($_POST, $id);
                    if ($check === true) {
                        $this->redirect("Course");
                    }
                    else{
                        $this->data["errors"] = $check;
                    }
                }
            } else {
                $this->redirect("Course");
            }
            $this->view("edit-course", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function Info($id){
        $this->data["pageName"] = "Course Info";
        $this->data["courseDetails"] = $this->course->getCourseData($id);
        $this->view("course-info",$this->data);
    }
    public function add(){
        $this->data["old_data"] = array();
        if($this->Auth->hasRightPrivilege("technical")) {
            $this->data["pageName"] = "add Course";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->errors = $this->course->validateData($_POST, $_FILES);
                if ($this->errors === true) {
                    $result = $this->course->addCourse($_POST, $_FILES, $this->data["user"]);
                    if ($result) {
                        $this->redirect("Course");
                    }
                } else {
                    $this->data["errors"] = $this->errors;
                    $this->data["old_data"] = $_POST;
                }
            }

            $this->view("add-course", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function delete($id){
        if($this->Auth->hasRightPrivilege("technical")) {
            $this->data["pageName"] = "All Courses";
            $result = $this->course->delete($id);
            if ($result) {
                $this->errors = $result;
            }
            $this->data["coursesData"] = $this->course->getCoursesData($this->data["user"]->id,$this->data["user"]->rank);
            $this->data["errors"] = $this->errors;
            $this->view("all-courses", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function addStudents($id){
        if($this->Auth->hasRightPrivilege("technical")) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->course->addStudentToACourse($_POST["addStudent"], $id);
            }
            $this->data["courseStudents"] = $this->course->getStudentsNotInTheCourse($id);
            $this->data["pageName"] = "add students";
            $this->view("add-students-list", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function removeStudents($id){
        if ($this->Auth->hasRightPrivilege("technical")) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->course->removeStudentFromACourse($_POST["delete"], $id);
            }
            $this->data["courseStudents"] = $this->course->getCourseStudents($id);
            $this->data["pageName"] = "remove students";
            $this->view("remove-students-list", $this->data);
        }
        else{
            $this->forbidden();
        }
    }

}