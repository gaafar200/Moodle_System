<?php

class SpecialQuestionFactory implements IQuestionFactory
{

    public function getQuestion(string $type = "none"): Questions
    {
        if($type == "Two"){
            return new MultibaleTypeQuestion();
        }
        else if($type == "Three"){
            return new EassyTypeQuestion();
        }
        else{
            return new YesNoTypeQuestion();
        }
    }
    public function getQuestionForTypeFromTheDataBase(string $type):Questions{
        if($type == "trueOrFalse"){
            return new YesNoTypeQuestion();
        }
        else if($type == "essayQuestion"){
            return new EassyTypeQuestion();
        }
        else if($type == "multiableChoice"){
            return new MultibaleTypeQuestion();
        }
        return new YesNoTypeQuestion();
    }
}