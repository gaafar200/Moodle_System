<?php

class File extends model
{
    public function uploadToFileSystem($file,$intended = "quiz") : string | array{
        $check = $this->getFileSystemReady($intended);
        if(!$check){
            return ["fileSystem"=>"Error writing to File System"];
        }
        $destinationPath = $this->createImageUniquePath($file,$intended);
        $check =  move_uploaded_file($file["tmp_name"],$destinationPath);
        if(!$check){
            return ["file-system"=>"failed to write to file system"];
        }
        return $this->getServerPath($destinationPath);
    }

    private function getFileSystemReady($intended) : bool
    {
        if(!file_exists($this->getFileDirectory($intended))){
            $check = $this->createFileDirectory($intended);
            if($check !== true){
                return false;
            }
        }
        return true;

    }
    private function createFileDirectory($intended): bool{
        return mkdir($this->getFileDirectory($intended),0777);

    }
    private function getFileDirectory($intended) : string{
        return  $_SERVER["DOCUMENT_ROOT"] . "/model/public/assets/data/" . $intended . "/";
    }
    public function isValidFile($file) {
        $allowed_types = array('image/jpeg', 'image/png', 'application/pdf');
        $max_size = 10 * 1024 * 1024; // 10 MB
        
        if ($file['error'] != UPLOAD_ERR_OK) {
          // There was an error uploading the file
          return false;
        }
        
        if (!in_array($file['type'], $allowed_types)) {
          // File type not allowed
          return false;
        }
        
        if ($file['size'] > $max_size) {
          // File size too large
          return false;
        }
        
        if ($file['type'] == 'application/pdf') {
          // File is a PDF
          $handle = fopen($file['tmp_name'], 'rb');
          $contents = fread($handle, 5);
          fclose($handle);
          
          if ($contents !== "%PDF-") {
            // File is not a valid PDF
            return false;
          }
        }
        
        // File passed all checks
        return true;
      }

    private function createImageUniquePath($image,$intended) : String
    {
        $name = explode(".",$image["name"]);
        $ext = $name[1];
        $name = $name[0];
        $destinationPath = $this->getFileDirectory($intended) . $name . $this->generateRandomString(4) . "." . $ext;
        while(file_exists($destinationPath)){
            $destinationPath = $this->getFileDirectory($intended) . $name . $this->generateRandomString(4) . "." . $ext;
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
    public function changeFile($username,$image,$intended = "quiz")
    {
        $check = $this->isValidFile($image);
        if(!$check){
            return ["file"=>"file is not valid"];
        }
        $oldImagePath = $this->getOldFilePath($username,$intended);
        $this->deletephoto($oldImagePath);
        $newImagePath =  $this->uploadToFileSystem($image,$intended);
        return $newImagePath;
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

    private function getOldFilePath($helping_data, mixed $intended)
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
            case "assignment":
                $assignment = new assignments();
                $data = $assignment->getAssignmentData($helping_data);
                $oldImagePath = $data[0]->assignment_material;
        }
        return $oldImagePath;
    }

}