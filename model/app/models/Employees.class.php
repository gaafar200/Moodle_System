<?php
class Employees extends User
{
    public const RANK = "technical";
    public function ValidateData($data,$image)
    {
        return $this->validateBasicData($data,$image);
    }

    /**@override */
    function handleDataBase($data, $image): bool
    {
        $query = "INSERT INTO users (f_name,l_name,address,phone_number,username,password,gender,email,photo,rank,created_by) VALUES(:firstname,:lastname,:address,:mobileno,:username,:password,:gender,:email,:photo,:rank,:created_by)";
        return $this->db->write($query,$data);
    }

    /** @override */
   public function getDataReady(array $data, string $image): array
    {
        $data = parent::getDataReady($data,$image);
        $data["rank"] = self::RANK;
        return $data;
    }
    public function getAllTechnicals($username){
       return $this->getAllUsersWithRank("technical",$username);
    }
}