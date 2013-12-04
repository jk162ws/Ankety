<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>WT Ankety</title>
    </head>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="fill_poll.js"></script>
    <body>
        <?php
        require_once('core/Answer.php');
        require_once('core/QuestionOption.php');
        require_once('core/Question.php');
        require_once('core/Poll.php');
        require_once('db/DBHelper.php');
        
        $db = new DBHelper();
        
        session_start();
        if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("location:login.php");
        }
        
        $pollId = filter_input(INPUT_GET, "pollId");
        $poll = $db->select->getPoll($pollId);
        $_SESSION["pollshow"] = $poll;
        
        if(count($poll->getQuestions()) == 0) {
            echo '<div class="error">Anketa nebola nájdená</div>';
        }
        
        echo '<div id="header"><h2>' . $poll->getName() .'</h2></div>';
        echo '<form action="submit_poll.php" method="post">';
        for($i = 0; $i < count($poll->getQuestions()); $i++) {
            $question = $poll->getQuestions()[$i];
            echo '<div class="question">Otázka č. ' . ($i + 1) . ':<br> ' . $question->getQuestionText();
            $type = $question->getQuestionType();
            $questionType = "";
            if(strpos($type, "checkbox") !== false) {
                $questionType = "checkbox";
            } elseif(strpos($type, "radio") !== false) {
                $questionType = "radio";
            }
            if($questionType != "") {
                for($j = 0; $j < count($question->getQuestionOptions()); $j++) {
                    $answer = $question->getQuestionOptions()[$j];
                    echo '<div class="answer">';
                    echo '<input name="question_answer' . $i . '" type="' . $questionType . '" value="question' . $i . $answer->getText() . '">' . $answer->getText();
                    echo '</div>';
                }
            }
            if(strpos($type, "textfield") !== false) {
                echo '<div class="answer"><input name="question_answer' . $i . '" type="text"></div>';
            }
            echo '</div>';
        }
        echo '<br><input id="submit" type="submit" value="Pošli"></form>';
        ?>
    </body>
</html>

