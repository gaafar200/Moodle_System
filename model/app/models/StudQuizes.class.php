<?php

class studQuizes extends Model
{
    public Stud $student;
    public Quizes $quiz;
    public function __construct()
    {
        parent::__construct();
        $this->student = new Stud();
        $this->quiz = new Quizes();
    }

    public function checkStudentCanPerformQuiz($student_data,$quiz_id,$course_id):bool{
        if($student_data->rank == "student" && $this->student->DoesStudentEnrolledInThisCourse($course_id,$student_data->id)){
            if($this->checkStudentAttempts($student_data->id,$quiz_id)){
                if($this->quiz->checkQuizTime($quiz_id) == "available"){
                    return true;
                }
            }
        }
        return false;
    }
    public function getNumberOfAttemptsForStudent(int $student_id,int $quiz_id):int{
        $query = "SELECT count(id) as student_attempts FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id";
        $data = $this->db->read($query,
        [
            "student_id"=>$student_id,
            "quiz_id"=>$quiz_id
        ]);
        if($data){
            return $data[0]->student_attempts;
        }
        return 0;
    }
    private function checkStudentAttempts($student_id, $quiz_id):bool
    {
        $student_attempts = $this->getNumberOfAttemptsForStudent($student_id,$quiz_id);
        $quiz_max_attempts = $this->quiz->getMaxAttempts($quiz_id);
        if($quiz_max_attempts){
            if($student_attempts < $quiz_max_attempts){
                return true;
            }
        }
        return false;
    }

    public function performQuiz(int $student_id, int $quiz_id):int
    {
        $data["attempt_number"] = $this->getNumberOfAttemptsForStudent($student_id,$quiz_id) + 1;
        $data["student_id"] = $student_id;
        $data["quiz_id"] = $quiz_id;
        $data["start_time"] = date("y-m-d h:i:s");
        $data["end_time"] = date("y-m-d h:i:s",strtotime("+15 minutes", strtotime($data["start_time"])));
        $query = "INSERT INTO student_quiz (student_id,quiz_id,attempt_number,start_time,end_time) VALUES(:student_id,:quiz_id,:attempt_number,:start_time,:end_time)";
        $this->db->write($query,$data);
        $student_quiz_id = $this->getStudentQuizId($student_id,$quiz_id,$data["attempt_number"]);
        $this->getAllQuestionForThisStudentQuiz($student_quiz_id,$quiz_id);
        return $student_quiz_id;
    }

    private function getStudentQuizId(int $student_id, int $quiz_id,int $attempt_number):int
    {
        $query = "SELECT id FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id AND attempt_number = :attempt_number LIMIT 1";
        $data = $this->db->read($query,
        [
           "student_id"=>$student_id,
           "quiz_id"=>$quiz_id,
           "attempt_number"=>$attempt_number
        ]);
        return $data[0]->id;
    }

    private function getAllQuestionForThisStudentQuiz(int $student_quiz_id,int $quiz_id):bool
    {
        $is_random_generated = $this->quiz->isRandom($quiz_id);
        $numberOfQuestions = $this->quiz->getNumberOfQuestions($quiz_id);
        $query = $this->getQuestionsQuery($is_random_generated,$numberOfQuestions,$student_quiz_id);
        return $this->db->write($query,[
           "quiz_id"=>$quiz_id
        ]);
    }

    private function getQuestionsQuery(bool $is_random_generated,int $numberOfQuestions,int $student_quiz_id):string
    {
        if($is_random_generated){
            $query = "INSERT INTO student_quiz_question (question_id,student_quiz) SELECT question_id,{$student_quiz_id} FROM quiz_questions WHERE quiz_id = :quiz_id ORDER BY RAND() LIMIT {$numberOfQuestions}";
        }
        else{
            $query = "INSERT INTO student_quiz_question (question_id,student_quiz) SELECT question_id,{$student_quiz_id} FROM quiz_questions WHERE quiz_id = :quiz_id LIMIT {$numberOfQuestions}";
        }
        return $query;
    }

    public function getProperPageNumber(int $page,int $student_quiz)
    {
        $expectedPageNumber = $this->getExpectedPageNumber($student_quiz);
        if($page <= 0){
            return $expectedPageNumber;
        }
        $maximumPageNumber = $this->getMaxiumPageNumber($student_quiz);
        if($page > $maximumPageNumber){
            return $expectedPageNumber;
        }
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz);
        $is_recursive = $this->quiz->isRecursive($quiz_id);
        if(!$is_recursive){
            if($page <= $expectedPageNumber){
                return $expectedPageNumber + 1;
            }
        }
        return $page;
    }

    private function getExpectedPageNumber(int $student_quiz):int
    {
        $query = "SELECT count(question_id)/3 as expectedPageNumber FROM student_quiz_question where student_quiz = :student_quiz AND is_solved = 1";
        $data = $this->db->read($query,
        [
            "student_quiz"=>$student_quiz
        ]);
        $pageNumber =  $data[0]->expectedPageNumber;
        if($pageNumber < 1){
            return 1;
        }
        return $pageNumber + 1;
    }

    private function getMaxiumPageNumber(int $student_quiz)
    {
        $query = "SELECT count(question_id)/3 as maxPageNumbers FROM student_quiz_question WHERE student_quiz = :student_quiz";
        $data = $this->db->read($query,
        [
           "student_quiz"=>$student_quiz
        ]);
        return $data[0]->maxPageNumbers;
    }

    public function getQuizIdFromStudentQuiz(int $student_quiz):int
    {
        $query = "SELECT quiz_id FROM student_quiz WHERE id = :student_quiz";
        $data = $this->db->read($query,
        [
           "student_quiz"=>$student_quiz
        ]);
        return  $data[0]->quiz_id;
    }

    public function getQuestionsForPage(int $pageNumber, int $student_quiz_id):array
    {
        $offset = 3 * ($pageNumber - 1);
        $query = "SELECT q.id as id,question,question_type as type,photo,mark_value FROM student_quiz_question JOIN question q ON(question_id = q.id) WHERE student_quiz = :student_quiz_id LIMIT 3 OFFSET {$offset}";
        $data = $this->db->read($query,
        [
           "student_quiz_id"=>$student_quiz_id
        ]);
        return  $this->addChoicesToThisQuestions($data);
    }

    public function getAllStudentAttempts(int $stud_id, int $quiz_id):array | bool
    {
        $query = "SELECT id,end_time FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id  ORDER BY (attempt_number) ASC";
        $data =  $this->db->read($query,
        [
           "student_id"=>$stud_id,
           "quiz_id"=>$quiz_id
        ]);
        if(is_array($data)){
            foreach ($data as $attempt):
                $attempt->grade = $this->getGradeForStudentAttempt($attempt->id);
            endforeach;
            $data = $this->getAllDatesRight($data);
            $data = $this->getAllAttemptsRight($stud_id,$quiz_id,$data);
        }
        return $data;
    }

    private function getAllDatesRight(array $data):array
    {
        foreach($data as $attempt){
            $attempt->end_time = $this->quiz->getTimeFormattedNicely($attempt->end_time);
        }
        return $data;
    }

    public function checkRightQuizForStudent(int $student_id,int $student_quiz_id):bool
    {
        $query = "SELECT id FROM student_quiz WHERE student_id = :student_id AND id = :student_quiz_id LIMIT 1";
        $data = $this->db->read($query,
        [
           "student_id"=>$student_id,
           "student_quiz_id"=>$student_quiz_id
        ]);
        if($data){
            return true;
        }
        return false;
    }

    private function addChoicesToThisQuestions(bool|array $data)
    {
        $query = "SELECT choice,is_right_answer FROM question_choice WHERE question_id = :question_id";
        $count = 1;
        foreach ($data as $question){
            $question->name = "answerer" . $count++;
            if($question->type != "essayQuestion"){
                $question->choices = $this->db->read($query,
                [
                    "question_id"=>$question->id
                ]);
                $question->CanHaveMultiableAnswers = $this->questionCanHaveMultiableAnswer($question);
            }
        }
        return $data;
    }

    private function questionCanHaveMultiableAnswer(mixed $question):bool
    {
        $count = 0;
        $counter = 0;
        $array = ["one","two","three","four"];
        foreach ($question->choices as $choice){
            if($question->type == "trueOrFalse"){
                $choice->name = "choice" . "-" .  $choice->choice;
            }
            else{
                $choice->name = "choice" . "-" .  $array[$counter++];
            }
            if($choice->is_right_answer == 1){
                $count++;
            }
        }
        if($count > 1){
            return true;
        }
        return false;
    }

    public function getNumberOfQuizQuestions(int $student_quiz_id)
    {
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz_id);
        return $this->quiz->getNumberOfQuestions($quiz_id);
    }

    public function getQuizTimeRemaining(int $student_quiz_id):array | bool
    {
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz_id);
        $quiz_duration = $this->quiz->getQuizDuration($quiz_id);
        $start_time = $this->getStartTime($student_quiz_id);
        $current_time = date('Y-m-d h:i:s');
        $now = new DateTime("$start_time");
        $ref = new DateTime("$current_time");
        $diff = $now->diff($ref);
        $data["hours"] = $diff->h;
        $data["minutes"] = $diff->i;
        $data["seconds"] = $diff->s;
        return $this->checkToSeeIfQuizStillOn($data,$quiz_duration);
    }

    private function getStartTime(int $student_quiz_id):string
    {
        $query = "SELECT start_time FROM student_quiz WHERE id = :student_quiz_id";
        $data = $this->db->read($query,
        [
           "student_quiz_id"=>$student_quiz_id
        ]);
        return $data[0]->start_time;
    }

    private function checkToSeeIfQuizStillOn(array $data, $quiz_duration)
    {
        $numberOfMin = $data["hours"] * 60 + $data["minutes"];
        $result = $quiz_duration - $numberOfMin;
        if($result <= 0){
            return false;
        }
        $data["hours"] = floor($result / 60);
        $data["minutes"] = $result % 60;
        if($data["seconds"] != 0){
            $data["minutes"] -= 1;
            $data["seconds"] = 60 - $data["seconds"];
        }
        return $data;
    }

    public function solveThisGroupOfQuestions($data,$student_quiz_id,$essayQuestions = "")
    {
        foreach($data as $key => $value){
            $this->registerNewQuestion($key,$value,$student_quiz_id);
        }
        if($essayQuestions != "" && is_array($essayQuestions)){
            foreach ($essayQuestions as $key => $value){
                $this->registerNewQuestion($key,$value,$student_quiz_id);
            }
        }

    }

    private function registerNewQuestion($question_id, $choice,$student_quiz_id)
    {
        $question = new YesNoTypeQuestion();
        $question_type = $question->getQuestionType($question_id);
        $question = $this->getQuestionForThisType($question_type);

        $question->registerNewAnswer($question_id,$choice,$student_quiz_id);
    }

    public function getNumberOfPages(int $student_quiz_id)
    {
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz_id);
        $query = "SELECT number_of_questions/3 as number_of_questions FROM quiz WHERE id = :quiz_id";
        $data =  $this->db->read($query,
        [
            "quiz_id"=>$quiz_id
        ]);
        return ceil($data[0]->number_of_questions);
    }

    public function FinishThisAttempt(int $student_quiz_id):bool
    {
        $query = "UPDATE student_quiz SET is_finished = '1' WHERE id = :student_quiz_id";
        return $this->db->write($query,
        [
            "student_quiz_id"=>$student_quiz_id
        ]);
    }

    private function getAllAttemptsRight(int $stud_id, int $quiz_id,array $data):array
    {
        $count = 1;
        foreach ($data as $attempt){
            if($attempt->grade == null){
                $attempt->grade = $this->getGradeForThisAttempt($stud_id, $quiz_id, $count);
            }
            $count++;
        }
        return $data;
    }

    private function getGradeForThisAttempt(int $stud_id, int $quiz_id, int $attempt_number):int
    {
        $query = "SELECT sum(grade) as grade FROM student_quiz_question WHERE student_quiz =  (SELECT id FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id AND attempt_number = :attempt_number LIMIT 1)";
        $data = $this->db->read($query,
        [
            "student_id"=>$stud_id,
            "quiz_id"=>$quiz_id,
            "attempt_number"=>$attempt_number
        ]);
        if($data){
            if($data[0]->grade == null){
                return 0;
            }
            return $data[0]->grade;
        }
        return 0;
    }

    public function checkQuizContinue(int $student_id,int $quiz_id):array | bool
    {
        $query = "SELECT id FROM student_quiz WHERE quiz_id = :quiz_id AND student_id = :student_id AND is_finished = 0 ORDER BY attempt_number DESC LIMIT 1";
        $data = $this->db->read($query,
        [
           "quiz_id"=>$quiz_id,
           "student_id"=>$student_id
        ]);
        if(!$data){
            return false;
        }
        $check = $this->getQuizTimeRemaining($data[0]->id);
        if(!$check){
            return false;
        }
        $data[0]->pageNumber = $this->getExpectedPageNumber($data[0]->id);
        return $data;
    }

    public function getStudentMarksInQuiz(int $quiz_id, int $course_id):bool | array
    {
        $query = "SELECT  f_name,l_name, university_id,q.name ,'N/A' as attempt_number,q.is_auto_correct as auto_correct, 'null' as student_quiz_id FROM users u join student_courses sc ON(u.id = sc.student_id ) JOIN quiz q on(sc.course_id=q.course_id) WHERE q.id=:quiz_id and sc.course_id = :course_id AND sc.student_id NOT IN (SELECT sq.student_id FROM users u JOIN student_quiz sq ON(u.id = sq.student_id) JOIN quiz q ON(q.id = sq.quiz_id) WHERE quiz_id = :quiz_id) UNION all SELECT u.f_name,u.l_name,university_id,q.name,sq.attempt_number as attempt_number,q.is_auto_correct as auto_correct,sq.id as student_quiz_id FROM users u JOIN student_quiz sq ON(u.id = sq.student_id) JOIN quiz q ON(q.id = sq.quiz_id) WHERE quiz_id = :quiz_id;";
        $data =  $this->db->read($query,
            [
                "quiz_id"=>$quiz_id,
                "course_id"=>$course_id
            ]);
        foreach ($data as $attempt){
            $attempt->grade = $this->getGradeForStudentAttempt($attempt->student_quiz_id);
        }
        return $data;
    }

    public function checkHasUnMarkedQuestions($student_quiz_id):bool
    {
        $query = "SELECT id FROM student_quiz_question WHERE grade IS NULL AND student_quiz = :quiz_id";
        $result = $this->db->read($query,
        [
            "quiz_id"=>$student_quiz_id
        ]);
        if($result){
            return true;
        }
        return false;
    }

    public function getStudentQuizDetails(int $student_quiz_id)
    {
        if($student_quiz_id != -1){
            $student_id = $this->getStudentIdFromStudentQuizId($student_quiz_id);
            $data["student_data"] = $this->student->getStudentQuizData($student_id);
            $data["quiz_questions"] = $this->getStudentQuizQuestions($student_quiz_id);
            return $data;
        }
        return false;
    }

    private function getStudentIdFromStudentQuizId(int $student_quiz_id)
    {
        $query = "SELECT student_id FROM student_quiz WHERE id = :student_quiz_id";
        $result = $this->db->read($query,
        [
            "student_quiz_id"=>$student_quiz_id
        ]);
        if($result){
            return $result[0]->student_id;
        }
        return -1;
    }

    private function getStudentQuizQuestions(int $student_quiz_id):array
    {
        $query = "SELECT q.question,q.mark_value,q.id,q.question_type,q.photo,sqq.grade,sqq.is_solved,sqq.id as student_quiz_question FROM student_quiz_question sqq JOIN question q ON (sqq.question_id = q.id)  WHERE sqq.student_quiz = :student_quiz_id; ";
        $data = $this->db->read($query,
        [
           "student_quiz_id"=>$student_quiz_id
        ]);
        foreach ($data as $question):
            $q = $this->getQuestionForThisType($question->question_type);
            $question->choices = $q->getQuestionChoices($question->id);
            if($question->choices && $question->is_solved == 1):
                $studentChosenAnswer = $this->getStudentChosenAnswer($question->student_quiz_question);
                foreach ($question->choices as $choice):
                    if($studentChosenAnswer == $choice->choice){
                        $choice->choosen = true;
                    }
                endforeach;
            else:
                if($question->is_solved == 1):
                    $question->answer = $this->getStudentEssayQuestionAnswer($question->student_quiz_question);
                endif;
            endif;
        endforeach;
        return $data;
    }
    public function getQuestionForThisType($question_type) :Questions{
        $question_factory = new SpecialQuestionFactory();
        return  $question_factory->getQuestionForTypeFromTheDataBase($question_type);
    }

    private function getStudentChosenAnswer($student_quiz_question):string
    {
        $query = "SELECT choice FROM student_quiz_question_choices WHERE student_quiz_question_id = :student_quiz_question_id";
        $data =  $this->db->read($query,
        [
           "student_quiz_question_id"=>$student_quiz_question
        ]);
        if($data){
            return $data[0]->choice;
        }
        return "";
    }

    private function getStudentEssayQuestionAnswer($student_quiz_question)
    {
        $query = "SELECT File,name FROM student_quiz_question_files WHERE student_quiz_question_id = :student_quiz_question_id";
        return  $this->db->read($query,
        [
           "student_quiz_question_id"=>$student_quiz_question
        ]);

    }

    public function getQuestionMarkFromStudentQuestion($id){
        $query = "SELECT question_id FROM student_quiz_question WHERE id = :id LIMIT 1";
        $result = $this->db->read($query,
        [
            "id"=>$id
        ]);
        if(is_array($result)){
            return $result[0]->question_id;
        }
        return -1;
    }

    public function getQuestionMark($id){
        $query = "SELECT mark_value From question WHERE id = :id";
        $result = $this->db->read($query,
        [
            "id" => $id
        ]);
        if(is_array($result)){
            return $result[0]->mark_value;
        }
        return -1;
    }

    public function validateQuizMarks($data){
        foreach ($data as $student_question_id => $grade){
            if($grade < 0){
                return [$student_question_id => "Grade Can not be negative"];
            }
            $question_id = $this->getQuestionMarkFromStudentQuestion($student_question_id);
            $question_mark = $this->getQuestionMark($question_id);
            if($grade > $question_mark){
                return [$student_question_id => "The grade is larger than the question grade"];
            }
        }
        return true;   
    }

    public function manualMark(array $data)
    {
        $check = $this->validateQuizMarks($data);
        if(is_array($check)){
            return $check;
        }
        $query = "UPDATE student_quiz_question SET grade = :grade WHERE id = :student_question_id";
        foreach ($data as $student_question_id => $grade){
            $this->db->write($query,
            [
                "student_question_id"=>$student_question_id,
                "grade"=>$grade
            ]);
        }
        return true;
    }

    public function getDataToDisplayStudentMarks(int $student_quiz_id)
    {
        $data["quiz_id"] = $this->getQuizIdFromStudentQuiz($student_quiz_id);
        $data["course_id"] = $this->quiz->getCourseId($data["quiz_id"]);
        return $data;

    }

    private function getGradeForStudentAttempt($id):int
    {
        $query = "SELECT sum(grade) as grade FROM student_quiz_question WHERE student_quiz = :student_quiz AND is_solved = 1";
        $data = $this->db->read($query,
        [
           "student_quiz"=>$id
        ]);
        if($data && $data[0]->grade != null){
            return $data[0]->grade;
        }
        return 0;
    }

    public function checkStuentQuizMarkDisclosed($studnet_quiz_id){
        $quiz_id = $this->getQuizIdFromStudentQuiz($studnet_quiz_id);
        $quiz = new Quizes();
        return $quiz->isMarksDisclosed($quiz_id);
    }


    public function getAllStudentQuizDetails($student_quiz_id){
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz_id);
        $quiz = new Quizes();
    }


    public function getMarkForStudentQuestion($student_question_id){
        $query = "SELECT grade FROM student_quiz_question WHERE id = :student_question_id LIMIT 1";
        $result = $this->db->read($query,[
            "student_question_id"=> $student_question_id
        ]);
        if($result){
            return $result[0]->grade;
        }
        return 0;
    }


}