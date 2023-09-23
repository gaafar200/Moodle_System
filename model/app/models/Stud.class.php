<?php
class Stud extends User
{
    public const RANK = "student";
    public function validateStudentData($data,$image)
    {
        return $this->validateBasicData($data, $image);
    }
    private function createUniqueUniversityId($gender)
    {
        $universityid = "";
        $universityid .= $gender == "male" ? 1 : 2;
        $universityid .= date("Y");
        $universityid .= $this->generateRandomString(4,"numbersOnly");
        return $universityid;
    }

    public function getAllStudent($username)
    {
        return $this->getAllUsersWithRank(self::RANK,$username);
    }

    public function deleteStudentFromSystem($username)
    {
        $query = "SELECT photo FROM users WHERE username = :username";
        $data = $this->db->read($query,
        [
            "username"=>$username
        ]);
        $this->image->deletephoto($data[0]->photo);
        $this->deleteStudentFromDataBase($username);
    }

    private function deleteStudentFromDataBase($username)
    {
        $query = "DELETE FROM users WHERE username = :username";
        $this->db->write($query,
        [
           "username"=>$username
        ]);
    }

    public function replacePhoto()
    {
    }

    public function searchForStudents($search)
    {
        $query = "SELECT * FROM users WHERE (f_name LIKE :name OR l_name LIKE :name OR username LIKE :name OR university_id = :id) AND rank = :rank ";
        $search = '%' . $search . '%';
        return $this->db->read($query,[
            "name"=>$search,
            "id"=>$search,
            "rank"=>"student"
        ]);
    }


    function handleDataBase($data, $image): bool
    {
        $query = "INSERT INTO users (university_id,f_name,l_name,address,phone_number,username,password,gender,email,photo,rank,created_by) VALUES(:university_id,:firstname,:lastname,:address,:mobileno,:username,:password,:gender,:email,:photo,:rank,:created_by)";
        return $this->db->write($query,$data);
    }

    /**
     * @override
     */
    function getDataReady(array $data, string $image): array
    {
        $data = parent::getDataReady($data,$image);
        $data["university_id"] = $this->createUniqueUniversityId($data["gender"]);
        $data["rank"] = self::RANK;
        return $data;
    }
    public function DoesStudentEnrolledInThisCourse(int $course_id,int  $student_id):bool
    {
        $query = "SELECT id FROM course JOIN student_courses ON (id=course_id) WHERE student_id = :student_id";
        $data = $this->db->read($query,
        [
           "student_id"=>$student_id
        ]);
        if($data){
            return true;
        }
        return false;
    }

    public function getStudentQuizData(int $student_id):array | bool
    {
        $query = "SELECT f_name,l_name,photo FROM users WHERE id = :student_id AND rank = 'student' LIMIT 1";
        return $this->db->read($query,
        [
           "student_id"=>$student_id
        ]);
    }
}