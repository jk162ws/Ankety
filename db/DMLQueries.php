<?php
class DMLQueries {
    
    public function insertUser($user) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_USERS . " VALUES ('" .
                $user->getLogin() . "', '" . $user->getEmail() . "', '" . hash("sha256", $user->getPassword()) . "');";
        mysql_query($query);
    }
    
    public function deleteUser($userLogin) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_USERS . " WHERE " . DDLQueries::$KEY_USER_LOGIN . " like '" . $userLogin . "';";
        mysql_query($query);
    }
    
    public function insertPoll($user, $poll) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_POLLS . "(" . DDLQueries::$KEY_POLL_ID . ", " .
                DDLQueries::$KEY_FOREIGN_USER_LOGIN . ", " .
                DDLQueries::$KEY_POLL_NAME . ", " .
                DDLQueries::$KEY_POLL_TYPE . ", " .
                DDLQueries::$KEY_POLL_PASSWORD . ")" .
                " VALUES (NULL, '" . $user->getLogin() . "', '" . 
                $poll->getName() . "', '" . 
                $poll->getType() . "', '" . 
                $poll->getPassword() . "');";
        mysql_query($query); return mysql_insert_id();
    }
    
    public function deletePoll($pollId) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_POLLS . " WHERE " . DDLQueries::$KEY_POLL_ID . "=" . $pollId . ";";
        mysql_query($query);
    }
    
    public function insertQuestion($poll, $question) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_QUESTIONS .
                "(" . DDLQueries::$KEY_QUESTION_ID . ", " .
                DDLQueries::$KEY_FOREIGN_POLL_ID . ", " .
                DDLQueries::$KEY_QUESTION_TYPE . ", " .
                DDLQueries::$KEY_QUESTION_TEXT . ", " .
                DDLQueries::$KEY_QUESTION_IMAGE . ")" .
                " VALUES (NULL, " .
                $poll->getId() . ", '" . $question->getQuestionType() . "', '" . $question->getQuestionText() . "', '" . $question->getImage() . "');";
        mysql_query($query);
        return mysql_insert_id();
    }
    
    public function deleteQuestion($questionId) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_QUESTIONS . " WHERE " . DDLQueries::$KEY_QUESTION_ID . "=" . $questionId . ";";
        mysql_query($query);
    }
    
    public function insertQuestionOption($question, $option) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_QUESTION_OPTIONS . 
                "(" . DDLQueries::$KEY_OPTION_ID . ", " .
                DDLQueries::$KEY_FOREIGN_QUESTION . ", " .
                DDLQueries::$KEY_OPTION_TEXT . ")" .
                " VALUES (NULL, " .
                $question->getId() . ", '" . $option->getText() . "');";
        mysql_query($query);
        return mysql_insert_id();
    }
    
    public function deleteQuestionOption($optionId) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_QUESTION_OPTIONS . " WHERE " . DDLQueries::$KEY_OPTION_ID . "=" . $optionId . ";";
        mysql_query($query);
    }
    
    public function insertAnswer($question, $answer) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_ANSWERS . 
                "(" . DDLQueries::$KEY_ANSWER_ID . ", " .
                DDLQueries::$KEY_FOREIGN_QUESTION . ", " .
                DDLQueries::$KEY_ANSWER_TEXT . ")" .
                " VALUES (NULL, " .
                $question->getId() . ", '" . $answer->getText() . "');";
        mysql_query($query);
        return mysql_insert_id();
    }
    
    public function deleteAnswer($answerId) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_ANSWERS . " WHERE " . DDLQueries::$KEY_ANSWER_ID . "=" . $answerId . ";";
        mysql_query($query);
    }
    
    public function insertUserAnswerLink($user, $answerId) {
        $query = "INSERT INTO " . DDLQueries::$TABLE_ANSWERS_USERS .
                " VALUES ('" . $user->getLogin() . "', " . $answerId . ");";
        mysql_query($query);
        return mysql_insert_id();
    }
    
    public function deleteUserAnswerLink($userLogin, $answerId) {
        $query = "DELETE FROM " . DDLQueries::$TABLE_POLLS . " WHERE " . DDLQueries::$KEY_USER_LOGIN . " like '" . $userLogin ."' AND " .
                DDLQueries::$KEY_ANSWER_ID . "=" . $answerId . ";";
        mysql_query($query);
    }
}
