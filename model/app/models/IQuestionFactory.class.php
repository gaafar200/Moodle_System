<?php
interface IQuestionFactory{
    public function getQuestion(string $type = "none"): Questions;
}