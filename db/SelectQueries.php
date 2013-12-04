<?php
class SelectQueries {
    
    public function getUsersPolls($userLogin) {
        $query = "SELECT " . DDLQueries::$KEY_POLL_ID . ", " . DDLQueries::$KEY_POLL_NAME . "," . DDLQueries::$KEY_POLL_TYPE . "," . DDLQueries::$KEY_POLL_PASSWORD . " FROM " . DDLQueries::$TABLE_POLLS . " WHERE " . DDLQueries::$KEY_FOREIGN_USER_LOGIN . " like '" . $userLogin . "';";
        $result = mysql_query($query);
        $array = [];
        while($row = mysql_fetch_array($result)) {
            $poll = new Poll($row[DDLQueries::$KEY_POLL_NAME], null, $row[DDLQueries::$KEY_POLL_TYPE], $row[DDLQueries::$KEY_POLL_PASSWORD]);
            $poll->setId($row[DDLQueries::$KEY_POLL_ID]);
            array_push($array, $poll);
        }
        return $array;
    }
    
    public function getPoll($pollId) {
        $query = "SELECT " . DDLQueries::$KEY_POLL_NAME . "," . DDLQueries::$KEY_POLL_TYPE . "," . DDLQueries::$KEY_POLL_PASSWORD . " FROM " . DDLQueries::$TABLE_POLLS . " WHERE " . DDLQueries::$KEY_POLL_ID . "=" . $pollId . ";";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $questions = $this->getQuestions($pollId);
        $poll = new Poll($row[DDLQueries::$KEY_POLL_NAME], $questions, $row[DDLQueries::$KEY_POLL_TYPE], $row[DDLQueries::$KEY_POLL_PASSWORD]);
        $poll->setId($pollId);
        
        return $poll;
    }
    
    public function getQuestions($pollId) {
        $query = "SELECT " . DDLQueries::$KEY_QUESTION_ID . ", " . DDLQueries::$KEY_QUESTION_TYPE . "," . DDLQueries::$KEY_QUESTION_TEXT . "," . DDLQueries::$KEY_QUESTION_IMAGE . " FROM " . DDLQueries::$TABLE_QUESTIONS . " WHERE " . DDLQueries::$KEY_FOREIGN_POLL_ID . "=" . $pollId . ";";
        $result = mysql_query($query);
        $array = [];
        while($row = mysql_fetch_array($result)) {
            $answers = $this->getQuestionOptions($row[DDLQueries::$KEY_QUESTION_ID]);
            $question = new Question($row[DDLQueries::$KEY_QUESTION_TEXT], $row[DDLQueries::$KEY_QUESTION_TYPE], $answers, $row[DDLQueries::$KEY_QUESTION_IMAGE]);
            $question->setId($row[DDLQueries::$KEY_QUESTION_ID]);
            array_push($array, $question);
        }
        return $array;
    }
    
    public function getQuestionOptions($questionId) {
        $query = "SELECT " . DDLQueries::$KEY_OPTION_ID . ", " . DDLQueries::$KEY_FOREIGN_QUESTION_ID . "," . DDLQueries::$KEY_OPTION_TEXT . " FROM " . DDLQueries::$TABLE_QUESTION_OPTIONS . " WHERE " . DDLQueries::$KEY_FOREIGN_QUESTION_ID . "=" . $questionId . ";";
        $result = mysql_query($query);
        $array = [];
        while($row = mysql_fetch_array($result)) {
            $option = new QuestionOption($row[DDLQueries::$KEY_OPTION_TEXT]);
            $option->setId($row[DDLQueries::$KEY_OPTION_ID]);
            array_push($array, $option);
        }
        return $array;
    }
}
