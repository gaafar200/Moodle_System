<?php

class Admin extends Controller
{
    public function profile(){
        $this->data["pageName"] = "Admin Profile";
        $this->view("admin-profile",$this->data);
    }

}