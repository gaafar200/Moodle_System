<?php

class Home extends Controller
{
    public function index()
    {
        $this->data["pageName"] = "Dashboard";
        if($this->data["user"]){
            $this->view("index",$this->data);
        }
        else{
            $this->redirect("Login");
        }
    }
}