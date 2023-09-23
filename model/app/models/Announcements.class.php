<?php

class Announcements extends Model{
    private description $description;
    public function __construct(){
        parent::__construct();
        $this->description = new description();
    }

    public function storeNewAnnouncement($data,$course_id){
        $check = $this->validateAnnouncementData($data);
        if(is_array($check)){
            return $check;
        }
        return $this->storeItInTheDataBase($data,$course_id);
        
    }
    public function validateAnnouncementData($data){
        $check = $this->validateAnnouncementTitle($data["announcement-title"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    public function validateAnnouncementTitle($announcement_title):bool | array{
        if(!preg_match("/^[0-9A-Za-z ]+$/",$announcement_title)){
            return ["title"=>"Announcemnt title must consist of chars and letters only"];
        }
        return true;
    }

    public function storeItInTheDataBase($data,$course_id):bool{
        $query = "INSERT INTO announcement (title,content,course_id) VALUES(:title,:content,:course_id)";
        return $this->db->write($query,
        [
            "title"=>$data["announcement-title"],
            "content"=>$data["description"],
            "course_id"=>$course_id
        ]);

    }

    public function getAllAnnouncementData($course_id){
        $query = "SELECT * FROM announcement WHERE course_id = :course_id";
        return $this->db->read($query,
        [
            "course_id"=>$course_id
        ]);
    }

    public function deleteSpecificAnnouncement($announcement_id){
        $query = "DELETE FROM announcement WHERE id = :announcement_id";
        $this->db->write($query,
        [
            "announcement_id"=>$announcement_id
        ]);
    }

    public function getThisAnnouncementData($announcement_id){
        $query = "SELECT * FROM announcement WHERE id = :announcement_id LIMIT 1";
        return $this->db->read($query,
        [
            "announcement_id"=>$announcement_id
        ]);

    }

    public function EditAnnoucemntData($data,$announcement_id){
        $query = "UPDATE announcement SET title = :title, content = :content WHERE id = :id";
        return $this->db->write($query,
        [
            "title"=>$data["announcement-title"],
            "content"=>$data["description"],
            "id"=>$announcement_id
        ]);
    }

}