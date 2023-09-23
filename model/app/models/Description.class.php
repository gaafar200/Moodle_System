<?php

class description
{
    public function isValidDescription($description)
    {
        if(strlen($description) < 3){
            return ["description"=>"Description can not be less than 3 characters"];
        }
        if(!preg_match("/^[A-Za-z0-9 ]+$/",$description)){
            var_dump("hi");
            return["description"=>"description must only consist of Characters and numbers"];
        }
        return true;
    }

}