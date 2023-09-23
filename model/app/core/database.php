<?php

class database
{
    public static $con = null;
    public function __construct()
    {
        try{
            $dsn = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME .";";
            self::$con = new PDO($dsn,DB_USER,DB_PASS);
        }catch (PDOException $e){
            die("database Error: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if(self::$con){
            return self::$con;
        }
        return $instance=new self();
    }

    public function read($query,$data=array()){
        $stm=self::$con->prepare($query);
        $result=$stm->execute($data);

        if($result){
            $data=$stm->fetchAll(PDO::FETCH_OBJ);
            if(count($data)>0){
                return $data;
            }
        }
        return false;
    }


    public function write( $query , $data = array() )
    {
        $stm=self::$con->prepare($query);
        $result=$stm->execute($data);

        if($result){
            return true;
        }
        return false;

    }

}