<?php
Abstract class User extends Model
{
    public Image $image;
    public function __construct(){
        parent::__construct();
        $this->image = new Image();
    }

    public function validateLoginData($data)
    {
        $username = isset($data["username"]) ? $data["username"] : false;
        $password = isset($data["password"]) ? $data["password"] : false;
        $check = $this->validateusername($username);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validatePassword($password);
        if(is_array($check)){
            return $check;
        }

        return true;
    }
    public function validateBasicData($data,$image){
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $image = isset($image) ? $image : false;
        $check = $this->isVaildName($firstname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildName($lastname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidAddress($address);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMobilNo($mobileno);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidEmail($email);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidUserName($username);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validatePassword($password);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validategender($gender);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateThePasswords($password,$confirmpassword);
        if(is_array($check)) {
            return $check;
        }
        if(!$this->image->isValidImage($image)){
            return ["image"=>"please upload an image"];
        }

        return true;
    }
    public function validateEditBaseData($data){
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->isVaildName($firstname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildName($lastname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidAddress($address);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMobilNo($mobileno);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidEmail($email);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validategender($gender);
        if (is_array($check)) {
            return $check;
        }
        return true;
    }
    public function editUserData($data){
        $query = "UPDATE users SET f_name = :firstname,
                 l_name = :lastname,
                 address = :address,
                 phone_number = :mobileno,
                 gender = :gender,
                 email = :email 
             WHERE username = :username";
        return $this->db->write($query,$data);
    }

    public function validateusername($username)
    {
       if($username === false){
            return ["username"=>"The UserName is Required"];
       }
       if(strlen($username) < 6){
            return ["username"=>"username must be at least 6 characters"];
       }
       if(!preg_match("/^[0-9A-Za-z]+$/",$username)){
           return ["username"=>"username must only consist of characters and numbers"];
       }
        return true;
    }

    protected function validatePassword($password)
    {
        if(!$password){
            return ["password"=>"The password is Required"];
        }
        if(strlen($password) <= 4){
            return["password"=>"password is too short"];
        }
        return true;
    }
    protected function validategender($gender){
        $genders = ["male","female"];
        if(!$gender){
            return ["gender"=>"gender must be specified"];
        }
        if(!in_array($gender,$genders)){
            return ["gender"=>"please choose valid gender"];
        }
        return true;
    }

    protected function isVaildName($name){
        if(!$name){
            return ["name"=>"the name can't be empty"];
        }
        if(!preg_match("/^[a-zA-Z]+$/",$name)){
            return ["name"=>"name must consist of chars only"];
        }
        return true;
    }
    protected function isValidAddress($address){
        if(!$address){
            return ["address"=>"The Address can't be empty"];
        }
        if(!preg_match("/^[A-Za-z0-9 -_|]+$/",$address)){
            return ["name"=>"this is not a valid address"];
        }
        return true;
    }
    protected function isValidMobilNo($mobileNo){
        if(!$mobileNo){
            return ["mobile"=>"Mobile number can't be empty"];
        }
        if(!preg_match("//",$mobileNo) && strlen($mobileNo) < 9 || strlen($mobileNo) > 10){
            return ["mobile"=>"Mobile Number is not valid"];
        }
        return true;
    }
    protected function isValidEmail($email){
        if(!$email){
            return ["email"=>"email can't be empty"];
        }
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        if(!preg_match("/^[a-zA-Z0-9-.]+@[a-z]+.[a-z]+$/",$email)){
            return ["email"=>"email is not valid"];
        }
        return true;
    }
    protected function validateThePasswords($password,$password2){
        if($password !== $password2){
            return ["passwords"=>"passwords doesn't match"];
        }
        return true;
    }
    public function isValidUserName($username){
        $check = $this->validateusername($username);
        if(is_array($check)){
            return $check;
        }
        if($this->checkIfUserExists($username)){
            return ["username"=>"username already exists"];
        }
        return true;
    }

    private function checkIfUserExists($username)
    {
        $query = "SELECT username,photo FROM users WHERE username = :username LIMIT 1";
        $data = $this->db->read($query,[
            "username"=>$username
        ]);
        if(is_array($data) && !empty($data)){
            return $data;
        }
        return false;
    }
    protected function getCreatorId()
    {
        $Auth = new Auth();
        $data = $Auth->is_logged_in();
        return $data[0]->id;
    }

    public function getUserDataFromUsername($username){
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $data = $this->db->read($query,[
            "username"=>$username
        ]);
        return $data;
    }
    protected function getAllUsersWithRank($rank,$username){
        $query = "SELECT * FROM users WHERE users.rank = :rank AND username != :username";
        return $this->db->read($query,
        [
            "rank"=>$rank,
            "username"=>$username
        ]);
    }
    public  function registerUser($data,$image): bool {
        $check = $this->applyStrickPrivilege();
        if($check === true) {
            $image = $this->handleImage($image);
            $data = $this->getDataReady($data,$image);
            return $this->handleDataBase($data, $image);
        }
        return false;
    }
    public function deleteUser($username) : bool | array
    {
        $check = $this->applyStrickPrivilege();
        if($check === true){
            $check = $this->checkIfUserExists($username);
            if($check){
                $photoDeleted = $this->image->deletephoto($check[0]->photo);
                $result = $this->delete($username);
                if($result !== true){
                    return ["lecturer"=>"failed to delete lecturer"];
                }
                return true;
            }
            else{
                return ["lecturer"=>"lecturer does not exists"];
            }

        }
        else{
            return ["user"=>"you don't have the right Privilege to perform this action"];
        }
    }
    public function delete($username)
    {
        $query = "DELETE FROM users WHERE username = :username";
        return $this->db->write($query,[
            "username"=>$username
        ]);
    }

    private function applyStrickPrivilege()
    {
        return $this->Auth->hasRightPrivilege("technical");
    }

    private function handleImage($image):string
    {
        return $this->image->uploadToFileSystem($image);
    }

    abstract function handleDataBase($data,$image):bool;
    public function getDataReady(array $data,string $image):array{
        unset($data["confirmpassword"]);
        $data["photo"] = $image;
        $data["password"] = sha1($data["password"]);
        $data["created_by"] = $this->getCreatorId();
        return $data;
    }


}