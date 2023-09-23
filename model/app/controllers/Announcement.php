<?php 

class Announcement extends Controller{
    private Announcements $announcement;

    public function __construct(){
        parent::__construct();
        $this->announcement = new Announcements();
    }
    public function index(int $course_id){
        $this->data["pageName"] = "Announcement control";
        $this->data["course_id"] = $course_id;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->announcement->deleteSpecificAnnouncement($_POST["announcement_id"]);
        }
        $this->data["announcement_data"] = $this->announcement->getAllAnnouncementData($course_id);
        $this->view("annoucenment-list",$this->data);
    }

    public function set(int $course_id){
        $this->data["pageName"] = "Set Annoucement";
        $this->data["course_id"] = $course_id;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $check = $this->announcement->storeNewAnnouncement($_POST,$course_id);
            if($check){
                $this->redirect("Announcement/" . $course_id);
            }
        } 
        $this->view("set-announcement",$this->data);
    }

    public function edit(int $announcement_id,int $course_id){
        $this->data["pageName"] = "Edit Announcement";
        $this->data["course_id"] = $course_id;
        $this->data["announcement_data"] = $this->announcement->getThisAnnouncementData($announcement_id);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $check = $this->announcement->EditAnnoucemntData($_POST,$announcement_id);
            if($check === true){
                $this->redirect("announcement/" . $course_id);
            }
        }
        $this->view("edit-announcement",$this->data);
    }

}