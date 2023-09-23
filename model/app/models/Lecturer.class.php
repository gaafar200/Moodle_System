<?php

class lecturer extends User
{
    public description $description;
    public function __construct()
    {
        parent::__construct();
        $this->description = new description();
    }

    public function validateProfData($data,$image)
    {
        $check = $this->validateBasicData($data,$image);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }
    /**
     * @override
     */
    public function validateEditBaseData($data){
        $check = parent::validateEditBaseData($data);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    /**
     * @override
     */
    public function handleDataBase($data,$image):bool
    {
        $query = "INSERT INTO users (f_name,l_name,address,phone_number,gender,username,password,email,photo,rank,description,created_by) VALUES(:firstname,:lastname,:address,:mobileno,:gender,:username,:password,:email,:photo,:rank,:description,:created_by)";
        return $this->db->write($query,$data);
    }

    /**
     * @override
     */
    function getDataReady(array $data,string $image): array
    {
        $data = parent::getDataReady($data,$image);
        $data["rank"] = "lecturer";
        return $data;
    }

    public function getAllLecturers($username)
    {
        return $this->getAllUsersWithRank("lecturer",$username);
    }
    public function deleteProfessor($username)
    {
        if($this->Auth->hasRightPrivilege("techEmployee")){
            $checkIfProfessorExists = $this->checkIfProfessorExists($username);
            if($checkIfProfessorExists === false){
                return ["lecturer"=>"lecturer does not exists"];
            }
            $photoDeleted = $this->image->deletephoto($checkIfProfessorExists[0]->photo);
            $result = $this->delete($username);
            if($result !== true){
                return ["lecturer"=>"failed to delete lecturer"];
            }
            return true;
        }
        return ["lecturer"=>"you don't have the right Privilege to perform this action"];
    }

    public function checkIfProfessorExists($username)
    {
        $data = $this->getUserDataFromUsername($username);
        if($data){
            if($data[0]->rank == "lecturer"){
                return $data;
            }
        }
        return false;
    }
    public function EditProfessorData($data)
    {
        $query = "UPDATE users SET f_name = :firstname,
                 l_name = :lastname,
                 address = :address,
                 phone_number = :mobileno,
                 email = :email,
                 gender = :gender,
                 description = :description
                 WHERE username = :username";
        $this->db->write($query,$data);
        return true;
    }

    public function searchForProfessors($search)
    {
        $query = "SELECT * FROM users WHERE (f_name LIKE :name OR l_name LIKE :name OR username LIKE :name) AND rank = :rank ";
        $search = '%' . $search . '%';
        return $this->db->read($query,[
           "name"=>$search,
            "rank"=>"lecturer"
        ]);
    }

    public function DoesThisLecturerTeachThisCourse(int $course_id,int $lecturer_id):bool
    {
        $query = "SELECT id FROM course WHERE id = :course_id AND lecturer_id = :lecturer_id LIMIT 1";
        $data = $this->db->read($query,
        [
            "course_id"=>$course_id,
            "lecturer_id"=>$lecturer_id
        ]);
        if($data){
            return true;
        }
        return false;
    }


}