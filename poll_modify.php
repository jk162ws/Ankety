<?php
    require_once('core/Poll.php');
    require_once('core/Entity.php');
    require_once('core/Question.php');
    require_once('core/QuestionOption.php');
    session_start();
    $poll = $_SESSION['poll'];
    $questions = $_SESSION['questions'];
    
    $signal = filter_input(INPUT_POST, "signal");
    $id = filter_input(INPUT_POST, "index");
    $answerId = filter_input(INPUT_POST, "answerIndex");
    $text = filter_input(INPUT_POST, "text");
    
    if($signal == "pollnameChange") {
        $poll->setName($text);
    }
    if($signal == "polltypeChange") {
        $poll->setType($text);
    }
    if($signal == "pollpasswordChange") {
        $poll->setPassword($text);
    }
    if($signal == "add") {
        array_push($questions, new Question(null, null, null, null));
    }
    if($signal == "addAnswer") {
        $question = $questions[$id];
        $answers = $question->getQuestionOptions();
        if($answers == null) {
            $answers = [new QuestionOption (null)];
        }
        else {
            array_push($answers, new QuestionOption(null));
        }
        $question->setQuestionOptions($answers);
    }
    if($signal == "delete") {
        unset($questions[$id]);
        $questions = array_values($questions);
    }
    if($signal == "deleteAnswer") {
        $answers = $questions[$id]->getQuestionOptions();
        unset($answers[$answerId]);
        $questions[$id]->setQuestionOptions(array_values($answers));
    }
    if($signal == "textChange") {
        $questions[$id]->setQuestionText($text);
    }
    if($signal == "answerTextChange") {
        $answers = $questions[$id]->getQuestionOptions();
        $answers[$answerId]->setText($text);
    }
    if($signal == "typeChange") {
        $questions[$id]->setQuestionType($text);
    }
    $_SESSION['questions'] = $questions;
    $_SESSION['poll'] = $poll;
