<?php

class index extends Controller
{
    public function index(){
        $this->data["pageName"] = "Dashboard";
        $this->view("index",$this->data);
    }

}