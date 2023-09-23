<?php

class EassyTypeQuestion extends Questions
{

    function validateSpecificTypeData($data): bool|array
    {
        return true;
    }

    function addAnswersToTheQuestion($data): bool
    {
        return true;
    }

    public function editChoices(array $data): bool
    {
        // TODO: Implement editChoices() method.
    }

    public function registerNewAnswer($question_id, $answer, $student_quiz_id):void
    {
        $query = "UPDATE student_quiz_question set is_solved = '1' WHERE question_id = :question_id AND student_quiz = :student_quiz";
        $this->db->write($query,
        [
           "question_id"=>$question_id,
           "student_quiz"=>$student_quiz_id
        ]);
        $student_quiz_question_id = $this->getStudentQuizQuestionId($question_id,$student_quiz_id);
        if($answer["error"] == 0){
            $this->registerAnswerValue($answer,$student_quiz_question_id);
        }
    }

    private function registerAnswerValue($answer,$student_quiz_question_id):bool
    {
        $file = new File();
        $filePath = $file->uploadToFileSystem($answer);
        if(is_array($filePath)){
            return false;
        }
        $name = $answer["name"];
        $query = "INSERT INTO student_quiz_question_files (student_quiz_question_id,File,name) VALUES(:student_quiz_question_id,:file,:name)";
        $this->db->write($query,
        [
           "student_quiz_question_id"=>$student_quiz_question_id,
            "file"=>$filePath,
            "name"=>$name
        ]);
        return true;
    }
}