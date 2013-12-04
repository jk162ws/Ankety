<?php
    require_once('core/Poll.php');
    require_once('core/Entity.php');
    require_once('core/Question.php');
    require_once('core/QuestionOption.php');
    require_once('core/Answer.php');
    session_start();
    $poll = $_SESSION['pollshow'];
    
    $signal = filter_input(INPUT_POST, "signal");
    $id = filter_input(INPUT_POST, "index");
    $answerId = filter_input(INPUT_POST, "answerIndex");
    $text = filter_input(INPUT_POST, "text");
    
    if($signal == "checkboxAdded") {
        $answers = $poll->getQuestions()[$id]->getQuestionAnswers();
        if($answers == null) {
            $answers = [new Answer($text)];
        } else {
            array_push($answers, new Answer($text));
        }
        $poll->getQuestions()[$id]->setQuestionAnswers($answers);
    }
    if($signal == "checkboxRemoved") {
        $answers = $poll->getQuestions()[$id]->getQuestionAnswers();
        for($i = 0; $i < count($answers); $i++) {
            if($text == $answers[$i]->getText()) {
                unset($answers[$i]);
                $answers = array_values($answers);
            }
        }
        $poll->getQuestions()[$id]->setQuestionAnswers($answers);
    }
    
    if($signal == "radioChanged") {
        $answers = $poll->getQuestions()[$id]->getQuestionAnswers();
        if($answers == null) {
            $answers = [new Answer($text)];
        } else {
            $answers[0]->setText($text);
        }
        $poll->getQuestions()[$id]->setQuestionAnswers($answers);
    }
    
    if($signal == "textfieldChanged") {
        $answers = $poll->getQuestions()[$id]->getQuestionAnswers();
        if($answers == null) {
            $answers = [new Answer($text)];
        } else {
            $answers[0]->setText($text);
        }
        $poll->getQuestions()[$id]->setQuestionAnswers($answers);
    }
    $_SESSION['pollshow'] = $poll;

