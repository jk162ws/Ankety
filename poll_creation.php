<?php
    require_once('core/User.php');
    require_once('core/Poll.php');
    require_once('core/Question.php');
    require_once('core/QuestionOption.php');
    require_once('db/DBHelper.php');
    
    session_start();
    $name = filter_input(INPUT_POST, "poll_name");
    $type = filter_input(INPUT_POST, "poll_type");
    $password = filter_input(INPUT_POST, "poll_password");
    $squestions = $_SESSION["questions"];
    $login = $_SESSION["user"];
    $db = new DBHelper();
    
    $poll = new Poll($name, $squestions, $type, $password);
    
    $user = new User($login, null, null, null);
    $pollId = $db->dml->insertPoll($user, $poll);
    $poll->setId($pollId);
    
    for($i = 0; $i < count($poll->getQuestions()); $i++) {
        $questions = $poll->getQuestions();
        $questionId = $db->dml->insertQuestion($poll, $questions[$i]);
        $questions[$i]->setId($questionId);
        for($j = 0; $j < count($questions[$i]->getQuestionOptions()); $j++) {
            $answers = $questions[$i]->getQuestionOptions();
            $answerId = $db->dml->insertQuestionOption($questions[$i], $answers[$j]);
        }
    }
    $_SESSION["questions"] = null;
    $_SESSION["poll"] = null;
    header("location:index.php");
    
    
    
    
    

