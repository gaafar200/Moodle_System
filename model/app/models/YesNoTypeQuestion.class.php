<?php

class YesNoTypeQuestion extends Questions
{
    public function validateSpecificTypeData($data):bool | array{
        return  $this->ValidateRightAnswer($data["correct_answer"]);

    }
    private function ValidateRightAnswer($Correct_answer):bool | array
    {
        if($Correct_answer == "true" || $Correct_answer == "false"){
            return true;
        }
        return ["YorNAnswer"=>"please provide an acceptable answer"];
    }


    /**
     * @Override
     */
    public function getDataReady($data,$course_id,$image = ""):array{
        $data = parent::getDataReady($data,$course_id,$image);
        unset($data["choice1"]);
        unset($data["choice2"]);
        unset($data["choice3"]);
        unset($data["choice4"]);
        unset($data["correct_answers"]);
        return $data;
    }

    /**
     * @param $data
     * @return bool
     * @Override
     */
    public function addAnswersToTheQuestion($data):bool
    {
        $question_id = $this->getQuestionId($data["question"],$data["course_id"]);
        $choice = ["true","false"];
        $sql = "INSERT INTO question_choice (choice,is_right_answer,question_id) VALUES(:choice,:is_right_answer,:question_id)";
        for($i = 0;$i < 2;$i++){
             $is_correct = $choice[$i] == $data["correct_answer"] ? 1 : 0;
            if(!$this->db->write($sql,["choice"=>$choice[$i],"is_right_answer"=>$is_correct,"question_id"=>$question_id])){
                return false;
            }
        }
        return true;
    }

    public function editChoices(array $data): bool
    {
        $choice = ["true","false"];
        $query = "UPDATE question_choice SET is_right_answer = :is_right_answer WHERE question_id = :question_id AND choice = :choice";
        for($i = 0;$i < 2;$i++){
            $is_correct = $choice[$i] == $data["correct_answer"] ? 1 : 0;
            if(!$this->db->write($query,["choice"=>$choice[$i],"is_right_answer"=>$is_correct,"question_id"=>$data["question_id"]])){
                return false;
            }
        }
        return true;
    }

    function registerNewAnswer($question_id, $answer, $student_quiz_id): void
    {
        $true_Answer = $this->getTrueAnswer($question_id);
        $question_mark = $this->getQuestionMark($question_id);
        if($answer == $true_Answer[0]->choice){
            $mark = $question_mark;
        }
        else{
            $mark = 0;
        }
        $query = "UPDATE student_quiz_question SET grade = :grade,is_solved = 1 WHERE question_id = :question_id AND student_quiz = :student_quiz";
        $this->db->write($query,
        [
           "grade"=>$mark,
            "question_id"=>$question_id,
            "student_quiz"=>$student_quiz_id
        ]);
        $this->registerStudentChoice($question_id,$student_quiz_id,$answer);
    }

    private function getTrueAnswer($question_id)
    {
        $query = "SELECT choice FROM question_choice WHERE question_id = :question_id AND is_right_answer = '1' LIMIT 1";
        return $this->db->read($query,
        [
           "question_id"=>$question_id
        ]);
    }




}