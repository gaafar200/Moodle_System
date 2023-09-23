<?php

class Image extends Model
{
    public function uploadToFileSystem($image,$intended = "users") : string | array{
        $check = $this->getFileSystemReady($intended);
        if(!$check){
            return ["fileSystem"=>"Error writing to File System"];
        }
        $destinationPath = $this->createImageUniquePath($image,$intended);
        $check =  move_uploaded_file($image["image"]["tmp_name"],$destinationPath);
        if(!$check){
            return ["file-system"=>"failed to write to file system"];
        }
        return $this->getServerPath($destinationPath);
    }

    private function getFileSystemReady($intended) : bool
    {
        if(!file_exists($this->getImageDirectory($intended))){
            $check = $this->createImageDirectory($intended);
            if($check !== true){
                return false;
            }
        }
        return true;

    }
    private function createImageDirectory($intended): bool{
        return mkdir($this->getImageDirectory($intended),0777);

    }
    private function getImageDirectory($intended) : string{
        return  $_SERVER["DOCUMENT_ROOT"] . "/model/public/assets/data/" . $intended . "/";
    }
    public function isValidImage($image): Array | bool{
        if ($image['image']['error'] !== UPLOAD_ERR_OK) {
            return ["image"=>"Upload failed with error code " . $image['image']['error']];
        }
        $info = getimagesize($image['image']['tmp_name']);
        if ($info === FALSE) {
            return ["image"=>"please upload an image"];
        }
        return true;
    }

    private function createImageUniquePath($image,$intended) : String
    {
        $name = explode(".",$image["image"]["name"]);
        $ext = $name[1];
        $name = $name[0];
        $destinationPath = $this->getImageDirectory($intended) . $name . $this->generateRandomString(4) . "." . $ext;
        while(file_exists($destinationPath)){
            $destinationPath = $this->getImageDirectory($intended) . $name . $this->generateRandomString(4) . "." . $ext;
        }
        return $destinationPath;
    }

    private function getServerPath($destinationPath) : string
    {
        $replacement_parts = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
        return str_replace($_SERVER["DOCUMENT_ROOT"],$replacement_parts,$destinationPath);
    }
    private function getFileSystemPath($path): string
    {
        $replacement_parts = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
        return str_replace($replacement_parts,$_SERVER["DOCUMENT_ROOT"],$path);
    }
    public function deletephoto($imagePath) : bool
    {
        $path = $this->getFileSystemPath($imagePath);
        if(file_exists($path)){
            unlink($path);
            return true;
        }
        return false;
    }
    public function changePhoto($username,$image,$intended = "users")
    {
        $check = $this->isValidImage($image);
        if(is_array($check)){
            return $check;
        }
        $oldImagePath = $this->getOldImagePath($username,$intended);
        $this->deletephoto($oldImagePath);
        $newImagePath =  $this->uploadToFileSystem($image,$intended);
        $this->changeImagePath($oldImagePath,$newImagePath,$intended);
        return true;
    }

    private function changeImagePath($oldImagePath, $newImagePath,$intended)
    {
        $query = "UPDATE {$intended} SET photo = :newphoto WHERE photo = :oldphoto";
        $db = new database();
        $db->write($query,[
           "newphoto"=>$newImagePath,
           "oldphoto"=>$oldImagePath
        ]);
    }

    private function getOldImagePath($helping_data, mixed $intended)
    {
        switch($intended){
            case "users":
                $user = new Stud();
                $data = $user->getUserDataFromUsername($helping_data);
                $oldImagePath = $data[0]->photo;break;
            case "course":
                $course = new courses();
                $data = $course->getCourseData($helping_data);
                $oldImagePath = $data[0]->photo;break;
            case "question":
                $questionFactory = new NormalQuestionFactory();
                $question = $questionFactory->getQuestion();
                $data = $question->getQuestionData($helping_data["question"],$helping_data["course_id"]);
                $oldImagePath = $data[0]->photo;break;
        }
        return $oldImagePath;
    }

}