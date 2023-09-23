<?php
class SQuestion extends Controller{
    public IQuestionFactory $questionFactory;
    public Questions $question;
    public function getQuestion($question_type = "") : Questions{
        if($question_type == ""){
            $this->questionFactory = new NormalQuestionFactory();
            return $this->questionFactory->getQuestion();
        }else{
            $this->questionFactory = new SpecialQuestionFactory();
            return $this->questionFactory->getQuestion($question_type);
        }
    }
}