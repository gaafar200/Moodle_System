<?php

class NormalQuestionFactory implements IQuestionFactory
{

    public function getQuestion($type = "none"): Questions
    {
        return new YesNoTypeQuestion();
    }
}