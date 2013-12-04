<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>WT Ankety</title>
    </head>
    <body>
        <?php
        require_once('core/Answer.php');
        require_once('core/User.php');
        require_once('core/QuestionOption.php');
        require_once('core/Question.php');
        require_once('core/Poll.php');
        require_once('db/DBHelper.php');
        
        $db = new DBHelper();
        
        session_start();
        if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("location:login.php");
        }
        
        $poll = $_SESSION["pollshow"];
        $user = new User($_SESSION["user"], null, null, null);
        
        for($i = 0; $i < count($poll->getQuestions()); $i++) {
            $question = $poll->getQuestions()[$i];
            for($j = 0; $j < count($question->getQuestionAnswers()); $j++) {
                $answer = $question->getQuestionAnswers()[$j];
                $answerId = $db->dml->insertAnswer($question, $answer);
                $db->dml->insertUserAnswerLink($user, $answerId);
            }
        }
        
        $_SESSION["pollshow"] = null;
        header("location:index.php");
        ?>
    </body>
</html>


