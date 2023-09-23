<?php
class Model{
    public Auth $Auth;
    public database $db;
    public function __construct()
    {
        $this->db = new database();
        $this->Auth = new Auth();
    }
    public function generateRandomString($len,$mode = "all"):string{
        if($mode == "all"){
            $array = [0,1,2,3,4,5,6,7,8,9,
                'a','b','c','d','e','f','g',
                'h','i','j','k','l','m','n',
                'o','p','q','r','s','t','u',
                'v','w','x','y','z','A','B','C','D','E','F','G',
                'H','I','J','K','L','M','N',
                'O','P','Q','R','S','T','U',
                'V','W','X','Y','Z'];
        }
        elseif ($mode == "numbersOnly"){
            $array = [0,1,2,3,4,5,6,7,8,9];
        }

        $text = "";
        for($i = 0;$i < $len;$i++){
            $randChar = $array[rand(0,count($array) - 1)];
            $text .= $randChar;
        }
        return $text;
    }

}