<?php
class Courses extends Model{
    public Image $image;
    public lecturer $lecturer;
    public quiz $quiz;
    public description $description;
    public function __construct(){
        parent::__construct();
        $this->image = new Image();
        $this->lecturer = new lecturer();
        $this->description = new description();
    }

    public function validateData($data,$image = "")
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->isValidName($coursename);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($description);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidLecturer($professorusername);
        if(is_array($check)){
            return $check;
        }
        if($image != ""){
            $check = $this->image->isValidImage($image);
            if(is_array($check)){
                return $check;
            }
        }

        return true;

    }

    private function isValidName($coursename)
    {
        if(strlen($coursename) < 3){
            return ["coursename"=>"Course Name can not be less than 3 characters"];
        }
        if(!preg_match("/^[A-Za-z0-9 ]+$/",$coursename)){
            return["coursename"=>"Course Name must only consist of Characters and numbers"];
        }
        return true;
    }
    private function isValidLecturer($professorusername)
    {
        $check = $this->lecturer->validateusername($professorusername);
        if(is_array($check)){
            return $check;
        }
        $check = $this->lecturer->checkIfProfessorExists($professorusername);
        if(!is_array($check)){
            return ["username"=>"this professor does not exists"];
        }
        return true;
    }
    public function addCourse($data,$image,$creator_data)
    {
       $courseData["lecturer_id"] = $this->getLecturerId($data["professorusername"]);
       $courseData["date"] = date("y-m-d h:i:s");
       $courseData["status"] = "active";
       $courseData["language"] = "English";
       $courseData["created_by"] = $creator_data->id;
       $courseData["name"] = $data["coursename"];
       $courseData["description"] = $data["description"];
       $courseData["photo"] = $this->image->uploadToFileSystem($image,"course");
       $query = "INSERT INTO course (name,date,status,language,lecturer_id,created_by,photo,description) VALUES(:name,:date,:status,:language,:lecturer_id,:created_by,:photo,:description)";
       return $this->db->write($query,$courseData);
    }
    private function getLecturerId($username)
    {
        $data = $this->lecturer->checkIfProfessorExists($username);
        if(!is_array($data)){
            return false;
        }
        return $data[0]->id;
    }
    public function getCoursesData($user_id,$rank)
    {
        $query = $this->getCoursesFetchQuery($user_id,$rank);
        $requiredData = $this->getCoursesFetchData($user_id,$rank);
        $data = $this->db->read($query,$requiredData);
        if($data === false){
            return false;
        }
        foreach ($data as $course){
            $course->students = $this->getNumberOfStudentInACourse($course->id);
        }
        return $data;
    }
    public function getNumberOfStudentInACourse($id): int
    {
        $query = "SELECT count(student_id) as count FROM student_courses WHERE course_id = :id";
        $data = $this->db->read($query,
        [
           "id"=>$id
        ]);
        if(is_array($data) && !empty($data)){
            return $data[0]->count;
        }
        return 0;
    }
    public function getCourseData($course_id):bool | array
    {
        $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id,c.description From users u join course c ON(c.lecturer_id = u.id) WHERE c.id = :id";
        $data =  $this->db->read($query,
        [
           "id" => $course_id
        ]);
        $data = $this->addCourseQuizesToData($course_id,$data);
        $data = $this->addCourseAssignmentsToData($course_id,$data);
        $data = $this->addCourseAnnoucementToData($course_id,$data);
        return $data;
    }
    public function delete($id): bool | array
    {
        $check = $this->DoesCourseExists($id);
        if(!$check){
            return ["course"=>"course is not found"];
        }
        $this->removeAllStudentsFromThisCourse($id);
        $query = "DELETE FROM course WHERE id = :id";
        return $this->db->write($query,
        [
           "id"=>$id
        ]);
    }
    public function DoesCourseExists($id): bool
    {
        $query = "SELECT id FROM course WHERE id = :id";
        $data = $this->db->read($query,
        [
           "id"=>$id
        ]);
        if(is_array($data) && !empty($data)){
            return true;
        }
        return false;
    }
    private function removeAllStudentsFromThisCourse($id)
    {
        $query = "DELETE FROM student_courses WHERE course_id = :id";
        return $this->db->write($query,
        [
           "id"=>$id
        ]);
    }
    public function editCourseData(array $data,int $courseId)
    {
        $check = $this->validateData($data);
        if(is_array($check)){
            return $check;
        }
        $data["lecturer_id"] = $this->getLecturerId($data["professorusername"]);
        unset($data["professorusername"]);
        $data["course_id"] = $courseId;
        $query = "UPDATE course SET name = :coursename,lecturer_id = :lecturer_id,description = :description WHERE id = :course_id";
        return $this->db->write($query,$data);
    }
    public function getCourseStudents($id){
        $query = "SELECT u.id studentId, u.f_name,u.l_name,u.email,u.username FROM users u INNER JOIN student_courses c ON(u.id = c.student_id) WHERE c.course_id = :id && u.rank = :rank";
        return $this->db->read($query,[
            "id"=>$id,
            "rank"=>"student"
        ]);
    }
    public function getStudentsNotInTheCourse($id){
        $query = "SELECT id, f_name,l_name,email,username FROM users WHERE id NOT IN (SELECT student_id FROM student_courses WHERE course_id = :course_id) && rank = :rank";
        return $this->db->read($query,
        [
           "course_id"=>$id,
            "rank"=>"student"
        ]);
    }
    public function addStudentToACourse(int $studentId,int $courseId)
    {
        $query = "INSERT INTO student_courses (student_id,course_id) VALUES(:student_id,:course_id)";
        return $this->db->write($query,
            [
                "student_id"=>$studentId,
                "course_id"=>$courseId
            ]
        );
    }
    public function removeStudentFromACourse(int $student_id, int $course_id)
    {
        $query = "DELETE FROM student_courses WHERE student_id = :student_id AND course_id = :course_id";
        return $this->db->write($query,
        [
           "student_id"=>$student_id,
           "course_id" =>$course_id
        ]);
    }

    private function getCoursesFetchQuery($user_id, $rank):string
    {
        if($rank == "admin" || $rank == "technical"){
            $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id,c.description From users u join course c ON(c.lecturer_id = u.id)";
        }
        else if($rank == "lecturer"){
            $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id,c.description From users u join course c ON(c.lecturer_id = u.id) WHERE c.lecturer_id = :user_id";
        }
        else{
            $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id,c.description From student_courses s JOIN course c ON (s.course_id = c.id) JOIN users u ON (c.lecturer_id = u.id) WHERE s.student_id = :user_id";
        }
        return $query;
    }

    private function getCoursesFetchData($user_id, $rank):array
    {
        $data = array();
        if($rank != "admin" && $rank != "technical"){
            $data["user_id"] = $user_id;
        }
        return $data;
    }

    private function addCourseQuizesToData($course_id, bool|array $data)
    {
        $query = "SELECT id,name FROM quiz WHERE course_id = :course_id AND status = 'ready'";
        $quiz_data = $this->db->read($query,
        [
           "course_id"=>$course_id
        ]);
        $data["quiz_data"] = $quiz_data;
        return $data;
    }

    public function getCourseName(int $course_id)
    {
        $query = "SELECT name FROM course WHERE id = :course_id LIMIT 1";
        $data = $this->db->read($query,
        [
            "course_id"=>$course_id
        ]);
        return $data[0]->name;
    }


    public function addCourseAssignmentsToData($course_id,$data){
        $query = "SELECT id,name FROM assignment WHERE course_id = :course_id";
        $data["assignment_data"] = $this->db->read($query,
        [
            "course_id"=>$course_id
        ]);
        return $data;
    }

    public function addCourseAnnoucementToData($course_id,$data){
        $query = "SELECT * FROM announcement WHERE course_id = :course_id";
        $data["annoucement_data"] = $this->db->read($query,
        [
            "course_id"=>$course_id
        ]);
        return $data;
    }
}