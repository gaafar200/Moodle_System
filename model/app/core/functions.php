<?php

function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * start User Info part
 */
function checkVaildData($lecturerData){
    if(isset($lecturerData) && is_array($lecturerData) && !empty($lecturerData)){
        return true;
    }
    return false;
}
function displayFirstName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->f_name;
}
function displayLastName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->l_name;
}
function displayAddress($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->address;
}
function displayMobileNumber($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->phone_number;
}
function displayEmailAddress($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->email;
}
function displayUserName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->username;
}

function setUserName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return "readonly";
}
function displayGender($data,$gender){
    if(checkVaildData($data) === false){
        return "";
    }
    if($data[0]->gender == $gender){
        return "selected";
    }
}
function displayLecturerDiscription($data){
    if(checkVaildData($data) === false){
        return "";
    }
    return $data[0]->description;
}
/**
 * end user Info Part
 */

/**
 * start Course Info part
 */
function checkValidCourseData($data){
    if(is_array($data) && !empty($data)){
        return true;
    }
    return false;
}
function displayCourseName($data){
    if(checkValidCourseData($data)){
        return $data[0]->name;
    }
    return "";
}
function displayCourseDescription($data){
    if(checkValidCourseData($data)){
        return $data[0]->description;
    }
    return "";
}
function displayCourseLecturerUsername($data){
    if(checkValidCourseData($data)){
        return $data[0]->username;
    }
    return "";
}

function displayOldCourseName($data){
    if(checkValidCourseData($data)){
        return $data["coursename"];
    }
    return "";   
}

function displayOldCourseDescription($data){
    if(checkValidCourseData($data)){
        return $data["description"];
    }
    return "";
}

function displayOldProfessorUsername($data){
    if(checkValidCourseData($data)){
        return $data["professorusername"];
    }
    return "";
}




/**
 * Authorization Section
 */
function checkAuthorization($requiredAuthoriztion){
    $Auth = new Auth();
    return $Auth->hasRightPrivilege($requiredAuthoriztion);
}

/**
 * Quiz Data Section
 */
function checkQuizDataIsValid($data){
    if(is_array($data)){
        return true;
    }
    return false;
}
function displayQuizName($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->name;
    }
    return " ";
}
function displayQuizDate($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->quiz_date;
    }
    return " ";
}
function displayQuizStartTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->start_time;
    }
    return " ";
}
function displayQuizEndTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->end_time;
    }
    return " ";
}
function displayQuizNumberOfQuestions($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->number_of_questions;
    }
    return " ";
}
function displayQuizTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->time;
    }
    return " ";
}
function displayQuizMark($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->mark_value;
    }
    return " ";
}
function displayQuizMaxAttempts($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->max_attempts;
    }
    return " ";
}
function checkQuizMoveBetweenQuestions($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_recursive == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizAutoCorrect($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_auto_correct == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizShuffled($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_shuffled == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizDisclosed($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_disclosed == $value){
            return "selected";
        }
    }
    return " ";
}
function DisplayQuizDescription($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->description;
    }
    return " ";
}
/**
 * Questions Section
 */
function checkFieldOkay($data,$type = ""):bool{
    if(isset($data)){
        if($type == ""){
            return true;
        }
        else{
            if($type == $data[0]->question_type){
                return true;
            }
        }
    }
    return false;
}
 function displayQuestion($data){
    if(checkFieldOkay($data)){
        return $data[0]->question;
    }
    return "";
 }

 function displayQuestionMark($data){
    if(checkFieldOkay($data)){
        return $data[0]->mark_value;
    }
    return "";
 }
 function checkIfQuestionIsOfThisType($data,$type){
    if(checkFieldOkay($data)){
        if($type == "One" && $data[0]->question_type == "trueOrFalse"){
            return "Selected";
        }
        else if($type == "Two" && $data[0]->question_type == "multiableChoice"){
            return "Selected";
        }
        else if($type == "Three" && $data[0]->question_type == "essayQuestion"){
            return "Selected";
        }
    }
    return "";
 }
 function checkIfThisIsRightAnswer($question_data, $choice,$type):string{
    if(checkFieldOkay($question_data,$type)){
        if($choice->is_right_answer == 1){
            return "Selected";
        }
    }
    return "";
 }
 function checkIfQuestionHaveMultibleAnswer($data,$choice,$type,$value){
    if(checkFieldOkay($data,$type)){
        $count = 0;
        foreach ($choice as $c){
            if($c->is_right_answer == 1){
                $count++;
            }
        }
        if($count > 1 && $value == "yes"){
            return "Selected";
        }
        else if($count == 1 && $value == "no"){
            return "Selected";
        }
    }
    return "";
 }

 function displayQuestionChoice($data,$choice,$type){
     if(checkFieldOkay($data,$type)){
         return $choice->choice;
     }
     return "";
 }
 function displayQuestionCorrectAnswers($data,$choice,$type){
    if(checkFieldOkay($data,$type)){
        $count = 0;
        $correctAnswer = "";
        for($i = 0;$i < sizeof($choice);$i++){
            if($choice[$i]->is_right_answer == 1){
                if($count == 0){
                    $correctAnswer = "" . ($i + 1);
                    $count++;
                }
                else{
                    $correctAnswer .= "&" . ($i + 1);
                }
            }
        }
        return $correctAnswer;
    }
    return "";
 }

/**
 * @return string
 *
 */
 function checkCanAddMoreQuestions($question_mark,$marks_left,$number_of_questions_left):string{
     if($question_mark > $marks_left){
         return "disabled";
     }
     if($number_of_questions_left == 0){
         return "disabled";
     }
     return "";
 }
 function isActiveButtonActive($quiz_status):string{
     if($quiz_status == "inactive"){
         return "disabled";
     }
     return "";
 }
function displayCourseSideBar():string{
    
}

/**
 * Quiz Details
 */
function displayQuizDateDetails($quiz_start_date,$quiz_end_date,$status):string{
    if($status == "closed"){
        return $quiz_start_date;
    }
    else{
        return $quiz_end_date;
    }
}
function displayQuizDateStat($status):string{
    if($status == "closed"){
        return "The quiz will be open on ";
    }
    else if($status == "available"){
        return "The quiz will close on ";
    }
    else{
        return "The quiz closed on ";
    }
}
function displayGrade($grade,$status,$student_quiz_id):string{
    $studQuizes = new studQuizes();
    if($status == "finished" && !$studQuizes->checkHasUnMarkedQuestions($student_quiz_id) && $studQuizes->checkStuentQuizMarkDisclosed($student_quiz_id)){
        return $grade;
    }
    return "";
}
function displayTimeValue($value):string{
    if($value < 10){
        return "0" . $value;
    }
    return $value;
}
function displayMaxGrade($quiz_attempts):int{
    $max = 0;
    foreach ($quiz_attempts as $attempt){
        if($attempt->grade > $max){
            $max = $attempt->grade;
        }
    }
    return  $max;
}
function displayStudentQuizGrade($grade):string{
    if($grade == "not attempted" || $grade == NULL){
        return "N/A";
    }
    return $grade;
}
function displayMark($auto_correct,$student_quiz_id):string{
    $studQuizes = new studQuizes();
    if($auto_correct == "yes" || $student_quiz_id == "null" || !$studQuizes->checkHasUnMarkedQuestions($student_quiz_id)){
        return "disabled";
    }
    return "";
}
function checkCanEditCorrection($quiz_id):string{
    $quiz = new Quizes();
    if($quiz->checkIfQuizHaveEssayQuestion($quiz_id)){
        return "disabled";
    }
    return "";
}
function canReview($status,$student_quiz_id):bool{
    $studQuizes = new studQuizes();
    if($status == "finished" && !$studQuizes->checkHasUnMarkedQuestions($student_quiz_id) && $studQuizes->checkStuentQuizMarkDisclosed($student_quiz_id)){
        return true;
    }
    return false;

}
function getAutoValue($getAutoValue):string{
    if($getAutoValue){
        return "no";
    }
    return "";
}
function checkQuestionSelected($data):string{
    if(isset($data->choosen) && $data->choosen == 1){
        return "checked";
    }
    return "disabled";
}
function getCurrentMarkOfAQuestion($question_type,$is_solved,$grade){
    if($question_type != "essayQuestion"){
        if($is_solved == 1) {
            return $grade;
        }
    }
}
function getFileNameFromPath($filePath){
    $fileParts = explode("/",$filePath);
    return end($fileParts);
}

function displayUserOldFirstName($data){
    if(checkVaildData($data)){
        return $data["firstname"];
    }
    return "";
}

function displayUserOldLastName($data){
    if (checkVaildData($data)) {
        return $data["lastname"];
    }
    return "";
}

function displayUserOldAddress($data)
{
    if (checkVaildData($data)) {
        return $data["address"];
    }
    return "";
}


function SelectUserOldGender($data,$gender)
{
    if (checkVaildData($data)) {
        if($data["gender"] == $gender){
            return "Selected";
        }
    }
    return "";
}

function displayUserOldMobileNumber($data){
    if(checkVaildData($data)){
        return $data["mobileno"];
    }
    return "";
}

function displayUserOldEmail($data){
    if (checkVaildData($data)) {
        return $data["email"];
    }
    return "";
}

function displayUserOldUsername($data){
    if (checkVaildData($data)) {
        return $data["username"];
    }
    return "";
}

function displayOldDescription($data){
    if (checkVaildData($data)) {
        return $data["description"];
    }
    return "";
}



/* Assignment Section **/
function checkAssignmentData($data):bool{
    if(is_array($data)){
        return true;
    }
    return false;
}
function displayAssignmentName($data){
    if(checkAssignmentData($data)){
        return $data[0]->name;
    }
    return "";
}

function displayStartDate($data){
    if(checkAssignmentData($data)){
        return $data[0]->start_date;
    }
    return "";
}

function displayEndDate($data){
    if(checkAssignmentData($data)){
        return $data[0]->deadline;
    }
    return "";
}

function displayAssignmentLastDate($data){
    if(checkAssignmentData($data)){
        return $data[0]->last_submition_date;
    }
    return "";
}

function displayMarkValue($data){
    if(checkAssignmentData($data)){
        return $data[0]->mark_value;
    }
    return "";
}

function displayNumberOfAttempts($data){
    if(checkAssignmentData($data)){
        return $data[0]->max_attempts;
    }
    return "";
}
function displayAssignmentDescription($data){
    if(checkAssignmentData($data)){
        return $data[0]->description;
    }
    return "";
}

function displayAssignmentSubmision($data){
    if(!$data){
        return "No Attempts";
    }
    $fileArray = explode("/",$data[0]->file);
    $file = end($fileArray); 
    return  $file;
}

function displayAssignmentDeadLine($date){
    return date('l, d F', strtotime("$date"));
}

function calculateTimeRemaining($dateString) {
    // Convert the date string to a Unix timestamp
    $timestamp = strtotime($dateString);
    
    // Calculate the time remaining in seconds
    $timeRemaining = $timestamp - time();
    
    // Calculate the number of days, hours, and minutes remaining
    $daysRemaining = floor($timeRemaining / 86400);
    $hoursRemaining = floor(($timeRemaining % 86400) / 3600);
    $minutesRemaining = floor(($timeRemaining % 3600) / 60);
    
    // Return the time remaining as an associative array
    return array(
        'days' => $daysRemaining,
        'hours' => $hoursRemaining,
        'minutes' => $minutesRemaining
    );
}
function displayAssignmentRemainingTime($dateString){
    $timeRemaining = calculateTimeRemaining($dateString); // Calculate the time remaining

    // Create an array of the non-zero time units
    $nonZeroUnits = array();
    if ($timeRemaining['days'] > 0) {
        $nonZeroUnits[] = $timeRemaining['days'] . ' days';
    }
    if ($timeRemaining['hours'] > 0) {
        $nonZeroUnits[] = $timeRemaining['hours'] . ' hours';
    }
    if ($timeRemaining['minutes'] > 0) {
        $nonZeroUnits[] = $timeRemaining['minutes'] . ' minutes';
    }

    // Check if there are any non-zero units
    if (count($nonZeroUnits) > 0) {
        // Combine the non-zero units into a string
        $timeRemainingString = implode(', ', $nonZeroUnits);
        
        // Output the remaining time
        echo 'There are ' . $timeRemainingString;
    } else {
        // Output a message indicating that the time has already passed
        echo 'The time has already passed.';
    }
    

}
function diplayAttemptNumber($studnetAssignmentDetails){
    return $studnetAssignmentDetails[0]->last_attempt;
}


function checkAnnoucementData($announcement_data){
    if($announcement_data && is_array($announcement_data)){
        return true;
    }
    return false;
}

function displayAnnouncementDescription($announcement_data){
    if(checkAnnoucementData($announcement_data)){
        return $announcement_data[0]->content;
    }
    return "";
}

function displayAnnouncementTitle($announcement_data){
    if(checkAnnoucementData($announcement_data)){
        return $announcement_data[0]->title;
    }
    return "";
}


function displayCorrectAnswer($choices){
    $rightAnswer = "";
    $count = 0;
    foreach($choices as $choice){
        if($choice->is_right_answer){
            if($count == 0){
                $rightAnswer .= $choice->choice;
                $count++;
            }
            else{
                $rightAnswer .= " & " . $choice->choice;
                $count++;
            }
        }
    }
    return $rightAnswer;
}

function checkDataForQuizIsValid($data){
    if(is_array($data) && !empty($data)){
        return true;
    }
    return false;
}

function DisplaySetQuizName($data){
    if(checkDataForQuizIsValid($data)){
        return $data["quiz_name"];
    }
    return "";
}

function displayQuizSetDate($data){
    if(checkDataForQuizIsValid($data)){
        return $data["date"];
    }
    return "";
}


function displaySetQuizStartTime($data){
    if(checkDataForQuizIsValid($data)){
        return $data["start_time"];
    }
    return "";
}


function displaySetQuizEndTime($data)
{
    if (checkDataForQuizIsValid($data)) {
        return $data["end_time"];
    }
    return "";
}

function displaySetQuizNumberOfQuestions($data)
{
    if (checkDataForQuizIsValid($data)) {
        return $data["number_of_questions"];
    }
    return "";
}



function displaySetQuizTime($data)
{
    if (checkDataForQuizIsValid($data)) {
        return $data["time"];
    }
    return "";
}


function displaySetMarkValue($data)
{
    if (checkDataForQuizIsValid($data)) {
        return $data["mark_value"];
    }
    return "";
}

function displaySetQuizNumberOfAttempts($data)
{
    if (checkDataForQuizIsValid($data)) {
        return $data["max_attempts"];
    }
    return "";
}

function displaySetDescription($data){
    if(checkDataForQuizIsValid($data)){
        return $data["description"];
    }
    return "";
}

function checkQuizMultibleChoiceValue($data,$choice,$value){
    if(!checkDataForQuizIsValid($data)){
        return "";
    }
    if($value == "is_recursive"){
        if($data["is_recursive"] == $choice){
            return "Selected";
        }
    }
    else if($value == "is_auto_correct"){
        if($data["is_auto_correct"] == $choice){
            return "Selected";
        }
    }
    else if($value == "is_shuffled"){
        if($data["is_shuffled"] == $choice){
            return "Selected";
        }
    }
    return "";
}

function getQuestionGrade($student_quiz_question){
    $studQuizes = new studQuizes();
    return $studQuizes->getMarkForStudentQuestion($student_quiz_question);
}

function displayAssignmentOldName($old_data){
    if(checkDataForQuizIsValid($old_data)){
        return $old_data["assignment_name"];
    }
    return "";
}


function displayAssignmentOldStartDate($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["start_date"];
    }
    return "";
}


function displayAssignmentOldEndDate($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["end_date"];
    }
    return "";
}

function displayAssignmentOldLastSubmissionDate($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["last_date"];
    }
    return "";
}

function displayAssignmentOldMarkValue($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["mark_value"];
    }
    return "";
}


function displayAssignmentOldMaxAttempts($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["max_attempts"];
    }
    return "";
}


function displayAssignmentOldDescription($old_data)
{
    if (checkDataForQuizIsValid($old_data)) {
        return $old_data["description"];
    }
    return "";
}


function AssignmentUnMarked($student_assignment_id){
    $studAssignment = new StudentAssignment();
    return $studAssignment->checkIfAssignmentMarked($student_assignment_id);
}

function is_date_larger_or_equal($given_date)
{
    $current_date = date('Y-m-d');
    return ($given_date >= $current_date);
}


function displayGradeInfo($last_attempt){
    if($last_attempt){
        $studAssignment = new studentAssignment();
        $grade = $studAssignment->getGrade($last_attempt[0]->student_assignment_id);
        if($grade === false){
            return "Not Graded";
        }
        return $grade;
    }
}