<html>
    <head>
        <meta charset="UTF-8">
        <title>WT Ankety</title>
    </head>
    <body>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="poll_modify.js">
        </script>
    <?php
        require_once('core/Poll.php');
        require_once('core/Question.php');
        require_once('core/QuestionOption.php');
        session_start();
        if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("location:login.php");
        }
        if (!(isset($_SESSION['questions']))) {
            $questions = [new Question(null, null, null, null)];
            $_SESSION['questions'] = $questions;
            $poll = new Poll(null, null, null, null);
            $_SESSION['poll'] = $poll;
        } else {
            $questions = $_SESSION['questions'];
            $poll = $_SESSION['poll'];
        }
        
        $pollType = $poll->getType();
        $public = "";
        $private = "";
        if($pollType == "public") {
            $public = "checked";
        }
        if($pollType == "private") {
            $private = "checked";
        }
        
        echo '<form id="form" action="poll_creation.php" method="post">
            <b>Názov ankety: </b><input type="text" name="poll_name" value="' . $poll->getName() . '"><br>
            <b>Typ ankety: </b><br>
            <input type="radio" name="poll_type" value="public"' . $public .'>Verejná<br>
            <input type="radio" name="poll_type" value="private"' . $private . '>Súkromná<br>
            <b>Heslo ankety: </b><input type="text" name="poll_password" value="' . $poll->getPassword() . '"><br>
            <br>
            <br>
            <div id="poll_questions">';
        
        for ($index = 0; $index < count($questions); $index++) {
            $question = $questions[$index];
            $type = $questions[$index]->getQuestionType();
            $checkbox_checked = "";
            $checkbox_textfield_checked = "";
            $radio_checked = "";
            $radio_textfield_checked = "";
            $textfield_checked = "";
            if($type == "checkbox") {
                $checkbox_checked = "checked";
            }
            if($type == "checkbox_textfield") {
                $checkbox_textfield_checked = "checked";
            }
            if($type == "radio") {
                $radio_checked = "checked";
            }
            if($type == "radio_textfield") {
                $radio_textfield_checked = "checked";
            }
            if($type == "textfield") {
                $textfield_checked = "checked";
            }
            echo '<div id="question' . $index .'"><b>Otázka: </b> <input type="text" name="question_text' . $index . '" value="' . $questions[$index]->getQuestionText() . '"><br>
                    <b>Typ odpovedi: </b><br>
                    <input type="radio" name="question_type' . $index . '" value="checkbox" ' . $checkbox_checked . '>Zašktrnutie viacerých možností<br>
                    <input type="radio" name="question_type' . $index . '" value="checkbox_textfield" ' . $checkbox_textfield_checked . '>Zašktrnutie viacerých možností s vlastnou odpoveďou<br>
                    <input type="radio" name="question_type' . $index . '" value="radio" ' . $radio_checked . '>Zašktrnutie jednej možnosti<br>
                    <input type="radio" name="question_type' . $index . '" value="radio_textfield" ' . $radio_textfield_checked . '>Zašktrnutie jednej možnosti s vlastnou odpoveďou<br>
                    <input type="radio" name="question_type' . $index . '" value="textfield" ' . $textfield_checked . '>Vlastná odpoveď<br>';
            $answers = $question->getQuestionOptions();
            echo '<div id="answers' . $index .'">';
            for($j = 0; $j < count($answers); $j++) {
                echo '<div id="question' . $index . 'answer' . $j .'"><b>Možnosť: </b><input type="text" name="question' . $index . 'answer_text' . $j .'" value="' . $answers[$j]->getText() . '"><input id="remove' . $index . 'answer' . $j .'" type="button" value="Odstráň možnosť"></div>';
            }
            echo '</div>';
            echo '<input id="addanswer' . $index . '" type="button" value="Pridať možnosť"><br>';
            echo '<input id="remove' . $index . '" type="button" value="Odstráň otázku">
                    </div></div>';
        }
        echo '<input id="add" type="button" value="Pridaj otázku"><br><br>
            <input id="submit" type="submit" value="Potvrď"></form>';
    ?>
    </body>
</html>