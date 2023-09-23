<?php

class studentAssignment extends Model{

    public function getStudnetAssignmentMarks($assignment_id){
        // $query = "SELECT u.id,u.f_name,u.l_name,sa.mark as mark,sa.id as student_assignment_id, attempt_number,a.name 
        // FROM users u JOIN student_assignment sa ON (u.id = sa.student_id) JOIN `assignment` a  ON (sa.assignment_id = a.id) 
        // WHERE a.id = :assignment_id 
        // ORDER BY sa.id DESC LIMIT 1";
        $query = "SELECT u2.id,u2.f_name,a2.name,u2.l_name,sa2.mark as mark,x.said as student_assignment_id,x.attempt_number as number_of_attempts FROM users u2 JOIN student_assignment sa2 ON(u2.id = sa2.student_id)JOIN `assignment` a2 ON(sa2.assignment_id = a2.id) JOIN 
(SELECT u.id, count(u.id) as attempt_number,max(sa.id) as said from users u JOIN student_assignment sa ON (u.id = sa.student_id) WHERE sa.assignment_id = :assignment_id group by u.id) as x
ON (x.id = u2.id AND sa2.id = x.said) WHERE sa2.assignment_id = :assignment_id;";
        ;
        return $this->db->read($query,[
            "assignment_id"=>$assignment_id
        ]);
    }    

    public function getAllAssignmentStudentDetails($assignment_id,$student_id){
        $query = "SELECT max(id) as last_attempt_id, max(attempt_number) as last_attempt,count(id) as number_of_attempts,delivered_time FROM student_assignment WHERE assignment_id = :assignment_id AND student_id = :student_id";
        return  $this->db->read($query,[
            "assignment_id"=>$assignment_id,
            "student_id"=>$student_id
        ]);
    }

    public function getStudentAttempt($attempt_id){
        $query = "SELECT * FROM student_assignment_files WHERE student_assignment_id = :attempt_id";
        return $this->db->read($query,
        [
            "attempt_id"=>$attempt_id
        ]);
    }

    public function addStudentAssignment($assignment_id,$student_id,$files){
        $file = new File();
        $check = $file->isValidFile($files);
        if(is_array($check)){
            return ["file","error File must be image or pdf"];
        }
        $path = $file->uploadToFileSystem($files,"assignment");
        if(is_array($path)){
            return $path;
        }
        return $this->uploadToDataBase($assignment_id,$student_id,$path);
    }
    public function uploadToDataBase($assignment_id,$student_id,$path){
        $last_trail = $this->getLastAttemptNumber($assignment_id,$student_id);
        if($last_trail == false || $last_trail[0]->last_attempt_number == NULL){
            $last_trail = 1;
        }
        else{
            $last_trail = $last_trail[0]->last_attempt_number + 1;
        }
        $query = "INSERT INTO student_assignment (student_id,assignment_id,attempt_number) 
        VALUES(:student_id,:assignment_id,:attempt_number)";
        $result = $this->db->write($query,
        [
            "student_id"=>$student_id,
            "assignment_id"=>$assignment_id,
            "attempt_number"=>$last_trail
        ]);
        if($result == false){
            return ["database"=>"Database Error"];
        }
        $student_assignment_id = $this->getStudentAssignmentId($student_id,$assignment_id,$last_trail);
        $query = "INSERT INTO student_assignment_files (file,student_assignment_id) VALUES(:path,:student_assignment_id)";
        return $this->db->write($query,[
            "path"=>$path,
            "student_assignment_id"=>$student_assignment_id
        ]);
    }

    public function getStudentAssignmentId($student_id,$assignment_id,$last_attempt){
        $query = "SELECT id FROM student_assignment WHERE student_id = :student_id AND assignment_id = :assignment_id AND attempt_number = :last_attempt";
        $result = $this->db->read($query,
        [
            "student_id"=>$student_id,
            "assignment_id"=>$assignment_id,
            "last_attempt"=>$last_attempt
        ]);
        return $result[0]->id;
    }


    public function getLastAttemptNumber($assignment_id,$student_id){
        $query = "SELECT max(attempt_number) as last_attempt_number FROM student_assignment
        WHERE student_id = :student_id AND assignment_id = :assignment_id";
        return $this->db->read($query,
        [
            "student_id"=>$student_id,
            "assignment_id"=>$assignment_id
        ]);
    }


    public function checkCanPerformAddAssignment($assignment_id, $student_id){
        $last_attempt = $this->getLastAttemptNumber($assignment_id,$student_id);
        if($last_attempt){
            $last_attempt = $last_attempt[0]->last_attempt_number;
        }
        $assignment = new Assignments();
        $max_attempts = $assignment->getMaxAttemptFromAssignment($assignment_id);
        if($last_attempt == NULL){
            return true;
        }
        if($last_attempt < $max_attempts){
            return true;
        }
        return false;
    }

    public function getLastAttempt($student_assignment_id){
        $query = "SELECT * FROM student_assignment_files saf JOIN student_assignment sa ON(saf.student_assignment_id = sa.id) WHERE saf.student_assignment_id = :student_assignment_id";
        return $this->db->read($query,
        [
            "student_assignment_id" => $student_assignment_id
        ]);
    }
    public function getAssignmentIdFromStudentAssignmentId($student_assignment_id){
        $query = "SELECT assignment_id From student_assignment WHERE id = :student_assignment_id";
        $result = $this->db->read($query,
        [
            "student_assignment_id"=>$student_assignment_id
        ]);
        if($result){
            return $result[0]->assignment_id;
        }

    }
    public function getCourseIdFromStudnetAssignmentId($student_assignment_id):int{
        $assignment_id = $this->getAssignmentIdFromStudentAssignmentId($student_assignment_id);
        $assignment = new Assignments();
        return $assignment->getCourseIdFromAssignmentId($assignment_id);

    }

    public function getStudentAssignment($student_assignment_id){
        $query = "SELECT * FROM student_assignment sa JOIN student_assignment_files saf ON(saf.student_assignment_id = sa.id) WHERE sa.id = :student_assignment_id LIMIT 1";
        return $this->db->read($query,
        [
            "student_assignment_id" => $student_assignment_id
        ]);

    }

    public function getMarkValue($assignment_id){
        $query = "SELECT mark_value FROM assignment WHERE id = :assignment_id";
        $result = $this->db->read($query,
        [
            "assignment_id"=>$assignment_id
        ]);
        if($result){
            return $result[0]->mark_value;
        }
    }

    public function validateMark($data){
        foreach($data as $id => $mark){
            if($mark < 0){
                return [$id => "Mark can not be negative"];
            }
            $assignment_id = $this->getAssignmentIdFromStudentAssignmentId($id);
            $mark_value = $this->getMarkValue($assignment_id);
            if($mark > $mark_value){
                return [$id => "Mark can not be greater than the total mark for the assignment"];
            }
        }
        return true;
    }

    public function manuaAssignmentlMark($data){
        $check = $this->validateMark($data);
        if(is_array($check)){
            return $check;
        }
        $query = "UPDATE student_assignment SET mark = :mark WHERE id = :id";
        foreach($data as $id => $mark){
            $this->db->write($query,
            [
                "mark"=>$mark,
                "id"=>$id
            ]);
        }
        return true;
    }
    public function checkIfAssignmentMarked($student_assignment_id)
    {
        $query = "SELECT mark FROM student_assignment WHERE id = :student_assignment_id";
        $data = $this->db->read(
            $query,
            [
                "student_assignment_id" => $student_assignment_id
            ]
        );
        if($data && $data[0]->mark != NULL){
            return true;
        }
        return false;

    }


    public function getGrade($id){
        $query = "SELECT mark FROM student_assignment WHERE id = :id";
        $result = $this->db->read($query,
        [
            "id"=>$id
        ]);
        if($result){
            return $result[0]->mark;
        }
        return false;
    }



}