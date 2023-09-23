<?php

class Controller
{
    public Auth $Auth;
    public User $user;
    public array $data = array();
    public function __construct()
    {
        $this->Auth = new Auth();
        $result = $this->Auth->is_logged_in();
        if($result){
            $this->data["user"] = $result[0];
       }
        else{
            $this->redirect("Login");
        }
    }

    public function view($path , $data = [])
    {
        extract($data);
        if(file_exists("../app/views/" . $path . ".view.php"))
        {
            include "../app/views/" . $path . ".view.php";
        }
    }
    public function redirect($path = ""){
        header("Location: " . ROOT . $path);
        die;
    }
    public function forbidden(){
        $response = new Response();
        $response->setStatusCode(403);
        $this->data["pageName"] = "Access Denied";
        $this->view("Forbidden",$this->data);
    }

}